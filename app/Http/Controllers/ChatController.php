<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Tampilkan halaman chat.
     */
    public function index()
    {
        return view('review.app.chat');
    }

    /**
     * Handle sending message to Gemini API.
     */
    /**
     * Handle sending message to Gemini API.
     * Use server-side proxy to protect API Key.
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $userMessage = $request->input('message');
        $apiKey = env('GEMINI_API_KEY'); 

        // 1. Define Persona & Context
        $systemInstruction = "Kamu adalah Calmi, teman curhat maya yang pengertian, hangat, dan suportif.
        Aturan Utama:
        1. GAYA BAHASA: Santai, informal (aku-kamu), tidak kaku.
        2. TOPIK: Hanya seputar perasaan, mental health, dan motivasi.
        3. OOT: Tolak dengan ramah.
        4. SIKAP: Validasi perasaan user, jangan menggurui.
        5. EMERGENCY: Jika ada indikasi self-harm, sarankan bantuan profesional.";

        // 2. Construct Prompt
        $prompt = $systemInstruction . "\n\nUser: " . $userMessage . "\nCalmi:";

        // 3. Fallback Model Strategy (Flash/Flash-Lite)
        $models = [
            'gemini-2.0-flash',        
            'gemini-2.0-flash-lite',
            'gemini-2.5-flash',
            'gemini-1.5-flash'
        ];

        $botReply = "Maaf, saya sedang sibuk atau kuota habis. Silakan tunggu sebentar dan coba lagi ya.";

        // 3. API Request Loop (Try models sequentially)
        foreach ($models as $model) {
            try {
                // verify => false added for local dev environment
                $response = \Illuminate\Support\Facades\Http::withOptions(['verify' => false])
                    ->withHeaders(['Content-Type' => 'application/json'])
                    ->post("https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}", [
                    'contents' => [['parts' => [['text' => $prompt]]]]
                ]);

                $responseData = $response->json();

                if (isset($responseData['candidates'][0]['content']['parts'][0]['text'])) {
                    $botReply = $responseData['candidates'][0]['content']['parts'][0]['text'];
                    break;
                }
                
                // Retry on Quota Error (429)
                if (isset($responseData['error']['code']) && $responseData['error']['code'] == 429) {
                     continue; 
                }
            } catch (\Exception $e) {
                continue;
            }
        }
        
        return response()->json(['reply' => $botReply]);
    }
}

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
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $userMessage = $request->input('message');
        $apiKey = env('GEMINI_API_KEY');

        // Persona & Context
        // Persona & Context
        $systemInstruction = "Kamu adalah Calmi, teman curhat maya yang sangat pengertian, hangat, dan suportif.
        Bayangkan dirimu sebagai sahabat dekat yang siap mendengarkan keluh kesah tanpa menghakimi.
        
        Aturan Utama:
        1. GAYA BAHASA: Wajib menggunakan Bahasa Indonesia yang SANTAI, TIDAK BAKU (informal), dan akrab. Gunakan kata ganti 'aku' dan 'kamu'. Hindari kata-kata kaku seperti 'Saya', 'Anda', 'Apakah'. Gunakan bahasa percakapan sehari-hari yang merangkul.
        2. SCOPE TERBATAS: Kamu HANYA boleh menjawab topik seputar perasaan, kesehatan mental, curhat, dan motivasi diri.
        3. JIKA DITANYA DILUAR TOPIK (seperti Matematika, Coding, Sejarah, Fakta Umum): Tolak dengan santai dan ramah. Contoh: 'Waduh, aku kurang paham soal itu. Gimana kalau kita ngobrolin perasaanmu aja?'.
        4. SIKAP: Validasi perasaan user (misal: 'Pasti berat banget ya rasanya', 'Aku ngerti banget perasaanmu'). Jangan menggurui.
        5. KEAMANAN: Jika user bicara soal menyakiti diri sendiri, tetap tenang dan sarankan mencari bantuan profesional atau orang terdekat dengan bahasa yang peduli, bukan seperti robot.
        ";

        // Prompt Construction
        $prompt = $systemInstruction . "\n\nUser: " . $userMessage . "\nCalmi:";

        // List of models to try in order
        // Prioritizing 2.0 models as requested
        $models = [
            'gemini-2.0-flash',        
            'gemini-2.0-flash-lite',
            'gemini-2.5-flash',
            'gemini-1.5-flash'
        ];

        $botReply = "Maaf, saya sedang sibuk atau kuota habis. Silakan tunggu sebentar dan coba lagi ya.";

        foreach ($models as $model) {
            try {
                // IMPORTANT: verify => false added to bypass local SSL issues on Windows
                $response = \Illuminate\Support\Facades\Http::withOptions(['verify' => false])
                    ->withHeaders(['Content-Type' => 'application/json'])
                    ->post("https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}", [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $prompt]
                            ]
                        ]
                    ]
                ]);

                $responseData = $response->json();

                // Check for successful response
                if (isset($responseData['candidates'][0]['content']['parts'][0]['text'])) {
                    $botReply = $responseData['candidates'][0]['content']['parts'][0]['text'];
                    break; // Success! Exit loop.
                } 
                
                // If quota error, continue to next model instead of giving up immediately
                if (isset($responseData['error']['code']) && $responseData['error']['code'] == 429) {
                     // Log internal warning but try next model
                     // \Log::warning("Quota exceeded for {$model}");
                     continue; 
                }
                
            } catch (\Exception $e) {
                continue;
            }
        }
                

        
        return response()->json(['reply' => $botReply]);
    }
}

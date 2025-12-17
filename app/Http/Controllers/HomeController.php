<?php

namespace App\Http\Controllers;

use App\Models\notes;
use Illuminate\Http\Request;
use App\Http\Controllers\ArtikelController;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userId = auth()->id();

        // Ambil artikel kesehatan mental
        $artikelController = new ArtikelController();
        $articles = $artikelController->getArticles();

        // Ambil catatan terbaru hari ini untuk mood component
        $latestNote = notes::where('user_id', $userId)
            ->whereDate('created_at', Carbon::today())
            ->orderBy('created_at', 'desc')
            ->first();

        // Ambil semua catatan user untuk kalender
        $allNotes = notes::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function($note) {
                return Carbon::parse($note->created_at)->format('Y-m-d');
            });

        // Hitung streak (hari berturut-turut menulis catatan)
        $streak = $this->calculateStreak($userId);

        return view('review.pages.home', compact(
            'articles',
            'latestNote',
            'allNotes',
            'streak'
        ));
    }

    private function calculateStreak($userId)
    {
        // Ambil tanggal unik dari catatan user, diurutkan descending
        $noteDates = notes::where('user_id', $userId)
            ->selectRaw('DATE(created_at) as note_date')
            ->distinct()
            ->orderBy('note_date', 'desc')
            ->pluck('note_date')
            ->toArray();

        if (empty($noteDates)) {
            return 0;
        }

        $streak = 1;
        $today = Carbon::today()->format('Y-m-d');
        $yesterday = Carbon::yesterday()->format('Y-m-d');

        // Cek apakah ada catatan hari ini atau kemarin (untuk streak yang masih aktif)
        if ($noteDates[0] !== $today && $noteDates[0] !== $yesterday) {
            return 0;
        }

        // Hitung streak mundur dari hari ini/kemarin
        for ($i = 1; $i < count($noteDates); $i++) {
            $currentDate = Carbon::parse($noteDates[$i]);
            $previousDate = Carbon::parse($noteDates[$i - 1]);

            // Cek apakah tanggal berurutan (selisih 1 hari)
            if ($previousDate->diffInDays($currentDate) === 1) {
                $streak++;
            } else {
                break;
            }
        }

        return $streak;
    }

    public function notes()
    {
        $notes = \App\Models\notes::where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();
        return view('review.app.notes', compact('notes'));
    }
}

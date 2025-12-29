<?php

namespace App\Http\Controllers;

use App\Models\notes;
use Illuminate\Http\Request;
use App\Http\Controllers\ArtikelController;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     * Displays articles, latest note, mood calendar, and streak count.
     */
    public function index()
    {
        $userId = auth()->id();

        // 1. Fetch Articles
        $artikelController = new ArtikelController();
        $articles = $artikelController->getArticles();

        // 2. Fetch Latest Note
        $latestNote = notes::where('user_id', $userId)
            ->whereDate('created_at', Carbon::today())
            ->orderBy('created_at', 'desc')
            ->first();

        // 3. Fetch All Notes (Calendar)
        $allNotes = notes::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function($note) {
                return Carbon::parse($note->created_at)->format('Y-m-d');
            });

        // 4. Streak
        $streak = $this->calculateStreak($userId);

        return view('review.pages.home', compact('articles', 'latestNote', 'allNotes', 'streak'));
    }

    /**
     * Calculate user streak (consecutive days of logging notes).
     */
    private function calculateStreak($userId)
    {
        // Get unique dates from notes
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

        // Check if streak is active (has note today or yesterday)
        if ($noteDates[0] !== $today && $noteDates[0] !== $yesterday) {
            return 0;
        }

        // Count backwards
        for ($i = 1; $i < count($noteDates); $i++) {
            $currentDate = Carbon::parse($noteDates[$i]);
            $previousDate = Carbon::parse($noteDates[$i - 1]);

            // Check if consecutive day
            if ($previousDate->diffInDays($currentDate) === 1) {
                $streak++;
            } else {
                break;
            }
        }

        return $streak;
    }

    /**
     * Show the Notes page.
     * Displays list of user notes sorted by date.
     */
    public function notes()
    {
        $notes = \App\Models\notes::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('review.app.notes', compact('notes'));
    }
}

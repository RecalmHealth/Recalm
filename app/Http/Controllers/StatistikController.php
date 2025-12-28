<?php
namespace App\Http\Controllers;
use App\Models\notes as Note;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
class StatistikController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->id();
        $query = Note::where('user_id', $userId);

        // Default logic: Bulan ini (tanpa filter UI dulu)
        $start = Carbon::now()->startOfMonth();
        $end = Carbon::now()->endOfMonth();

        $labels = ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'];
        $senangData = [0,0,0,0];
        $marahData = [0,0,0,0];
        $sedihData = [0,0,0,0];
        $notes = $query->whereBetween('created_at', [$start, $end])->get();
        foreach ($notes as $note) {
            $day = $note->created_at->day;
            $weekIndex = floor(($day - 1) / 7);
            if ($weekIndex > 3) $weekIndex = 3;
            if ($note->Mood == 'Senang') $senangData[$weekIndex]++;
            elseif ($note->Mood == 'Marah') $marahData[$weekIndex]++;
            elseif ($note->Mood == 'Sedih') $sedihData[$weekIndex]++;
        }
        return view('review.app.statistik', compact(
            'labels', 'senangData', 'marahData', 'sedihData'
        ));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\notes as Note;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class StatistikController extends Controller
{
    /**
     * Display the statistics page with mood analysis.
     * 
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Default filter is 'week' based on user requirement
        $filter = $request->query('filter', 'week');
        $userId = auth()->id();

        // Fetch and process mood data
        $data = $this->getMoodData($filter, $userId);

        return view('review.app.statistik', $data);
    }

    /**
     * Generate and download PDF report of mood statistics.
     */
    public function downloadPdf(Request $request)
    {
        ini_set('memory_limit', '256M'); // Increase memory for PDF generation
        
        $filter = $request->input('filter', 'week');
        $chartImage = $request->input('chart_image'); // Base64 image from frontend Chart.js
        $userId = auth()->id();
        
        $data = $this->getMoodData($filter, $userId);

        // Load view and render as PDF
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('review.app.statistik_pdf', $data + ['chartImage' => $chartImage]);
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->download('Recalm_Statistic_' . now()->format('Ymd_His') . '.pdf');
    }

    /**
     * Core logic to fetch notes and calculate mood statistics.
     * Handles 'week', 'month', 'year' filters.
     */
    private function getMoodData($filter, $userId)
    {
        $query = Note::where('user_id', $userId);
        
        // Initialize data arrays
        $labels = [];
        $senangData = [];
        $marahData = [];
        $sedihData = [];

        // 1. Determine Date Range & Loop Logic based on Filter
        if ($filter === 'year') {
            $start = Carbon::now()->startOfYear();
            $end = Carbon::now()->endOfYear();
            $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            
            $senangData = array_fill(0, 12, 0);
            $marahData = array_fill(0, 12, 0);
            $sedihData = array_fill(0, 12, 0);
            
            $notes = $query->whereBetween('created_at', [$start, $end])->get();
            
            foreach ($notes as $note) {
                $monthIndex = $note->created_at->month - 1;
                if ($note->Mood == 'Senang') $senangData[$monthIndex]++;
                elseif ($note->Mood == 'Marah') $marahData[$monthIndex]++;
                elseif ($note->Mood == 'Sedih') $sedihData[$monthIndex]++;
            }
        } elseif ($filter === 'month') {
            $start = Carbon::now()->startOfMonth();
            $end = Carbon::now()->endOfMonth();

            $labels = ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'];
            $senangData = [0, 0, 0, 0];
            $marahData = [0, 0, 0, 0];
            $sedihData = [0, 0, 0, 0];
            
            $notes = $query->whereBetween('created_at', [$start, $end])->get();
            
            // Map notes to weeks (simplified 4 weeks/month logic)
            foreach ($notes as $note) {
                $day = $note->created_at->day;
                $weekIndex = floor(($day - 1) / 7);
                if ($weekIndex > 3) $weekIndex = 3; // Catch overflow days
                
                if ($note->Mood == 'Senang') $senangData[$weekIndex]++;
                elseif ($note->Mood == 'Marah') $marahData[$weekIndex]++;
                elseif ($note->Mood == 'Sedih') $sedihData[$weekIndex]++;
            }
        } else {
            // Default: Week
            $start = Carbon::now()->startOfWeek();
            $end = Carbon::now()->endOfWeek();

            $labels = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
            $senangData = array_fill(0, 7, 0);
            $marahData = array_fill(0, 7, 0);
            $sedihData = array_fill(0, 7, 0);
            
            $notes = $query->whereBetween('created_at', [$start, $end])->get();
            
            // Map notes to days of week (0=Senin, 6=Minggu)
            foreach ($notes as $note) {
                $dayIndex = $note->created_at->dayOfWeekIso - 1;
                if ($note->Mood == 'Senang') $senangData[$dayIndex]++;
                elseif ($note->Mood == 'Marah') $marahData[$dayIndex]++;
                elseif ($note->Mood == 'Sedih') $sedihData[$dayIndex]++;
            }
        }

        // 2. Calculate Totals for INSIGHTS (ALWAYS WEEKLY)
        // User requested: "Insight mood per minggu aja" regardless of filter
        $startWeek = Carbon::now()->startOfWeek();
        $endWeek = Carbon::now()->endOfWeek();
        
        $weeklyNotes = Note::where('user_id', $userId)
            ->whereBetween('created_at', [$startWeek, $endWeek])
            ->get();

        $insightSenang = $weeklyNotes->where('Mood', 'Senang')->count();
        $insightMarah = $weeklyNotes->where('Mood', 'Marah')->count();
        $insightSedih = $weeklyNotes->where('Mood', 'Sedih')->count();
        $totalInsightNotes = $weeklyNotes->count();

        // 3. Generate Mood Insights (Based on Weekly Data)
        $insightTitle = 'Belum ada data mood minggu ini';
        $insightDesc = 'Mulai catat mood kamu hari ini untuk melihat analisanya!';
        $insightColor = '#6c757d';
        $insightIcon = 'bi-question-circle-fill';

        if ($totalInsightNotes > 0) {
            if ($insightSenang >= $insightMarah && $insightSenang >= $insightSedih) {
                // Dominant: Happy
                $insightTitle = 'Emosi Kamu Stabil!';
                $insightDesc = 'Satu minggu ini kamu sudah berhasil mengatur emosi kamu,<br><br>Kamu Hebat!! , Pertahankan semangat positif ini, dan terus lakukan hal-hal yang membuatmu bahagia!';
                $insightColor = '#1E4F91';
                $insightIcon = 'bi-exclamation-circle-fill';
            } elseif ($insightMarah >= $insightSenang && $insightMarah >= $insightSedih) {
                // Dominant: Angry
                $insightTitle = 'Kamu Sedang Emosi?';
                $insightDesc = 'Sepertinya kamu banyak merasakan amarah minggu ini,<br><br>Coba tarik nafas dalam-dalam, istirahat sejenak, dan hindari pemicu stres ya.';
                $insightColor = '#E69500';
                $insightIcon = 'bi-fire';
            } else {
                // Dominant: Sad
                $insightTitle = 'Jangan Sedih Terus Ya!';
                $insightDesc = 'Terlihat banyak kesedihan di catatanmu minggu ini,<br><br>Tidak apa-apa untuk menangis, tapi jangan lupa untuk bangkit lagi. Ceritakan masalahmu ke orang terdekat yuk.';
                $insightColor = '#D32F2F';
                $insightIcon = 'bi-cloud-rain-fill';
            }
        }

        // Calculate Totals for CHART DISPLAY (Depends on Filter) -> Optional if needed for view, 
        // but current view doesn't seem to show raw totals, only the insight.
        // We keep $notes for history list if that should follow filter, OR history list should also be weekly?
        // User usually implies just the "Insight Text". 
        // Let's assume History List follows the Filter (standard behavior), and only Insight Text is fixed.

        // 4. Fetch History Notes List
        $historyNotes = Note::where('user_id', $userId)
            ->whereBetween('created_at', [$start, $end])
            ->latest()
            ->get();

        return compact(
            'labels',
            'senangData',
            'marahData',
            'sedihData',
            'filter',
            'insightTitle',
            'insightDesc',
            'insightColor',
            'insightIcon',
            'historyNotes'
        );
    }
}

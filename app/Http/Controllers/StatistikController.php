<?php

namespace App\Http\Controllers;

use App\Models\notes as Note;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class StatistikController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'month');
        $userId = auth()->id();

        $data = $this->getMoodData($filter, $userId);

        return view('review.app.statistik', $data);
    }
    public function downloadPdf(Request $request)
    {
        ini_set('memory_limit', '256M');
        $filter = $request->input('filter', 'month');
        $chartImage = $request->input('chart_image');
        $userId = auth()->id();
        $data = $this->getMoodData($filter, $userId);
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('review.app.statistik_pdf', $data + ['chartImage' => $chartImage]);
        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('Recalm_Statistic_' . now()->format('Ymd_His') . '.pdf');
    }
    private function getMoodData($filter, $userId)
    {
        $query = Note::where('user_id', $userId);
        $labels = [];
        $senangData = [];
        $marahData = [];
        $sedihData = [];
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
            foreach ($notes as $note) {
                $day = $note->created_at->day;
                $weekIndex = floor(($day - 1) / 7);
                if ($weekIndex > 3) $weekIndex = 3;
                if ($note->Mood == 'Senang') $senangData[$weekIndex]++;
                elseif ($note->Mood == 'Marah') $marahData[$weekIndex]++;
                elseif ($note->Mood == 'Sedih') $sedihData[$weekIndex]++;
            }
        } else {
            $start = Carbon::now()->startOfWeek();
            $end = Carbon::now()->endOfWeek();

            $labels = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
            $senangData = array_fill(0, 7, 0);
            $marahData = array_fill(0, 7, 0);
            $sedihData = array_fill(0, 7, 0);
            $notes = $query->whereBetween('created_at', [$start, $end])->get();
            foreach ($notes as $note) {
                $dayIndex = $note->created_at->dayOfWeekIso - 1;
                if ($note->Mood == 'Senang') $senangData[$dayIndex]++;
                elseif ($note->Mood == 'Marah') $marahData[$dayIndex]++;
                elseif ($note->Mood == 'Sedih') $sedihData[$dayIndex]++;
            }
        }
        $totalSenang = $notes->where('Mood', 'Senang')->count();
        $totalMarah = $notes->where('Mood', 'Marah')->count();
        $totalSedih = $notes->where('Mood', 'Sedih')->count();
        $totalNotes = $notes->count();
        // Insight Logic Added Here
        $insightTitle = 'Belum ada data mood';
        $insightDesc = 'Mulai catat mood kamu hari ini untuk melihat analisanya!';
        $insightColor = '#6c757d';
        $insightIcon = 'bi-question-circle-fill';
        if ($totalNotes > 0) {
            if ($totalSenang >= $totalMarah && $totalSenang >= $totalSedih) {
                $insightTitle = 'Emosi Kamu Stabil!';
                $insightDesc = 'Satu periode ini kamu sudah berhasil mengatur emosi kamu,<br><br>Kamu Hebat!! , Pertahankan semangat positif ini, dan terus lakukan hal-hal yang membuatmu bahagia!';
                $insightColor = '#1E4F91';
                $insightIcon = 'bi-exclamation-circle-fill';
            } elseif ($totalMarah >= $totalSenang && $totalMarah >= $totalSedih) {
                $insightTitle = 'Kamu Sedang Emosi?';
                $insightDesc = 'Sepertinya kamu banyak merasakan amarah belakangan ini,<br><br>Coba tarik nafas dalam-dalam, istirahat sejenak, dan hindari pemicu stres ya.';
                $insightColor = '#E69500';
                $insightIcon = 'bi-fire';
            } else {
                $insightTitle = 'Jangan Sedih Terus Ya!';
                $insightDesc = 'Terlihat banyak kesedihan di catatanmu,<br><br>Tidak apa-apa untuk menangis, tapi jangan lupa untuk bangkit lagi. Ceritakan masalahmu ke orang terdekat yuk.';
                $insightColor = '#D32F2F';
                $insightIcon = 'bi-cloud-rain-fill';
            }
        }

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
            'totalSenang',
            'totalMarah',
            'totalSedih',
            'historyNotes'
        );
    }
}

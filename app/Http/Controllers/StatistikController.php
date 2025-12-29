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
return view('review.app.statistik', compact(
'labels', 'senangData', 'marahData', 'sedihData', 'filter'
));
}
}

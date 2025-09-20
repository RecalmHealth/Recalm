<?php

namespace App\Http\Controllers;

use App\Charts\EmployeesChart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatistikController extends Controller
{
    public function index(EmployeesChart $chart)
    {
        return view('review.app.statistik', [
            'chart' => $chart->build()
        ]);
    }
}

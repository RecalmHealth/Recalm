<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ArtikelController;

class LandingController extends Controller
{
    public function index()
    {
        $motivations = [
            "“Ingat, kamu tetap hebat meski hari ini terasa berat.”",
            "“Yuk, tarik napas dulu. Semua bakal baik-baik aja.”",
            "“Mood naik turun itu wajar. Hidup juga begitu kok.”",
            "“Be gentle with yourself today.”",
            "“Kamu tetap keren karena sudah sampai di sini.”",
            "“Kamu nggak sendirian. Ada Recalm buat nemenin kamu.”"
        ];
        return view('review.pages.landing-page', compact( 'motivations'));
    }
}

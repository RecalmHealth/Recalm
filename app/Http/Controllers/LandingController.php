<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ArtikelController;

class LandingController extends Controller
{
    public function index()
    {
        // Reuse ArtikelController to fetch articles
        $artikelController = new ArtikelController();
        $articles = $artikelController->getArticles();

        $motivations = [
            "“Ingat, kamu tetap hebat meski hari ini terasa berat.”",
            "“Yuk, tarik napas dulu. Semua bakal baik-baik aja.”",
            "“Mood naik turun itu wajar. Hidup juga begitu kok.”",
            "“Be gentle with yourself today.”",
            "“Kamu tetap keren karena sudah sampai di sini.”",
            "“Kamu nggak sendirian. Ada Recalm buat nemenin kamu.”"
        ];

        $teamMembers = [
            [
                'name' => 'Andana Aprilio W',
                'role' => 'UI/UX Designer',
                'moto' => '“If everything is confusing, at least we’re confused together.”',
                'image' => asset('images/timdev/pio.png'), // Replace with actual images later
                'social_link' => 'https://www.linkedin.com/in/andanaaprilio/'
            ],
            [
                'name' => 'Daffa Yusuf M',
                'role' => 'Frontend Developer',
                'moto' => '“If you have insomnia, just sleep.”',
                'image' => asset('images/timdev/daffa.png'),
                'social_link' => 'https://www.linkedin.com/in/daffa-yusuf-mahendra/'
            ],
            [
                'name' => 'Aditia Ariq R',
                'role' => 'Project Manager',
                'moto' => '“If today feels wrong, tomorrow might too.”',
                'image' => asset('images/timdev/ariq.png'),
                'social_link' => 'https://www.linkedin.com/in/aditiaariqriskullah/'
            ],
            [
                'name' => 'M.Reyhandhani',
                'role' => 'Backend Developer',
                'moto' => '“If you’re tired, yeah… me too”',
                'image' => asset('images/timdev/dhani.png'),
                'social_link' => 'https://linktr.ee/kazam'
            ]
        ];

        return view('review.pages.landing-page', compact('articles', 'motivations', 'teamMembers'));
    }
}

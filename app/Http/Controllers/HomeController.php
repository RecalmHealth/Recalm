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
        // $this->middleware('auth');
    }

    public function index()
    {

        // Ambil artikel kesehatan mental
        $artikelController = new ArtikelController();
        $articles = $artikelController->getArticles();

        $currentYear = Carbon::now()->year;

        return view('review.pages.home', compact(
            'articles',
        ));
    }

    public function notes()
    {
        $notes = \App\Models\notes::where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();
        return view('review.app.notes', compact('notes'));
    }
}

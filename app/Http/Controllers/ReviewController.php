<?php

namespace App\Http\Controllers;

use App\Models\Notes;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        // Mengambil semua catatan dari database
        $notes = Notes::all();

        // Mengarahkan data ke view
        return view('review.app.note', compact('notes'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Tampilkan halaman chat.
     */
    public function index()
    {
        return view('review.app.chat'); // Pastikan file chat.blade.php ada di folder resources/views
    }
}

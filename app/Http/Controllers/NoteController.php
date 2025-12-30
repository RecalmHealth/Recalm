<?php

namespace App\Http\Controllers;

use App\Models\notes as Notes; // Alias for clarity
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Store a newly created note in storage.
     * This method handles the form submission from the Notes page.
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // 1. Validate Input (Ensure note and mood are present)
        $request->validate([
            'note-field' => 'required|string',
            'mood' => 'required',
        ]);

        // 2. Save Data to Database
        $note = new Notes();
        $note->user_id = auth()->id(); // Link note to current logged-in user
        $note->note = $request->input('note-field');
        $note->mood = $request->input('mood');
        $note->save();

        // 3. Redirect back with success message
        return redirect()->route('notes')->with('success', 'Data berhasil disimpan!');
    }
}

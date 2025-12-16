@extends('layouts.dashboard')

@section('title', 'Notes')

@section('content')
<div class="container-fluid px-4">
    <div class="row justify-content-center">
        <!-- Note Editor -->
        <div class="col-md-10">
            <div class="card border-0 shadow-sm p-5" style="border-radius: 30px; height: 85vh;">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <h3 class="fw-bold" style="color: #4361EE;" id="editor-date">{{ now()->format('d F Y') }}</h3>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle px-4 py-2 fw-bold" type="button" id="moodDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 12px; background-color: #4361EE; border: none; min-width: 120px;">
                            Mood
                        </button>
                        <ul class="dropdown-menu p-2 border-0 shadow-lg" aria-labelledby="moodDropdown" style="border-radius: 15px; min-width: 200px;">
                            <li class="mb-2"><a class="dropdown-item text-white fw-bold text-center py-2" href="#" onclick="setMood('Senang')" style="background-color: #4361EE; border-radius: 10px;">&#128515; Senang</a></li>
                            <li class="mb-2"><a class="dropdown-item text-white fw-bold text-center py-2" href="#" onclick="setMood('Marah')" style="background-color: #4361EE; border-radius: 10px;">&#128545; Marah</a></li>
                            <li><a class="dropdown-item text-white fw-bold text-center py-2" href="#" onclick="setMood('Sedih')" style="background-color: #4361EE; border-radius: 10px;">&#128557; Sedih</a></li>
                        </ul>
                    </div>
                </div>

                <form action="{{ route('note.store') }}" method="POST" class="h-100 d-flex flex-column">
                    @csrf
                    <input type="hidden" name="mood" id="mood-input" value="">
                    
                    <div class="flex-grow-1 mb-4 p-3" style="border: 1px solid #e0e0e0; border-radius: 20px; box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);">
                        <textarea class="form-control border-0 bg-transparent h-100" 
                            id="note-field" name="note-field" 
                            placeholder="Ceritakan harimu..." 
                            style="resize: none; font-size: 1.1rem; box-shadow: none;"></textarea>
                    </div>
                    
                    <div class="d-flex gap-3">
                        <button type="submit" class="btn btn-primary flex-grow-1 py-3 fw-bold fs-5 shadow-sm" style="border-radius: 15px; background-color: #4361EE; border: none;">Simpan Catatan</button>
                        <button type="button" class="btn btn-primary px-4 shadow-sm" style="border-radius: 15px; background-color: #4361EE; border: none;">
                            <i class="bi bi-mic-fill fs-4"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function selectNote(date, content, mood) {
        document.getElementById('editor-date').innerText = date;
        document.getElementById('note-field').value = content;
    }

    function setMood(mood) {
        const moodEmojis = {
            'Senang': '&#128515;', 
            'Marah': '&#128545;', 
            'Sedih': '&#128557;'
        };
        const emoji = moodEmojis[mood] || '';
        
        document.getElementById('mood-input').value = mood;
        // Use innerHTML to render HTML entities or emojis correctly
        document.getElementById('moodDropdown').innerHTML = `${emoji} ${mood}`;
    }
</script>

<style>
    .note-item:hover {
        transform: translateY(-2px);
        background-color: #fff !important;
    }
    /* Custom scrollbar for the list */
    ::-webkit-scrollbar {
        width: 6px;
    }
    ::-webkit-scrollbar-track {
        background: transparent; 
    }
    ::-webkit-scrollbar-thumb {
        background: #cbd5e1; 
        border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: #94a3b8; 
    }
</style>
@endsection

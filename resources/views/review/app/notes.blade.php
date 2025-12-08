@extends('layouts.dashboard')

@section('title', 'Notes')

@section('content')

    <div class="row">
        <!-- Note Editor -->
        <div class="col-md-12">
            <div class="card border-0 shadow-sm p-5" style="border-radius: 30px; height: 85vh;">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <h3 class="fw-bold" style="color: #4361EE;" id="editor-date">{{ now()->format('d F Y') }}</h3>

                </div>

                <form action="{{ route('note.store') }}" method="POST" class="h-100 d-flex flex-column">
                    @csrf
                    <input type="hidden" name="mood" id="mood-input" value="Senang">
                    
                    <div class="flex-grow-1 mb-4 p-3" style="border: 1px solid #e0e0e0; border-radius: 20px; box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);">
                        <textarea class="form-control border-0 bg-transparent h-100" 
                            id="note-field" name="note-field" 
                            placeholder="" 
                            style="resize: none; font-size: 1.1rem; box-shadow: none;"></textarea>
                    </div>
                    
                    <div class="d-flex gap-3">
                        <button type="submit" class="btn btn-primary flex-grow-1 py-3 fw-bold fs-5 shadow-sm" style="border-radius: 15px; background-color: #4361EE; border: none;">Simpan Catatan</button>

                    </div>
                </form>
            </div>
        </div>
    </div>


<script>


    function setMood(mood) {
        document.getElementById('mood-input').value = mood;
        document.getElementById('moodDropdown').innerText = mood;
    }
</script>

<style>
    .note-item:hover {
        transform: translateY(-2px);
        background-color: #fff !important;
    }

</style>
@endsection

@extends('layouts.dashboard')

@section('title', 'Notes')

@section('content')
<style>
    @keyframes pulse-red {
        0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7); }
        70% { transform: scale(1.1); box-shadow: 0 0 0 10px rgba(220, 53, 69, 0); }
        100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(220, 53, 69, 0); }
    }
    .recording-active {
        animation: pulse-red 1.5s infinite;
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
    .note-item:hover {
        transform: translateY(-2px);
        background-color: #fff !important;
    }
</style>

<div class="container-fluid px-4">
    <div class="row">
        <!-- Left Column: Notes List -->
        <div class="col-md-4">
            <div class="d-flex flex-column gap-3" style="max-height: 80vh; overflow-y: auto; padding-right: 5px;">
                @foreach($notes as $note)
                <div class="card border-0 shadow-sm p-4 note-item" onclick="selectNote('{{ $note->created_at->format('d F Y') }}', `{{ $note->Note }}`, '{{ $note->Mood }}')" style="cursor: pointer; border-radius: 20px; transition: transform 0.2s;">
                    <h4 class="fw-bold text-primary mb-3" style="color: #4361EE !important;">{{ $note->created_at->format('d F Y') }}</h4>
                    <p class="text-muted mb-0 text-truncate" style="max-height: 4.5em; overflow: hidden; line-height: 1.6;">
                        {{ Str::limit($note->Note, 120) }}
                    </p>
                </div>
                @endforeach

                <!-- Placeholder if no notes -->
                @if($notes->isEmpty())
                <div class="text-center text-muted py-5">
                    <p>Belum ada catatan.</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Right Column: Note Editor -->
        <div class="col-md-8">
            <!-- Alert replaced by SweetAlert popup -->

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

                <form action="{{ route('note.store') }}" method="POST" class="h-100 d-flex flex-column" onsubmit="return checkAuth(event)">
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
                        <button type="button" class="btn btn-primary px-4 shadow-sm" id="start-recording" style="border-radius: 15px; background-color: #4361EE; border: none;">
                            <i class="bi bi-mic-fill fs-4"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Success Notification
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
            });
        @endif
    });

    function selectNote(date, content, mood) {
        document.getElementById('editor-date').innerText = date;
        document.getElementById('note-field').value = content;
        // Optionally restore mood value if needed, for now just text/date
    }

    function setMood(mood) {
        const moodEmojis = {
            'Senang': '&#128515;',
            'Marah': '&#128545;',
            'Sedih': '&#128557;'
        };
        const emoji = moodEmojis[mood] || '';

        document.getElementById('mood-input').value = mood;
        document.getElementById('moodDropdown').innerHTML = `${emoji} ${mood}`;
    }

    function checkAuth(event) {
        // 1. Check Authentication
        const isAuthenticated = {{ Auth::check() ? 'true' : 'false' }};
        if (!isAuthenticated) {
            event.preventDefault();
            const authModal = new bootstrap.Modal(document.getElementById('authModal'));
            authModal.show();
            return false;
        }

        // 2. Check Mood Selection
        const mood = document.getElementById('mood-input').value;
        if (!mood) {
            event.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Kamu belum memilih mood hari ini!',
                confirmButtonColor: '#4361EE'
            });
            return false;
        }

        return true;
    }

    // --- Speech to Text Implementation ---
    document.addEventListener('DOMContentLoaded', function() {
        const micButton = document.getElementById('start-recording');
        const noteField = document.getElementById('note-field');

        if ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window) {
            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
            const recognition = new SpeechRecognition();

            recognition.continuous = true;
            recognition.lang = 'id-ID';
            recognition.interimResults = true;

            let isRecording = false;
            let finalAtStart = ''; // Text when recording started

            micButton.addEventListener('click', function() {
                if (isRecording) {
                    recognition.stop();
                } else {
                    finalAtStart = noteField.value; // Save existing text
                    // Add space if needed
                    if (finalAtStart.length > 0 && !finalAtStart.endsWith(' ')) {
                        finalAtStart += ' ';
                    }
                    recognition.start();
                }
            });

            recognition.onstart = function() {
                isRecording = true;
                micButton.classList.add('recording-active');
                micButton.innerHTML = '<i class="bi bi-stop-fill fs-4"></i>';
                micButton.style.backgroundColor = '#dc3545';
                console.log('Recording started...');
            };

            recognition.onend = function() {
                isRecording = false;
                micButton.classList.remove('recording-active');
                micButton.innerHTML = '<i class="bi bi-mic-fill fs-4"></i>';
                micButton.style.backgroundColor = '#4361EE';
                console.log('Recording ended.');
            };

            recognition.onresult = function(event) {
                let interimTranscript = '';
                let finalTranscript = '';

                for (let i = event.resultIndex; i < event.results.length; ++i) {
                    if (event.results[i].isFinal) {
                        finalTranscript += event.results[i][0].transcript;
                    } else {
                        interimTranscript += event.results[i][0].transcript;
                    }
                }

                // If resultIndex is 0, we could rebuild significantly.
                // But generally in continuous mode, we want:
                // Existing Text (finalAtStart) + All Final Results (since start) + Current Interim

                // Better strategy for standard display:
                // Rebuild the whole session string from event.results every time
                let sessionString = '';
                for (let i = 0; i < event.results.length; ++i) {
                    sessionString += event.results[i][0].transcript;
                }

                // Update UI
                noteField.value = finalAtStart + sessionString;

                // Scroll to bottom
                noteField.scrollTop = noteField.scrollHeight;

                // Debug
                console.log('Transcript:', sessionString);
            };

            recognition.onerror = function(event) {
                console.error('Speech recognition error', event.error);
                if (event.error === 'no-speech') {
                    // Do nothing for no-speech
                    return;
                }

                // For other errors, stop and alert
                recognition.stop();

                let msg = 'Terjadi kesalahan.';
                if (event.error === 'not-allowed') msg = 'Izin mikrofon ditolak.';
                if (event.error === 'network') msg = 'Masalah jaringan / koneksi.';

                Swal.fire({
                   icon: 'error',
                   title: 'Error Mic',
                   text: msg,
                });
            };

        } else {
            micButton.style.display = 'none';
        }
    });
</script>
@endsection

@extends('layouts.dashboard')

@section('title', 'AI Chat')

@section('content')
<div class="container-fluid" style="height: 90vh;">
    <div class="row h-100 ps-lg-4">
        <div class="col-12 h-100">
            <!-- Main Chat Card -->
            <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; overflow: hidden;">

                <!-- Chat Header -->
                <div class="d-flex align-items-center px-4 py-3" style="background: linear-gradient(100deg, #4963c6 0, #4e6ee6 100%);">
                    <div class="position-relative">
                        <img src="{{ asset('images/icon/calmi-profile.png') }}" alt="Calmi"
                             class="rounded-circle"
                             style="width: 50px; height: 50px; object-fit: cover; background-color: #fff; padding: 2px;">
                    </div>
                    <div class="ms-3 text-white">
                        <h5 class="fw-bold mb-0">Calmi</h5>
                        <small style="opacity: 0.9;">Your Support System Is Here!</small>
                    </div>
                </div>

                <!-- Chat Body -->
                <div class="card-body bg-white position-relative p-4" style="overflow-y: auto; background-image: url('{{ asset('images/chat-pattern.png') }}'); background-size: cover; background-repeat: no-repeat; background-position: center;">

                    <!-- Incoming Message (Calmi) -->
                    <div class="d-flex align-items-start mb-4">
                        <img src="{{ asset('images/icon/calmi-profile.png') }}" alt="Calmi"
                             class="rounded-circle"
                             style="width: 40px; height: 40px; object-fit: cover; background-color: #eee; padding: 2px;">
                        <div class="ms-3 p-3 shadow-sm" style="background-color: #f0f0f0; border-radius: 20px 20px 20px 0px; max-width: 70%;">
                            <p class="mb-0 text-dark">Gimana keadaan kamu hari ini?</p>
                        </div>
                    </div>

                </div>

                <!-- Chat Footer (Input) -->
                <div class="card-footer bg-white border-0 p-4">
                    <div class="d-flex align-items-center gap-3">
                        <!-- Text Input -->
                        <div class="flex-grow-1 position-relative">
                            <input type="text" id="chat-input" class="form-control py-3 px-4 shadow-sm"
                                   placeholder="Type your message here..."
                                   style="border-radius: 30px; border: 1px solid #e0e0e0; padding-right: 50px;">
                            <button class="btn position-absolute top-50 end-0 translate-middle-y me-2" style="border: none; background: none;">
                                <img src="{{ asset('images/icon/send-icon.png') }}" alt="Send" style="width: 24px; height: 24px;">
                            </button>
                        </div>

                        <!-- Mic Button -->
                        <button id="start-recording" class="btn btn-primary d-flex align-items-center justify-content-center shadow-md"
                                style="width: 54px; height: 54px; border-radius: 15px; background-color: #4361EE; border: none;">
                            <i class="bi bi-mic-fill fs-4"></i>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chatContainer = document.querySelector('.card-body');
        const chatInput = document.querySelector('input[type="text"]');
        const sendBtn = document.querySelector('.card-footer button:not(.btn-primary)');

        // Auto-scroll to bottom
        chatContainer.scrollTop = chatContainer.scrollHeight;

        function appendMessage(text, sender) {
            const isUser = sender === 'user';
            const alignment = isUser ? 'justify-content-end' : 'justify-content-start align-items-start';
            const bgColor = isUser ? '#4361EE' : '#f0f0f0';
            const textColor = isUser ? 'text-white' : 'text-dark';
            const borderRadius = isUser ? '20px 20px 0px 20px' : '20px 20px 20px 0px';

            let avatarHtml = '';
            if (!isUser) {
                avatarHtml = `
                    <img src="{{ asset('images/icon/calmi-profile.png') }}" alt="Calmi" 
                         class="rounded-circle"
                         style="width: 40px; height: 40px; object-fit: cover; background-color: #eee; padding: 2px;">
                `;
            }

            const messageHtml = `
                <div class="d-flex ${alignment} mb-4 fade-in">
                    ${avatarHtml}
                    <div class="${!isUser ? 'ms-3' : ''} p-3 shadow-sm" style="background-color: ${bgColor}; border-radius: ${borderRadius}; max-width: 70%;">
                        <p class="mb-0 ${textColor}" style="word-wrap: break-word;">${text}</p>
                    </div>
                </div>
            `;

            chatContainer.insertAdjacentHTML('beforeend', messageHtml);
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        function showTyping() {
            const typingHtml = `
                <div id="typing-indicator" class="d-flex align-items-start mb-4 fade-in">
                    <img src="{{ asset('images/icon/calmi-profile.png') }}" alt="Calmi" 
                         class="rounded-circle"
                         style="width: 40px; height: 40px; object-fit: cover; background-color: #eee; padding: 2px;">
                    <div class="ms-3 p-3 shadow-sm" style="background-color: #f0f0f0; border-radius: 20px 20px 20px 0px;">
                        <span class="dot-flashing">Sedang mengetik...</span>
                    </div>
                </div>
            `;
            chatContainer.insertAdjacentHTML('beforeend', typingHtml);
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        function removeTyping() {
            const indicator = document.getElementById('typing-indicator');
            if (indicator) indicator.remove();
        }

        async function sendMessage() {
            const message = chatInput.value.trim();
            if (!message) return;

            // 1. User Message
            appendMessage(message, 'user');
            chatInput.value = '';

            // 2. Typing Indicator
            showTyping();

            try {
                // 3. Server Request
                const response = await fetch("{{ route('chat.send') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ message: message })
                });

                const data = await response.json();

                // 4. Bot Reply
                removeTyping();
                if (response.ok) {
                    appendMessage(data.reply, 'model');
                } else {
                    appendMessage('Maaf, ada gangguan. Coba lagi nanti.', 'model');
                }

            } catch (error) {
                removeTyping();
                appendMessage('Error: Gagal terhubung ke server.', 'model');
                console.error(error);
            }
        }

        sendBtn.addEventListener('click', sendMessage);
        chatInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') sendMessage();
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // --- Speech to Text Implementation ---
    document.addEventListener('DOMContentLoaded', function() {
        const micButton = document.getElementById('start-recording');
        const chatInput = document.getElementById('chat-input');
        // Check if elements exist to avoid errors if ID is missing
        if (!micButton || !chatInput) return;

        if ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window) {
            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
            const recognition = new SpeechRecognition();
            recognition.continuous = true;
            recognition.lang = 'id-ID';
            recognition.interimResults = true;
            let isRecording = false;
            let finalAtStart = '';

            micButton.addEventListener('click', function() {
                if (isRecording) {
                    recognition.stop();
                } else {
                    finalAtStart = chatInput.value;
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
                let sessionString = '';
                for (let i = 0; i < event.results.length; ++i) {
                    sessionString += event.results[i][0].transcript;
                }
                chatInput.value = finalAtStart + sessionString;
            };

            recognition.onerror = function(event) {
                console.error('Speech recognition error', event.error);
                if (event.error === 'no-speech') return;
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
<style>
    .fade-in { animation: fadeIn 0.3s ease-in-out; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

    @keyframes pulse-red {
        0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7); }
        70% { transform: scale(1.1); box-shadow: 0 0 0 10px rgba(220, 53, 69, 0); }
        100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(220, 53, 69, 0); }
    }
    .recording-active {
        animation: pulse-red 1.5s infinite;
    }
</style>

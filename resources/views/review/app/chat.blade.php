@extends('layouts.app')

@section('title', 'Home')
@section('content')
    <!-- Chat Section -->
    <div class="container my-4">
        <h2 class="text-center mb-4">Chat dengan RECALM</h2>

        <div class="card shadow">
            <!-- Chat Area -->
            <div class="card-body" id="chat-area" style="height: 60vh; overflow-y: auto; background-color: #f8f9fa;">
                <!-- Example Messages -->
                <div class="d-flex flex-row mb-3">
                    <div class="p-3 rounded bg-primary text-white">Hai, ada yang bisa aku bantu?</div>
                </div>
                <div class="d-flex flex-row-reverse mb-3">
                    <div class="p-3 rounded bg-secondary text-white">Aku lagi butuh saran untuk menenangkan diri.</div>
                </div>
            </div>

            <!-- Input Area -->
            <div class="card-footer bg-white">
                <form id="chat-form" class="d-flex">
                    <input type="text" class="form-control me-2" id="chat-input" placeholder="Tulis pesan...">
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Chat Section end -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        const chatForm = document.getElementById('chat-form');
        const chatInput = document.getElementById('chat-input');
        const chatArea = document.getElementById('chat-area');

        chatForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const message = chatInput.value.trim();

            if (message) {
                // Add user message to chat area
                const userMessage = document.createElement('div');
                userMessage.className = 'd-flex flex-row-reverse mb-3';
                userMessage.innerHTML = `<div class="p-3 rounded bg-secondary text-white">${message}</div>`;
                chatArea.appendChild(userMessage);

                // Scroll to the bottom
                chatArea.scrollTop = chatArea.scrollHeight;

                // Clear input
                chatInput.value = '';

                // Simulate bot response
                setTimeout(() => {
                    const botMessage = document.createElement('div');
                    botMessage.className = 'd-flex flex-row mb-3';
                    botMessage.innerHTML =
                        `<div class="p-3 rounded bg-primary text-white">Terima kasih telah berbagi, ada lagi yang bisa aku bantu?</div>`;
                    chatArea.appendChild(botMessage);

                    // Scroll to the bottom
                    chatArea.scrollTop = chatArea.scrollHeight;
                }, 1000);
            }
        });
    </script>
@endsection

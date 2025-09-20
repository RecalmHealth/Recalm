@extends('layouts.app')

@section('title', 'Home')
@section('content')
<body>

    <!-- Welcome Section -->
    <div>
        <div class="container py-4">
            <div class="row">
                <div class="col-md-12 bg-white sidebar p-4">
                    <form action="{{ route('note.store') }}" method="POST">
                        @csrf
                        <div class="mb-3 text-center">
                            <label for="note" class="form-label" style="font-size: 30px"><b>Ceritain Hari Kamu</b></label>
                            <textarea class="form-control text-area" id="note-field" name="note-field" rows="10"
                                placeholder="Silahkan apa yang kamu rasakan hari ini" style="font-size: 20px"></textarea>
                            <!--MOOD-->
                            <br>
                            <label for="mood" style="font-size: 20px"><b> Mood</b></label>
                            <select name="mood" id="mood" class="form-control"
                                style="font-size: 20px; height: 60px;">
                                <option value="Sedih"> &#128557; Sedih</option>
                                <option value="Senang">&#128515; Senang</option>
                                <option value="Marah">&#128545; Marah</option>
                            </select>
                            <div id="emailHelp" class="form-text" style="font-size:15px">Tenang.. Cerita kamu bakal aman
                                kok!</div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 btn-sumbit" style="font-size:25px;">Simpan
                            Catatan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Konten end -->
@endsection

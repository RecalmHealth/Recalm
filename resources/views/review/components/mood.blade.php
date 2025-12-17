<section class="mood-component h-100" role="region" aria-labelledby="mood-title">
  <div class="mood-inner d-flex text-white rounded-4 p-4 align-items-center flex-row">
    <div class="mood-content order-0">
      @php
        if(isset($latestNote) && $latestNote) {
            $noteMood = $latestNote->Mood ?? $latestNote->mood ?? null;

            if($noteMood) {
                $moodNormalized = strtolower($noteMood);

                // Tampilkan mood berdasarkan input user
                if(str_contains($moodNormalized, 'senang') || str_contains($moodNormalized, 'happy')) {
                    $title = 'Kamu lagi senang nih..';
                    $subtitle = 'Terus jaga kesenangan itu dengan selalu tersenyum ya!';
                } elseif(str_contains($moodNormalized, 'sedih') || str_contains($moodNormalized, 'sad')) {
                    $title = 'Sedih ya?';
                    $subtitle = 'Tenang, cerita sedikit bisa meringankan. Coba tulis perasaanmu.';
                } elseif(str_contains($moodNormalized, 'marah') || str_contains($moodNormalized, 'angry')) {
                    $title = 'Lagi kesal ya?';
                    $subtitle = 'Tarik napas dulu. Kalau mau, ceritakan di catatanmu.';
                } else {
                    $title = 'Halo — bagaimana hari ini?';
                    $subtitle = 'Bagikan sedikit ceritamu untuk membantu memproses perasaanmu.';
                }
            } else {
                $title = 'Halo — bagaimana hari ini?';
                $subtitle = 'Bagikan sedikit ceritamu untuk membantu memproses perasaanmu.';
            }
        } else {
            $title = 'Ayo buat catatan pertamamu!';
            $subtitle = 'Tulis ceritamu untuk melacak suasana hati dan mendapat rekomendasi.';
        }
      @endphp

      <div class="content-inner">
        <h2 id="mood-title" class="title-text mb-2">{{ $title }}</h2>

        <p class="subtitle-text mb-2">
          {{ $subtitle }}
        </p>

        @if(!isset($latestNote) || !$latestNote)
        <div class="d-flex button-mood gap-3 mt-3">
          <a href="{{ route('notes') }}" class="btn btn-light btn-sm fw-semibold rounded-2" aria-label="Buat Catatan">Buat Catatan</a>
          <a href="{{ route('review.index') }}" class="btn btn-outline-light fw-semibold btn-sm rounded-2" aria-label="Lihat Catatan">Lihat Catatan</a>
        </div>
        @endif
      </div>
    </div>

    <figure class="mood-illustration order-1 mb-0" aria-hidden="false">
      <img src="{{ asset('images/mood.png') }}" alt="Ilustrasi suasana hati" class="img-fluid mood-img">
    </figure>
  </div>
</section>

<style>
  .mood-inner {
    background: linear-gradient(180deg, #4255d9 0%, #6379ff 100%);
    gap: 1rem;
    align-items: center;
  }

  .mood-content {
    flex: 1 1 60%;
    min-width: 140px;
    display: flex;
    align-items: center;
  }

  .content-inner {
    max-width: 56ch;
    padding: .25rem .25rem;
    width: 100%;
  }

  .mood-illustration {
    flex: 0 0 32%;
    max-width: 32%;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .mood-illustration .mood-img {
    width: 100%;
    max-width: 220px;
    height: auto;
    object-fit: contain;
    display: block;
  }


.mood-component .title-text {
  font-size: clamp(1.1rem, 2.6vw, 2.2rem);
  font-weight: 700;
  line-height: 1.2;
  margin-bottom: .75rem;
}

.mood-component .subtitle-text {
  font-size: clamp(.88rem, 1.8vw, 1.05rem);
  color: rgba(255,255,255,0.95);
  line-height: 1.5;
  margin-bottom: .5rem;
}

  .button-mood .btn {
    padding: .50rem .50rem;
  }

  @media (max-width: 767.98px) {

    .mood-illustration .mood-img { max-width: 160px; }


    .mood-component .title-text { font-size: clamp(1rem, 4.5vw, 1.4rem); }
    .mood-component .subtitle-text { font-size: .9rem; }
    .button-mood .btn { padding: .35rem .55rem; font-size: .70rem; }
  }

  @media (max-width: 480px) {
    .mood-illustration .mood-img { max-width: 120px; }
    .mood-component .title-text { font-size: 1rem; }
    .mood-component .subtitle-text { font-size: .85rem; }
  }

  .mood-component, .mood-inner { overflow: hidden; }
</style>

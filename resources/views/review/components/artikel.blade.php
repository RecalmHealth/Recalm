<section class="artikel-component my-5">
  <div class="container-fluid px-0">
    <div class="d-flex justify-content-between align-items-center mb-4 article-custom-padding">
      <h2 class="artikel-header mb-0">Artikel Kesehatan Mental</h2>
      <div class="carousel-nav d-none d-md-flex gap-2">
        <button class="carousel-btn carousel-prev" type="button" data-bs-target="#artikelCarousel" data-bs-slide="prev" aria-label="Previous">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>
        <button class="carousel-btn carousel-next" type="button" data-bs-target="#artikelCarousel" data-bs-slide="next" aria-label="Next">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>
      </div>
    </div>
    {{-- Desktop layout--}}
    <div id="artikelCarousel" class="carousel slide d-none d-md-block article-custom-padding" data-bs-ride="false">
      <div class="carousel-inner">
        @php
          $chunkedArticles = array_chunk($articles, 4);
        @endphp
        @foreach($chunkedArticles as $index => $articleGroup)
        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
          <div class="row g-4">
            @foreach($articleGroup as $article)
            <div class="col-md-6 col-lg-3">
              <div class="artikel-card h-100">
                <div class="artikel-image-wrapper">
                  <img src="{{ $article['image'] ?? asset('images/articles/nature-calm.jpg') }}"
                       alt="{{ $article['title'] }}"
                       class="artikel-image"
                       onerror="this.onerror=null;this.src='{{ asset('images/articles/music-therapy.jpg') }}';">
                  @if(isset($article['source']))
                    <span class="article-source-badge">
                      {{ strtoupper($article['source']) }}
                    </span>
                  @endif
                </div>
                <div class="artikel-content">
                  <h3 class="artikel-title">{{ $article['title'] }}</h3>
                  <p class="artikel-description">{{ $article['description'] }}</p>
                  {{-- Tanggal artikel--}}
                  <div class="mb-3">
                    <span class="artikel-date">{{ $article['date'] }}</span>
                  </div>
                  {{-- Baca Selengkapnya --}}
                  <div class="mt-auto">
                    <a href="{{ $article['url'] }}" target="_blank" class="artikel-link w-100 justify-content-center">
                      Baca Selengkapnya <span class="arrow">→</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
        @endforeach
      </div>
      {{-- Carousel--}}
      <div class="carousel-indicators-custom mt-4">
        @foreach($chunkedArticles as $index => $articleGroup)
        <button type="button"
                data-bs-target="#artikelCarousel"
                data-bs-slide-to="{{ $index }}"
                class="{{ $index === 0 ? 'active' : '' }}"
                aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                aria-label="Slide {{ $index + 1 }}">
        </button>
        @endforeach
      </div>
    </div>
    {{-- Scroll mobile layout --}}
    <div class="artikel-mobile-scroll d-md-none article-custom-padding">
      <div class="artikel-scroll-container">
        @foreach($articles as $article)
        <div class="artikel-scroll-item">
          <div class="artikel-card h-100">
            <div class="artikel-image-wrapper">
              <img src="{{ $article['image'] ?? asset('images/articles/nature-calm.jpg') }}"
                   alt="{{ $article['title'] }}"
                   class="artikel-image"
                   onerror="this.onerror=null;this.src='{{ asset('images/articles/nature-calm.jpg') }}';">
              @if(isset($article['source']))
                <span class="article-source-badge">
                  {{ strtoupper($article['source']) }}
                </span>
              @endif
            </div>
            <div class="artikel-content">
              <h3 class="artikel-title">{{ $article['title'] }}</h3>
              <p class="artikel-description">{{ $article['description'] }}</p>
              {{-- Tanggal artikel--}}
              <div class="mb-3">
                <span class="artikel-date">{{ $article['date'] }}</span>
              </div>
              {{-- Baca selengkapnya --}}
              <div class="mt-auto">
                <a href="{{ $article['url'] }}" target="_blank" class="artikel-link w-100 justify-content-center">
                  Baca Selengkapnya <span class="arrow">→</span>
                </a>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>
<style>
  .article-custom-padding {
    padding: 8px 30px;
  }
  .artikel-component .artikel-header {
    font-size: 1.2rem;
    font-weight: 700;
    color: #2b3674;
  }
  .carousel-nav .carousel-btn {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 2px solid #e0e5f2;
    background: #ffffff;
    color: #4255d9;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
  }
  .carousel-nav .carousel-btn:hover {
    background: #4255d9;
    border-color: #4255d9;
    color: #ffffff;
  }
  .carousel-nav .carousel-btn:active {
    transform: scale(0.95);
  }
  .carousel-indicators-custom {
    display: flex;
    justify-content: center;
    gap: 8px;
    padding: 0;
    margin: 0;
  }
  .carousel-indicators-custom button {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    border: none;
    background: #e0e5f2;
    cursor: pointer;
    transition: all 0.3s ease;
    padding: 0;
  }
  .carousel-indicators-custom button.active {
    background: #4255d9;
    width: 28px;
    border-radius: 5px;
  }
  .carousel-indicators-custom button:hover:not(.active) {
    background: #bcc5e0;
  }
  .artikel-scroll-container {
    display: flex;
    gap: 1rem;
    overflow-x: auto;
    scroll-snap-type: x mandatory;
    scroll-behavior: smooth;
    padding-bottom: 1rem;
    -webkit-overflow-scrolling: touch;
  }
  .artikel-scroll-container::-webkit-scrollbar {
    height: 6px;
  }
  .artikel-scroll-container::-webkit-scrollbar-track {
    background: #f0f0f5;
    border-radius: 3px;
  }
  .artikel-scroll-container::-webkit-scrollbar-thumb {
    background: #4255d9;
    border-radius: 3px;
  }
  .artikel-scroll-item {
    flex: 0 0 280px;
    scroll-snap-align: start;
  }
  .artikel-card {
    background: #ffffff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
  }
  .artikel-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 32px rgba(66, 85, 217, 0.15);
  }
  .artikel-image-wrapper {
    position: relative;
    width: 100%;
    height: 180px;
    overflow: hidden;
  }
  .artikel-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
  }
  .artikel-card:hover .artikel-image {
    transform: scale(1.08);
  }
  .artikel-content {
    padding: 1.25rem;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
  }
  .artikel-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: #2b3674;
    line-height: 1.4;
    margin-bottom: 0.75rem;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
  .artikel-description {
    font-size: 0.875rem;
    color: #6b7280;
    line-height: 1.6;
    margin-bottom: 0.5rem;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    flex-grow: 0;
  }
  .artikel-date {
    font-size: 0.8rem;
    color: #9ca3af;
    display: block;
  }
  .artikel-link {
    font-size: 0.875rem;
    font-weight: 600;
    color: #4255d9;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 0.25rem;
    transition: color 0.2s ease, gap 0.2s ease;
    padding-top: 0.75rem;
    border-top: 1px solid #f0f0f5;
  }
  .artikel-link:hover {
    color: #3144b5;
    gap: 0.5rem;
  }
  .artikel-link .arrow {
    transition: transform 0.2s ease;
  }
  .artikel-link:hover .arrow {
    transform: translateX(4px);
  }
  .article-source-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    background: rgba(66, 85, 217, 0.9);
    color: white;
    padding: 3px 8px;
    border-radius: 12px;
    font-size: 0.7rem;
    font-weight: 600;
    z-index: 2;
  }


  /* Responsive - Tablet */
  @media (max-width: 991.98px) {
    .artikel-component .artikel-header {
      font-size: 1.3rem;
    }
    .artikel-image-wrapper {
      height: 160px;
    }
    .artikel-title {
      font-size: 1rem;
    }
    .article-custom-padding {
      padding: 8px 24px;
    }
    .carousel-nav .carousel-btn {
      width: 36px;
      height: 36px;
    }
  }


  /* Mobile Specific */
  @media (max-width: 767.98px) {
    .article-custom-padding {
        padding: 8px 16px;
    }
    .artikel-component .artikel-header {
      font-size: 1.1rem;
    }
    .artikel-scroll-item {
      flex: 0 0 260px;
    }
    .artikel-scroll-item .artikel-image-wrapper {
      height: 150px;
    }
    .artikel-scroll-item .artikel-content {
      padding: 1rem;
    }
    .artikel-scroll-item .artikel-title {
      font-size: 0.95rem;
    }
    .artikel-scroll-item .artikel-description {
      font-size: 0.8rem;
      -webkit-line-clamp: 2;
    }
    .artikel-scroll-item .artikel-date {
      font-size: 0.7rem;
    }
    .artikel-scroll-item .artikel-link {
      font-size: 0.8rem;
    }
  }
  /* Small Mobile */
  @media (max-width: 480px) {
    .artikel-scroll-item {
      flex: 0 0 240px;
    }
    .artikel-scroll-item .artikel-image-wrapper {
      height: 140px;
    }
  }
</style>

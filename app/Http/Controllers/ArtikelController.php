<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ArtikelController extends Controller
{
    /**
     * URL API NewsData.io
     * Mengambil artikel kesehatan mental di Indonesia
     */
    private $newsApiUrl = 'https://newsdata.io/api/1/latest?apikey=pub_808ba9013a304b64a1eeea0ddc3c31c2&q=Kesehatan%20Mental&country=id&language=id&category=health&timezone=Asia/Jakarta';

    public function getArticles()
    {
        // Cache selama 6 jam (21600 detik) untuk menghemat kuota API
        return Cache::remember('newsdata_mental_health_v11', 21600, function () {
            Log::info('Memulai pengambilan artikel dari NewsData.io...');

            $articles = $this->fetchFromAPI();

            // Logika baru: Pastikan total 8 artikel
            $needed = 8 - count($articles);

            if ($needed > 0) {
                Log::info("API hanya returning " . count($articles) . ", mengambil $needed fallback.");
                $fallbacks = $this->getFallbackArticles();

                // Ambil fallback secukupnya untuk digabung
                $extras = array_slice($fallbacks, 0, $needed);
                $articles = array_merge($articles, $extras);
            }

            // Pastikan tepat 8
            return array_slice($articles, 0, 8);
        });
    }

    private function fetchFromAPI()
    {
        try {
            $response = Http::timeout(15)->get($this->newsApiUrl);

            if ($response->successful()) {
                $data = $response->json();

                if (!isset($data['results'])) {
                    return [];
                }

                $mappedArticles = [];
                $count = 0;

                foreach ($data['results'] as $item) {
                    // Cek image_url, jika null gunakan fallback
                    $image = $item['image_url'];
                    if (!$image) {
                        $image = $this->getRandomImage($count);
                    }

                    $mappedArticles[] = [
                        'id' => $item['article_id'] ?? md5($item['link']),
                        'title' => $item['title'],
                        // Batasi deskripsi dan bersihkan tag HTML jika ada
                        'description' => \Illuminate\Support\Str::limit(strip_tags($item['description']), 120),
                        'image' => $image,
                        'date' => $this->formatDateString($item['pubDate'] ?? now()),
                        'url' => $item['link'],
                        'category' => 'mental-health',
                        'source' => $item['source_name'] ?? 'News',
                    ];
                    $count++;
                }

                return $mappedArticles;
            } else {
                Log::error('NewsData API Error: ' . $response->status() . ' - ' . $response->body());
                return [];
            }

        } catch (\Exception $e) {
            Log::error('NewsData API Exception: ' . $e->getMessage());
            return [];
        }
    }

    private function getRandomImage($index)
    {
        // gambar lokal sebagai fallback
        $images = [
            asset('images/articles/nature-calm.jpg'),
            asset('images/articles/tech-mental.jpg'),
            asset('images/articles/music-therapy.jpg'),
            asset('images/articles/positive-morning.jpg'),
            'https://images.unsplash.com/photo-1493836512294-502baa1986e2?w=500&auto=format&fit=crop&q=60',
            'https://images.unsplash.com/photo-1544367563-12123d8ab9e6?w=500&auto=format&fit=crop&q=60',
            'https://images.unsplash.com/photo-1527137342181-19aab11a8ee8?w=500&auto=format&fit=crop&q=60',
            'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=500&auto=format&fit=crop&q=60'
        ];

        return $images[$index % count($images)];
    }

    private function formatDateString($dateString)
    {
        try {
            $date = \Carbon\Carbon::parse($dateString);
            return $this->formatDate($date);
        } catch (\Exception $e) {
            return $this->formatDate(now());
        }
    }

    private function formatDate($date)
    {
        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        return $date->day . ' ' . $months[$date->month] . ' ' . $date->year;
    }

    /*Fallback Articles (Static)*/
    private function getFallbackArticles()
    {
        $base = [
            [
                'id' => 1,
                'title' => 'Pentingnya Menjaga Kesehatan Mental di Era Digital',
                'description' => 'Di era serba digital, menjaga kewarasan dan kesehatan mental menjadi tantangan tersendiri.',
                'image' => asset('images/articles/tech-mental.jpg'),
                'url' => 'https://www.halodoc.com/artikel/ini-alasan-pentingnya-menjaga-kesehatan-mental',
            ],
            [
                'id' => 2,
                'title' => 'Tips Mengelola Stres Pekerjaan',
                'description' => 'Kenali tanda-tanda burnout dan cara mengatasinya agar tetap produktif dan bahagia.',
                'image' => asset('images/articles/nature-calm.jpg'),
                'url' => 'https://www.alodokter.com/kenali-jenis-stres-kerja-dan-cara-mengatasinya',
            ],
            [
                'id' => 3,
                'title' => 'Meditasi untuk Pemula',
                'description' => 'Panduan singkat memulai kebiasaan meditasi untuk ketenangan pikiran.',
                'image' => asset('images/articles/music-therapy.jpg'),
                'url' => 'https://www.halodoc.com/artikel/ini-cara-meditasi-yang-benar-untuk-pemula',
            ],
            [
                'id' => 4,
                'title' => 'Pola Tidur dan Kesehatan Jiwa',
                'description' => 'Hubungan erat antara kualitas tidur yang baik dengan stabilitas emosi.',
                'image' => asset('images/articles/positive-morning.jpg'),
                'url' => 'https://hellosehat.com/mental/hubungan-tidur-dan-mental/',
            ]
        ];

        $articles = $base;
        // Gandakan agar slider penuh jika perlu
        foreach($base as $item) {
            $newItem = $item;
            $newItem['id'] += 4;
            $newItem['title'] .= ' (Part 2)';
            $articles[] = $newItem;
        }

        return array_map(function($item) {
            $item['date'] = $this->formatDate(now());
            $item['category'] = 'mental-health';
            $item['source'] = 'Recalm';
            // URL sudah didefinisikan secara eksplisit di atas, jangan ditimpa Google Search
            return $item;
        }, $articles);
    }

    public function refreshCache()
    {
        Cache::forget('newsdata_mental_health_v8');
        return response()->json(['message' => 'Cache cleared']);
    }
}

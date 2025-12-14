<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;


class ArtikelController extends Controller
{
    /**
     * Konfigurasi RSS Feeds
     * Menggunakan Google News RSS dengan query spesifik "Kesehatan Mental"
     * untuk mendapatkan artikel yang 100% relevan berbahasa Indonesia.
     */
    private $rssFeeds = [
        [
            // Query: "Kesehatan Mental" OR "Psikologi" OR "Kesehatan Jiwa"
            'url' => 'https://news.google.com/rss/search?q=kesehatan+mental+OR+psikologi+OR+kesehatan+jiwa+when:7d&hl=id-ID&gl=ID&ceid=ID:id',
            'source' => 'Google News',
            'category' => 'Mental Health'
        ]
    ];
    public function getArticles()
    {
        return Cache::remember('indo_mental_health_articles_fixed_v2', 43200, function () {
            Log::info('Memulai pengambilan artikel Kesehatan Mental (Google News)...');


            $articles = $this->fetchFromRSS();


            if ($articles && count($articles) >= 4) {
                Log::info('Berhasil ambil ' . count($articles) . ' artikel dari RSS');
                return array_slice($articles, 0, 8);
            }


            Log::warning('Gagal ambil RSS atau kurang dari 4, fallback ke artikel statis');
            return $this->getFallbackArticles();
        });
    }
    private function fetchFromRSS()
    {
        $allArticles = [];
        foreach ($this->rssFeeds as $feed) {
            try {
                Log::info('Fetching RSS: ' . $feed['url']);


                $response = Http::timeout(15)->get($feed['url']);


                if (!$response->successful()) {
                    Log::warning('Gagal fetch RSS ' . $feed['source'] . ': ' . $response->status());
                    continue;
                }
                $xmlContent = $response->body();
                $rss = simplexml_load_string($xmlContent, 'SimpleXMLElement', LIBXML_NOCDATA);
                if ($rss === false) {
                    continue;
                }


                $items = $rss->channel->item;
                $count = 0;


                foreach ($items as $item) {
                    if ($count >= 15) break;


                    $title = (string)$item->title;
                    $title = preg_replace('/ - .+$/', '', $title);


                    $link = (string)$item->link;
                    $pubDate = (string)$item->pubDate;
                    $descriptionRaw = (string)$item->description;
                    $cleanDescription = $this->cleanDescription($descriptionRaw);
                    $image = $this->getRandomImage($count);


                    $allArticles[] = [
                        'id' => md5($link),
                        'title' => $title,
                        'description' => $cleanDescription,
                        'image' => $image,
                        'date' => $this->formatDateString($pubDate),
                        'url' => $link,
                        'category' => 'mental-health',
                        'source' => (string)$item->source ?? 'News'
                    ];


                    $count++;
                }
            } catch (\Exception $e) {
                Log::error('RSS Error: ' . $e->getMessage());
            }
        }
        return $allArticles;
    }
    private function cleanDescription($html)
    {
        $text = html_entity_decode($html);
        $text = strip_tags($text);
        $text = preg_replace('/^.*?&nbsp;/', '', $text);
        return \Illuminate\Support\Str::limit(trim($text), 120);
    }
    private function getRandomImage($index)
    {
        // gambar lokal
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
                'url' => '#',
            ],
            [
                'id' => 2,
                'title' => 'Tips Mengelola Stres Pekerjaan',
                'description' => 'Kenali tanda-tanda burnout dan cara mengatasinya agar tetap produktif dan bahagia.',
                'image' => asset('images/articles/nature-calm.jpg'),
                'url' => '#',
            ],
            [
                'id' => 3,
                'title' => 'Meditasi untuk Pemula',
                'description' => 'Panduan singkat memulai kebiasaan meditasi untuk ketenangan pikiran.',
                'image' => asset('images/articles/music-therapy.jpg'),
                'url' => '#',
            ],
            [
                'id' => 4,
                'title' => 'Pola Tidur dan Kesehatan Jiwa',
                'description' => 'Hubungan erat antara kualitas tidur yang baik dengan stabilitas emosi.',
                'image' => asset('images/articles/positive-morning.jpg'),
                'url' => '#',
            ]
        ];
        $articles = $base;
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
            return $item;
        }, $articles);
    }
    public function refreshCache()
    {
        Cache::forget('indo_mental_health_articles_fixed_v2');
        return response()->json(['message' => 'Cache cleared']);
    }
}

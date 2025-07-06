<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\Berita;
use Carbon\Carbon;

class ScrapeMetanoiacNews extends Command
{
    protected $signature = 'scrape:metanoiac';
    protected $description = 'Ambil berita terbaru dari metanoiac.id (maksimal 20 berita, hanya yang 3 hari terakhir)';

    public function handle()
    {
        $client = new Client(['verify' => false]);
        $url = 'https://www.metanoiac.id/';

        $this->info("🌐 Mengakses $url ...");

        try {
            $response = $client->request('GET', $url);
            $html = $response->getBody()->getContents();
            $crawler = new Crawler($html);

            // Ambil maksimal 20 berita
            $crawler->filter('.td_module_flex .entry-title a')->slice(0, 20)->each(function ($node) use ($client) {
                $title = trim($node->text());
                $url = $node->attr('href');

                // Lewati jika berita sudah ada
                if (Berita::where('url', $url)->exists()) {
                    $this->info("⚠️ Lewati (sudah ada): $title");
                    return;
                }

                $gambar = null;
                $published_at = now(); // fallback default

                try {
                    // Ambil detail halaman berita
                    $res = $client->request('GET', $url);
                    $detailHtml = $res->getBody()->getContents();
                    $detailCrawler = new Crawler($detailHtml);

                    // Ambil gambar utama dari meta tag atau <img>
                    $ogImageNode = $detailCrawler->filterXPath('//meta[@property="og:image"]');
                    if ($ogImageNode->count() > 0) {
                        $gambar = $ogImageNode->attr('content');
                    } else {
                        $imgNode = $detailCrawler->filter('img');
                        if ($imgNode->count() > 0) {
                            $gambar = $imgNode->first()->attr('src');
                        }
                    }

                    // Normalisasi URL gambar
                    if ($gambar) {
                        if (str_starts_with($gambar, '//')) {
                            $gambar = 'https:' . $gambar;
                        } elseif (str_starts_with($gambar, '/')) {
                            $gambar = 'https://www.metanoiac.id' . $gambar;
                        }
                    }

                    // Ambil tanggal publikasi
                    $dateNode = $detailCrawler->filter('.td-post-date time');
                    if ($dateNode->count()) {
                        $dateText = $dateNode->text();
                        try {
                            $published_at = Carbon::parse($dateText);
                        } catch (\Exception $e) {
                            $this->warn("📅 Gagal parsing tanggal: $dateText");
                        }
                    }

                    // Lewati jika berita lebih dari 3 hari lalu
                    if ($published_at->lt(now()->subDays(3))) {
                        $this->info("⏳ Lewati (berita lama): $title");
                        return;
                    }

                } catch (\Exception $e) {
                    $this->error("❌ Gagal ambil detail: " . $e->getMessage());
                    return;
                }

                // Simpan ke database
                Berita::create([
                    'judul' => $title,
                    'url' => $url,
                    'sumber' => 'Metanoiac',
                    'gambar' => $gambar,
                    'created_at' => $published_at,
                    'updated_at' => now(),
                ]);

                $this->info("✅ Disimpan: $title");
            });

            $this->info('🎉 Scraping selesai!');
        } catch (\Exception $e) {
            $this->error("❌ Error: " . $e->getMessage());
        }
    }
}

<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\ParseInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;

class ParseOlxPriceService implements ParseInterface
{
    public function parse(string $url): ?string
    {
        try {
            $page = Http::get($url)->body();
            $crawler = new Crawler($page);

            $div = $crawler->filter('div[data-testid="ad-price-container"]')->eq(0);

            if ($div->count() > 0) {
                return $div->filter('h3')->text(null, false);
            }

            return null;
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return null;
        }
    }
}

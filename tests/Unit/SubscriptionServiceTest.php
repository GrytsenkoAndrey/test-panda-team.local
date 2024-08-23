<?php

namespace Tests\Unit;

use App\Services\ParseOlxPriceService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class SubscriptionServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function priceReturned(): void
    {
        Http::fake([
            'http://example.com' => Http::response(
                '<div data-testid="ad-price-container"><h3>1000</h3></div>',
                Response::HTTP_OK
            ),
        ]);

        $service = new ParseOlxPriceService();
        $price = $service->parse('http://example.com');

        $this->assertEquals('1000', $price);
    }

    /**
     * @test
     */
    public function nullReturned(): void
    {
        Http::fake([
            'http://example.com' => Http::response(
                '<div data-testid="ad-price-container"></div>',
                Response::HTTP_OK
            ),
        ]);

        $service = new ParseOlxPriceService();
        $price = $service->parse('http://example.com');

        $this->assertNull($price);
    }

    /**
     * @test
     */
    public function priceContainerDoesntExist(): void
    {
        Http::fake([
            'http://example.com' => Http::response('<div></div>', Response::HTTP_OK),
        ]);

        $service = new ParseOlxPriceService();
        $price = $service->parse('http://example.com');

        $this->assertNull($price);
    }
}

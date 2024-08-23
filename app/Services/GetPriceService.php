<?php

declare(strict_types=1);

namespace App\Services;

class GetPriceService
{
    public static function getPrice(string $priceHtml): ?float
    {
        return (float) str_replace(' ', '', $priceHtml);
    }
}

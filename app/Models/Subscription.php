<?php

namespace App\Models;

use App\Schemes\SubscriptionSchemeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model implements SubscriptionSchemeInterface
{
    use HasFactory;

    protected $fillable = [
        self::URL,
        self::PRICE,
        self::EMAIL,
    ];

    protected $casts = [
        self::PRICE => 'float',
    ];
}

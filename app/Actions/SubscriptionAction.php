<?php

declare(strict_types=1);

namespace App\Actions;

use App\Mail\SubscribedMail;
use App\Models\Subscription;
use Illuminate\Support\Facades\Mail;

class SubscriptionAction
{
    public function handle(...$args): void
    {
        [$price, ['url' => $url, 'email' => $email]] = $args;

        Subscription::updateOrCreate(
            [
                'url' => $url,
                'email' => $email,
            ], [
                'price' => $price,
            ]
        );

        Mail::to($email)->send(new SubscribedMail($url));
    }
}

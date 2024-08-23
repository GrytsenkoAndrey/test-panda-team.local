<?php

namespace Tests\Unit;

use App\Actions\SubscriptionAction;
use App\Mail\SubscribedMail;
use App\Models\Subscription;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SubscriptionActionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function handle_creates_subscription_and_sends_email(): void
    {
        Mail::fake();
        $action = new SubscriptionAction();
        $price = 100;
        $url = 'http://example.com';
        $email = 'test@example.com';

        $action->handle($price, ['url' => $url, 'email' => $email]);

        $this->assertDatabaseHas('subscriptions', [
            'url' => $url,
            'email' => $email,
            'price' => $price,
        ]);

        Mail::assertSent(SubscribedMail::class, function ($mail) use ($email) {
            return $mail->hasTo($email);
        });
    }

    /**
     * @test
     */
    public function does_not_create_duplicate_subscription(): void
    {
        Mail::fake();
        $action = new SubscriptionAction();
        $subs = Subscription::factory()->create();

        $action->handle($subs->price, ['url' => $subs->url, 'email' => $subs->email]);

        $this->assertCount(1, Subscription::where('url', $subs->url)->where('email', $subs->email)->get());

        Mail::assertSent(SubscribedMail::class, function ($mail) use ($subs) {
            return $mail->hasTo($subs->email);
        });
    }
}

<?php

namespace App\Console\Commands;

use App\Mail\PriceChangedMail;
use App\Models\Subscription;
use App\Services\GetPriceService;
use App\Services\ParseOlxPriceService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CheckSubcriptionPriceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-subcription-price-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check subscription price';

    /**
     * Execute the console command.
     */
    public function handle(
        ParseOlxPriceService $parseOlxPriceService,
        GetPriceService $getPriceService
    ) {
        $this->info('Check subscription price');
        $bar = $this->output->createProgressBar(Subscription::count());

        $bar->start();

        foreach (Subscription::get(['url', 'email', 'price', 'updated_at']) as $subscription) {
            $element = $parseOlxPriceService->parse($subscription->url);
            if (! $element) {
                $bar->advance();
                continue;
            }

            $currentPrice = GetPriceService::getPrice($element);
            $savedPrice = $subscription->price;
            if ($currentPrice === $savedPrice) {
                $bar->advance();
                continue;
            }

            $subscription->update(['price' => $currentPrice]);
            Mail::to($subscription->email)
                ->send(new PriceChangedMail(
                    url: $subscription->url,
                    oldPrice: number_format($savedPrice, 2, '.'),
                    newPrice: number_format($currentPrice, 2, '.')
                ));

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
    }
}

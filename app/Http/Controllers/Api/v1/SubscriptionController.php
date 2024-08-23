<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\SubscriptionAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubscribeRequest;
use App\Services\GetPriceService;
use App\Services\ParseOlxPriceService;
use Symfony\Component\HttpFoundation\Response;

class SubscriptionController extends Controller
{
    public function __construct(
        private ParseOlxPriceService $parseOlxPriceService,
        private SubscriptionAction $subscriptionAction
    ) {}

    public function __invoke(SubscribeRequest $request)
    {
        $htmlPrice = $this->parseOlxPriceService->parse($request->url);

        if (! $htmlPrice) {
            return response()->json(['message' => 'There is no price element on the page'], Response::HTTP_NOT_FOUND);
        }

        $this->subscriptionAction->handle(
            GetPriceService::getPrice($htmlPrice),
            $request->validated()
        );

        return response()->json(['message' => 'Subscribed']);
    }
}

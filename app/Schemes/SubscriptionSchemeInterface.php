<?php

declare(strict_types=1);

namespace App\Schemes;

interface SubscriptionSchemeInterface
{
    public const string TABLE = 'subscriptions';

    public const string ID = 'id';

    public const string URL = 'url';

    public const string PRICE = 'price';

    public const string EMAIL = 'email';
}

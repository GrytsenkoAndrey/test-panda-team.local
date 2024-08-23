<?php

declare(strict_types=1);

namespace App\Contracts;

interface ParseInterface
{
    public function parse(string $url): ?string;
}

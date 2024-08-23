<?php

namespace Tests\Feature;

use Tests\TestCase;

class SubscriptionControllerTest extends TestCase
{
    /**
     * @test
     */
    public function notFoundPrice(): void
    {
        $r = $this->post('/api/v1/subscription', [
            'url' => 'http://example.com',
            'email' => 'test@test.com',
        ]);

        $this->assertJson($r->getContent());
    }
}

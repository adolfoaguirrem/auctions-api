<?php

namespace App\Tests\Functional\Application\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AuctionResultServiceFunctionalTest  extends WebTestCase
{
    public function testAuctionResultService()
    {
        $client = static::createClient();

        $client->request('GET', '/api/bid/1/result');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $response  = $client->getResponse()->getContent();
        $data  = json_decode($response, true);

        $this->assertArrayHasKey('product', $data);
        $this->assertArrayHasKey('total_bids', $data);
        $this->assertArrayHasKey('winning_bid', $data);
        $this->assertArrayHasKey('buyer', $data['winning_bid']);
        $this->assertArrayHasKey('amount', $data['winning_bid']);
    }
}

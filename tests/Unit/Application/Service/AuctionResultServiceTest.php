<?php

namespace App\Tests\Unit\Application\Service;

use App\Domain\Entity\Buyer\Buyer;
use App\Domain\Entity\Product\Product;
use App\Application\UseCases\FindBuyerUseCase;
use App\Application\UseCases\FindProductUseCase;
use App\Application\Service\AuctionResultService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Application\UseCases\findBidsForProductUseCase;

class AuctionResultServiceTest extends WebTestCase
{
    public function testExecuteWithNoBids()
    {
        // Mock the dependencies
        $findProductUseCase = $this->createMock(FindProductUseCase::class);
        $findBidsForProductUseCase = $this->createMock(FindBidsForProductUseCase::class);
        $findBuyerUseCase = $this->createMock(FindBuyerUseCase::class);

        $product = new Product('Test Product', 100.0);
        $buyer = new Buyer('Test Buyer');

        // Configure the mocks
        $findProductUseCase->method('execute')->willReturn($product);
        $findBidsForProductUseCase->method('execute')->willReturn([]);
        $findBuyerUseCase->method('execute')->willReturn($buyer);

        $auctionResultService = new AuctionResultService($findProductUseCase, $findBidsForProductUseCase, $findBuyerUseCase);

        $result = $auctionResultService->execute(1);

        $this->assertArrayHasKey('winning_bid', $result);
        $this->assertEquals('No offers', $result['winning_bid']['buyer']);
        // More assertions...
    }
}

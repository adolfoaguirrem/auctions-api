<?php



namespace App\Tests\Unit\UseCase;

use App\Domain\Entity\Bid\Bid;
use PHPUnit\Framework\TestCase;
use App\Domain\Entity\Buyer\Buyer;
use App\Domain\Entity\Product\Product;
use App\Application\UseCases\CreateBidUseCase;
use App\Application\UseCases\FindBuyerUseCase;
use App\Application\UseCases\FindProductUseCase;
use App\Domain\Entity\Bid\Repository\BidInterface;

class CreateBidUseCaseTest extends TestCase
{
    public function testAddBid()
    {
        $bidRepositoryMock = $this->createMock(BidInterface::class);
        $findBuyerUseCaseMock = $this->createMock(FindBuyerUseCase::class);
        $findProductUseCaseMock = $this->createMock(FindProductUseCase::class);

        $buyerId = 1; 
        $productId = 1;
        $amount = 150.0;

        $buyer = $this->createMock(Buyer::class);
        $buyer->method('getId')->willReturn($buyerId);

        $product = $this->createMock(Product::class);
        $product->method('getId')->willReturn($productId);

        $findBuyerUseCaseMock->expects($this->once())
            ->method('execute')
            ->willReturn($buyer);

        $findProductUseCaseMock->expects($this->once())
            ->method('execute')
            ->willReturn($product);

        $bidRepositoryMock->expects($this->once())
            ->method('save');

        $createBidUseCase = new CreateBidUseCase(
            $bidRepositoryMock,
            $findBuyerUseCaseMock,
            $findProductUseCaseMock
        );

        $data = [
            'productId' => $productId,
            'buyerId' => $buyerId,
            'amount' => $amount,
        ];

        $bid = $createBidUseCase->execute($data);

        $this->assertInstanceOf(Bid::class, $bid);
        $this->assertSame($productId, $bid->getProductId());
        $this->assertSame($buyerId, $bid->getBuyerId());
        $this->assertEquals($amount, $bid->getAmount()->value());
    }

    public function testAddBidWithNegativeAmount()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Bid amount must be greater than 0.');

        $bidRepository = $this->createMock(BidInterface::class);
        $findBuyer = $this->createMock(FindBuyerUseCase::class);
        $findProduct = $this->createMock(FindProductUseCase::class);

        // Simulate a JSON request parameters array
        $requestParams = [
            'productId' => 1,
            'buyerId' => 1,
            'amount' => -100.0,
        ];

        $createCreateBidUseCase = new CreateBidUseCase($bidRepository, $findBuyer, $findProduct);

        $createCreateBidUseCase->execute($requestParams);
    }
}

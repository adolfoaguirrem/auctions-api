<?php

namespace App\Application\UseCases;

use App\Domain\Entity\Bid\Bid;
use App\Application\UseCases\FindBuyerUseCase;
use App\Application\UseCases\FindProductUseCase;
use App\Domain\Entity\Bid\ValueObject\BidAmount;
use App\Domain\Entity\Bid\Repository\BidInterface;


class CreateBidUseCase
{
    public function __construct(
        private BidInterface $bidRepository,
        private FindBuyerUseCase $findBuyerUseCase,
        private FindProductUseCase $findProductUseCase
    ) {
    }

    public function execute($data): Bid
    {
        $product = $this->findProductUseCase->execute($data['productId']);

        $buyer = $this->findBuyerUseCase->execute($data['buyerId']);

        $amount = $data['amount'];

        $bid = new Bid(
            $product->getId(),
            $buyer->getId(),
            new BidAmount($amount)
        );

        $this->bidRepository->save($bid);

        return $bid;
    }
}

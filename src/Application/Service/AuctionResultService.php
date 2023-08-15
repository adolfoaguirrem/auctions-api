<?php

namespace App\Application\Service;

use App\Application\UseCases\FindBuyerUseCase;
use App\Application\UseCases\FindProductUseCase;
use App\Application\UseCases\findBidsForProductUseCase;


/**
 * Class AuctionResultService
 * 
 * Get the winning buyer for a product auction
 */
class AuctionResultService
{
    public function __construct(
        private FindProductUseCase $findProductUseCase,
        private findBidsForProductUseCase $findBidsForProductUseCase,
        private FindBuyerUseCase $findBuyerUseCase
    ) {
    }

    public function execute(int $productId): array
    {

        $product = $this->findProductUseCase->execute($productId);
        $productBids = $this->findBidsForProductUseCase->execute($product);
        $winningBid = $this->findWinningBid($productBids, $product->getPrice()->value());

        return [
            'product' => [
                'name' => $product->getName()->value(),
                'price' => $product->getPrice()->value(),
            ],
            'total_bids' => count($productBids),
            'winning_bid' => $winningBid
        ];
    }

    private function findWinningBid(array $bids, float $defaultPrice): array
    {
        if (empty($bids)) {
            return [
                'buyer' => 'No offers',
                'amount' => (float) $defaultPrice
            ];
        }

        $highestBid = null;

        foreach ($bids as $bid) {
            if ($highestBid === null || $bid['amount'] > $highestBid['amount']) {
                $highestBid = $bid;
            }
        }

        $buyer = $this->findBuyerUseCase->execute($highestBid['buyerId']);

        return [
            'buyer' => $buyer->getName()->value(),
            'amount' => (float) $highestBid['amount']
        ];
    }
}

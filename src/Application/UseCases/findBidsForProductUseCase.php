<?php

namespace App\Application\UseCases;

use App\Domain\Entity\Bid\Bid;
use App\Domain\Entity\Bid\Repository\BidInterface;
use App\Domain\Entity\Product\Product;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class findBidsForProductUseCase
{

    public function __construct(private BidInterface $bidRepository)
    {
    }

    public function execute(Product $product): array
    {

        $bids = $this->bidRepository->findBidsForProduct($product->getId());

        return $bids;
    }
}

<?php
namespace App\Domain\Entity\Bid\Repository;

use App\Domain\Entity\Bid\Bid;

interface BidInterface
{
    public function save(Bid $bid);
    public function findBidsForProduct(int $productId): array;
}

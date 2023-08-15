<?php

namespace App\Domain\Entity\Buyer\Repository;

use App\Domain\Entity\Buyer\Buyer;

interface BuyerInterface
{
    public function save(Buyer $buyer): void;
    public function findById(int $id): ?Buyer;
}

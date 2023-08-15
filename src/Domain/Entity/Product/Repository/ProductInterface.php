<?php

namespace App\Domain\Entity\Product\Repository;

use App\Domain\Entity\Product\Product;

interface ProductInterface
{
    public function save(Product $product): void;
    public function findById(int $id): ?Product;
}

<?php

namespace App\Application\UseCases;

use App\Domain\Entity\Product\Product;
use App\Domain\Entity\Product\ValueObject\ProductName;
use App\Domain\Entity\Product\ValueObject\ProductPrice;
use App\Domain\Entity\Product\Repository\ProductInterface;

class CreateProductUseCase
{
    public function __construct(private ProductInterface $productRepository)
    {
    }

    public function execute($data): Product
    {
        $product = new Product($data['name'], $data['price']);

        $this->productRepository->save($product);

        return $product;
    }
}

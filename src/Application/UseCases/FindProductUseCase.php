<?php

namespace App\Application\UseCases;

use App\Domain\Entity\Product\Product;
use App\Domain\Entity\Product\ValueObject\ProductName;
use App\Domain\Entity\Product\ValueObject\ProductPrice;
use App\Domain\Entity\Product\Repository\ProductInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FindProductUseCase
{

    public function __construct(private ProductInterface $productRepository)
    {
    }

    public function execute($productId): Product
    {

        $product = $this->productRepository->findById($productId);

        if (is_null($product)) {
            return throw new NotFoundHttpException('Product not found');
        }

        return $product;
    }
}

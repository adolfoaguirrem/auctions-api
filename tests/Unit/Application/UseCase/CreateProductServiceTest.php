<?php

namespace App\Tests\Unit\UseCase;

use PHPUnit\Framework\TestCase;
use App\Domain\Entity\Product\Product;
use App\Application\UseCases\CreateProductUseCase;
use App\Infrastructure\Persistence\DoctrineProductRepository;

class CreateProductUseCaseTest extends TestCase
{
    public function testCreateProduct()
    {
        $repository = $this->createMock(DoctrineProductRepository::class);

        $repository->expects($this->once())->method('save');

        // Simulate a JSON request parameters array
        $requestParams = [
            'name' => "Test Product",
            'price' => 100.0,
        ];

        $createProductUseCase = new CreateProductUseCase($repository);

        $product = $createProductUseCase->execute($requestParams);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals('Test Product', $product->getName()->value());
        $this->assertEquals(100.0, $product->getPrice()->value());
    }
}

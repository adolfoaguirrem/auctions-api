<?php

namespace App\Tests\Unit\Domain\Entity;

use PHPUnit\Framework\TestCase;
use App\Domain\Entity\Product\Product;
use App\Domain\Entity\Product\ValueObject\ProductName;
use App\Domain\Entity\Product\ValueObject\ProductPrice;

class ProductTest extends TestCase
{
    public function testProductConstructor()
    {
        $product = new Product('Test Product', 100.0);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals('Test Product', $product->getName()->value());
        $this->assertEquals(100.0, $product->getPrice()->value());
    }

    public function testProductSetName()
    {
        $product = new Product('Old Name', 100.0);
        $newName = new ProductName('New Name');

        $product->setName($newName);

        $this->assertEquals('New Name', $product->getName()->value());
    }

    public function testProductSetPrice()
    {
        $product = new Product('Test Product', 100.0);
        $newPrice = new ProductPrice(150.0);

        $product->setPrice($newPrice);
        $this->assertEquals(150.0, $product->getPrice()->value());
    }
}

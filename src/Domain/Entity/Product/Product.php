<?php

declare(strict_types=1);

namespace App\Domain\Entity\Product;

use App\Domain\Entity\Product\ValueObject\ProductName;
use App\Domain\Entity\Product\ValueObject\ProductPrice;

/**
 * Class Product
 * 
 * Represents a Product
 * @property string $name representing Products name
 * @property float $price representing Products price
 * @package App\Domain\Entity\Product
 */
class Product
{
    private ?int $id = null;

    public function __construct(private string $name, private float $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    /**
     * Get product Id 
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Product Name
     */

    public function setName(ProductName $name): self
    {
        $this->name = $name->value();
        return $this;
    }

    /**
     * Get Product Name
     */

    public function getName(): ProductName
    {
        return new ProductName($this->name);
    }


    /**
     * Product Price
     */

    public function setPrice(ProductPrice $price): self
    {
        $this->price = $price->value();
        return $this;
    }

    /**
     * Get Product Price
     */
    public function getPrice(): ProductPrice
    {
        return new ProductPrice($this->price);
    }
}

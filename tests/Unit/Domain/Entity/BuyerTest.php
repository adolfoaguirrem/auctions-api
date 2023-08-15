<?php

namespace App\Tests\Unit\Domain\Entity;

use PHPUnit\Framework\TestCase;
use App\Domain\Entity\Buyer\Buyer;
use App\Domain\Entity\Buyer\ValueObject\BuyerName;

class BuyerTest extends TestCase
{
    public function testBuyerConstructor()
    {
        $buyer = new Buyer('John Doe');

        $this->assertInstanceOf(Buyer::class, $buyer);
        $this->assertEquals('John Doe', $buyer->getName()->value());
    }

    public function testBuyerSetName()
    {
        $buyer = new Buyer('Old Name');
        $newName = new BuyerName('New Name');

        $buyer->setName($newName);

        $this->assertEquals('New Name', $buyer->getName()->value());
    }

    // Add more tests as needed for edge cases and additional methods
}

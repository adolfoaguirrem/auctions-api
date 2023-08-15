<?php

declare(strict_types=1);

namespace App\Domain\Entity\Bid;

use App\Domain\Entity\Bid\ValueObject\BidAmount;

/**
 * Class Bid
 * @package App\Domain\Entity\Bid
 */
class Bid
{
    private $id;
    private $productId;
    private $buyerId;
    private $amount;

    public function __construct(int $productId, int $buyerId, BidAmount $amount)
    {
        $this->productId = $productId;
        $this->buyerId = $buyerId;
        $this->amount = $amount;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getBuyerId(): int
    {
        return $this->buyerId;
    }

    public function getAmount(): BidAmount
    {
        return $this->amount;
    }
}

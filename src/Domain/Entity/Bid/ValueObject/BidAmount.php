<?php

declare(strict_types=1);

namespace App\Domain\Entity\Bid\ValueObject;

use InvalidArgumentException;

final class BidAmount
{

    private $amount;

    public function __construct(float $amount)
    {
        $this->validate($amount);
        $this->amount = $amount;
    }

    /**
     * amount
     *
     */
    public function value(): float
    {
        return $this->amount;
    }

    public function __toString()
    {
        return (string) $this->amount;
    }

    public function validate($amount)
    {
        if (is_null($amount)) {
            throw new InvalidArgumentException('The bid cannot be null.');
        }

        if ($amount <= 0) {
            throw new InvalidArgumentException('Bid amount must be greater than 0.');
        }
    }
}

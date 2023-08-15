<?php

declare(strict_types=1);

namespace App\Domain\Entity\Buyer;

use App\Domain\Entity\Buyer\ValueObject\BuyerName;

/**
 * Class Buyer
 * Represents a Buyer
 * @property string $name representing Buyer name
 * @package App\Domain\Entity\Buyer
 */
class Buyer
{
    private ?int $id = null;

    public function __construct(private string $name)
    {
        $this->name = $name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setName(BuyerName $name): self
    {
        $this->name = $name->value();
        return $this;
    }

    public function getName(): BuyerName
    {
        return new BuyerName($this->name);
    }
}

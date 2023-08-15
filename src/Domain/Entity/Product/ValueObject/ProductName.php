<?php

declare(strict_types=1);

namespace App\Domain\Entity\Product\ValueObject;

use InvalidArgumentException;

final class ProductName
{

    private $name;

    public function __construct(string $name)
    {
        $this->validate($name);
        $this->name = $name;
    }

    /**
     * getName
     *
     * @return string
     */
    public function value(): string
    {
        return $this->name;
    }

    public function validate($name)
    {
        if (empty($name)) {
            throw new InvalidArgumentException('The name cannot be an empty string.');
        }
    }
}

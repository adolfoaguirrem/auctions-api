<?php

namespace App\Application\UseCases;

use InvalidArgumentException;
use App\Domain\Entity\Buyer\Buyer;
use App\Domain\Entity\Buyer\Repository\BuyerInterface;
use App\Domain\Entity\Buyer\ValueObject\BuyerName;

class CreateBuyerUseCase
{
    public function __construct(private BuyerInterface $buyerRepository)
    {
    }

    public function execute($data): Buyer
    {
        $buyer = new Buyer($data['name']);

        $this->buyerRepository->save($buyer);

        return $buyer;
    }
}

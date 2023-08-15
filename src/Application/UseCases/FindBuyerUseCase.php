<?php

namespace App\Application\UseCases;

use App\Domain\Entity\Buyer\Buyer;
use App\Domain\Entity\Buyer\Repository\BuyerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FindBuyerUseCase
{

    public function __construct(private BuyerInterface $buyerRepository)
    {
    }

    public function execute($buyerId): Buyer
    {

        $buyer = $this->buyerRepository->findById($buyerId);

        if (is_null($buyer)) {
            return throw new NotFoundHttpException('Buyer not found');
        }

        return $buyer;
    }
}

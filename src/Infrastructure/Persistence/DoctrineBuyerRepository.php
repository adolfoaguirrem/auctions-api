<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Entity\Buyer\Buyer;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use App\Domain\Entity\Buyer\Repository\BuyerInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class DoctrineBuyerRepository extends ServiceEntityRepository implements BuyerInterface
{

    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Buyer::class);
    }

    public function save(Buyer $buyer): void
    {
        $this->_em->persist($buyer);
        $this->_em->flush();
    }

    public function findById(int $id): ?Buyer
    {
        return $this->find($id);
    }
}

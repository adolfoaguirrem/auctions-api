<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Entity\Bid\Bid;
use Doctrine\Persistence\ManagerRegistry;
use App\Domain\Entity\Bid\Repository\BidInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class DoctrineBidRepository extends ServiceEntityRepository implements BidInterface
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bid::class);
    }

    public function save(Bid $bid)
    {
        $this->_em->persist($bid);
        $this->_em->flush();
    }

    /**
     * @param int $buyerId
     * @return array
     * @throws NonUniqueResultException
     */
    public function findBidsForProduct(int $productId): array
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.productId = :productId')
            ->setParameter('productId', $productId)
            ->getQuery()
            ->getArrayResult();
    }
}

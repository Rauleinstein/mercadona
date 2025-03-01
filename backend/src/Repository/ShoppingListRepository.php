<?php

namespace App\Repository;

use App\Entity\ShoppingList;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ShoppingList>
 *
 * @method ShoppingList|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShoppingList|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShoppingList[]    findAll()
 * @method ShoppingList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShoppingListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShoppingList::class);
    }

    public function save(ShoppingList $shoppingList, bool $flush = false): void
    {
        $this->getEntityManager()->persist($shoppingList);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ShoppingList $shoppingList, bool $flush = false): void
    {
        $this->getEntityManager()->remove($shoppingList);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return ShoppingList[] Returns an array of ShoppingList objects
     */
    public function findByUser(User $user): array
    {
        return $this->createQueryBuilder('sl')
            ->andWhere('sl.user = :user')
            ->setParameter('user', $user)
            ->orderBy('sl.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return ShoppingList[] Returns an array of ShoppingList objects
     */
    public function findByUserWithItems(User $user): array
    {
        return $this->createQueryBuilder('sl')
            ->andWhere('sl.user = :user')
            ->setParameter('user', $user)
            ->leftJoin('sl.items', 'i')
            ->addSelect('i')
            ->orderBy('sl.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return ShoppingList[] Returns an array of ShoppingList objects
     */
    public function search(string $query, User $user): array
    {
        return $this->createQueryBuilder('sl')
            ->andWhere('sl.name LIKE :query')
            ->andWhere('sl.user = :user')
            ->setParameter('query', '%' . $query . '%')
            ->setParameter('user', $user)
            ->orderBy('sl.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }
} 

<?php

namespace App\Repository;

use App\Entity\ShoppingListItem;
use App\Entity\ShoppingList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ShoppingListItem>
 *
 * @method ShoppingListItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShoppingListItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShoppingListItem[]    findAll()
 * @method ShoppingListItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShoppingListItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShoppingListItem::class);
    }

    public function save(ShoppingListItem $shoppingListItem, bool $flush = false): void
    {
        $this->getEntityManager()->persist($shoppingListItem);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ShoppingListItem $shoppingListItem, bool $flush = false): void
    {
        $this->getEntityManager()->remove($shoppingListItem);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return ShoppingListItem[] Returns an array of ShoppingListItem objects
     */
    public function findByShoppingListWithIngredients(ShoppingList $shoppingList): array
    {
        return $this->createQueryBuilder('sli')
            ->andWhere('sli.shoppingList = :shoppingList')
            ->setParameter('shoppingList', $shoppingList)
            ->join('sli.ingredient', 'i')
            ->addSelect('i')
            ->orderBy('sli.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return ShoppingListItem[] Returns an array of ShoppingListItem objects
     */
    public function findPurchasedItems(ShoppingList $shoppingList): array
    {
        return $this->createQueryBuilder('sli')
            ->andWhere('sli.shoppingList = :shoppingList')
            ->andWhere('sli.purchased = true')
            ->setParameter('shoppingList', $shoppingList)
            ->orderBy('sli.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return ShoppingListItem[] Returns an array of ShoppingListItem objects
     */
    public function findUnpurchasedItems(ShoppingList $shoppingList): array
    {
        return $this->createQueryBuilder('sli')
            ->andWhere('sli.shoppingList = :shoppingList')
            ->andWhere('sli.purchased = false')
            ->setParameter('shoppingList', $shoppingList)
            ->orderBy('sli.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
} 

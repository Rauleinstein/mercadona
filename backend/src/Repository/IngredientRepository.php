<?php

namespace App\Repository;

use App\Entity\Ingredient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ingredient>
 *
 * @method Ingredient|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ingredient|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ingredient[]    findAll()
 * @method Ingredient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IngredientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ingredient::class);
    }

    public function save(Ingredient $ingredient, bool $flush = false): void
    {
        $this->getEntityManager()->persist($ingredient);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Ingredient $ingredient, bool $flush = false): void
    {
        $this->getEntityManager()->remove($ingredient);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Ingredient[] Returns an array of Ingredient objects
     */
    public function search(string $query): array
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.name LIKE :query')
            ->orWhere('i.description LIKE :query')
            ->setParameter('query', '%' . $query . '%')
            ->orderBy('i.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Ingredient[] Returns an array of Ingredient objects
     */
    public function findByPriceRange(float $minPrice, float $maxPrice): array
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.basePrice >= :minPrice')
            ->andWhere('i.basePrice <= :maxPrice')
            ->setParameter('minPrice', $minPrice)
            ->setParameter('maxPrice', $maxPrice)
            ->orderBy('i.basePrice', 'ASC')
            ->getQuery()
            ->getResult();
    }
} 

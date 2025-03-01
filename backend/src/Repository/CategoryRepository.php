<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Category>
 *
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function save(Category $category, bool $flush = false): void
    {
        $this->getEntityManager()->persist($category);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Category $category, bool $flush = false): void
    {
        $this->getEntityManager()->remove($category);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Category[] Returns an array of Category objects
     */
    public function findWithRecipeCount(): array
    {
        return $this->createQueryBuilder('c')
            ->select('c', 'COUNT(r.id) as recipeCount')
            ->leftJoin('c.recipes', 'r')
            ->groupBy('c.id')
            ->orderBy('c.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Category[] Returns an array of Category objects
     */
    public function search(string $query): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.name LIKE :query')
            ->orWhere('c.description LIKE :query')
            ->setParameter('query', '%' . $query . '%')
            ->orderBy('c.name', 'ASC')
            ->getQuery()
            ->getResult();
    }
} 

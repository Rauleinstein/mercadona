<?php

namespace App\Repository;

use App\Entity\Recipe;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Recipe>
 *
 * @method Recipe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recipe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recipe[]    findAll()
 * @method Recipe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recipe::class);
    }

    public function save(Recipe $recipe, bool $flush = false): void
    {
        $this->getEntityManager()->persist($recipe);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Recipe $recipe, bool $flush = false): void
    {
        $this->getEntityManager()->remove($recipe);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Recipe[] Returns an array of Recipe objects
     */
    public function findByAuthor(User $user): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.author = :user')
            ->setParameter('user', $user)
            ->orderBy('r.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Recipe[] Returns an array of Recipe objects
     */
    public function findByIngredients(array $ingredientIds): array
    {
        return $this->createQueryBuilder('r')
            ->join('r.recipeIngredients', 'ri')
            ->join('ri.ingredient', 'i')
            ->andWhere('i.id IN (:ingredientIds)')
            ->setParameter('ingredientIds', $ingredientIds)
            ->orderBy('r.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Recipe[] Returns an array of Recipe objects
     */
    public function findByCategories(array $categoryIds): array
    {
        return $this->createQueryBuilder('r')
            ->join('r.categories', 'c')
            ->andWhere('c.id IN (:categoryIds)')
            ->setParameter('categoryIds', $categoryIds)
            ->orderBy('r.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Recipe[] Returns an array of Recipe objects
     */
    public function search(string $query): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.name LIKE :query')
            ->orWhere('r.description LIKE :query')
            ->setParameter('query', '%' . $query . '%')
            ->orderBy('r.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Recipe[]
     */
    public function findByFilters(?string $search = null, ?string $category = null, array $criteria = []): array
    {
        $qb = $this->createQueryBuilder('r')
            ->leftJoin('r.categories', 'c')
            ->leftJoin('r.author', 'a');

        if ($search) {
            $qb->andWhere('r.name LIKE :search OR r.description LIKE :search')
                ->setParameter('search', '%' . $search . '%');
        }

        if ($category) {
            $qb->andWhere('c.name = :category')
                ->setParameter('category', $category);
        }

        foreach ($criteria as $field => $value) {
            $qb->andWhere("r.$field = :$field")
                ->setParameter($field, $value);
        }

        return $qb
            ->orderBy('r.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }
} 

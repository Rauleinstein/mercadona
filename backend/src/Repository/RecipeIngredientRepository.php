<?php

namespace App\Repository;

use App\Entity\RecipeIngredient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RecipeIngredient>
 *
 * @method RecipeIngredient|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecipeIngredient|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecipeIngredient[]    findAll()
 * @method RecipeIngredient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipeIngredientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecipeIngredient::class);
    }

    public function save(RecipeIngredient $recipeIngredient, bool $flush = false): void
    {
        $this->getEntityManager()->persist($recipeIngredient);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(RecipeIngredient $recipeIngredient, bool $flush = false): void
    {
        $this->getEntityManager()->remove($recipeIngredient);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return RecipeIngredient[] Returns an array of RecipeIngredient objects
     */
    public function findByIngredientWithRecipes(int $ingredientId): array
    {
        return $this->createQueryBuilder('ri')
            ->andWhere('ri.ingredient = :ingredientId')
            ->setParameter('ingredientId', $ingredientId)
            ->join('ri.recipe', 'r')
            ->addSelect('r')
            ->orderBy('r.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return RecipeIngredient[] Returns an array of RecipeIngredient objects
     */
    public function findByRecipeWithIngredients(int $recipeId): array
    {
        return $this->createQueryBuilder('ri')
            ->andWhere('ri.recipe = :recipeId')
            ->setParameter('recipeId', $recipeId)
            ->join('ri.ingredient', 'i')
            ->addSelect('i')
            ->orderBy('ri.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
} 

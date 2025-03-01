<?php

namespace App\Controller\Api;

use App\Entity\Ingredient;
use App\Repository\IngredientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/ingredients', name: 'api_ingredients_')]
class IngredientController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private IngredientRepository $ingredientRepository,
        private SerializerInterface $serializer,
        private ValidatorInterface $validator,
    ) {
    }

    #[Route('', name: 'index', methods: ['GET'])]
    public function index(Request $request): JsonResponse
    {
        $search = $request->query->get('search');
        
        $ingredients = $search 
            ? $this->ingredientRepository->search($search)
            : $this->ingredientRepository->findAll();

        $context = [
            'groups' => ['ingredient:read'],
            'enable_max_depth' => true,
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ];

        return $this->json([
            'data' => $ingredients,
        ], Response::HTTP_OK, [], $context);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(int $id): JsonResponse
    {
        $ingredient = $this->ingredientRepository->find($id);
        
        if (!$ingredient) {
            return $this->json([
                'error' => 'Ingredient not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $context = [
            'groups' => ['ingredient:read'],
            'enable_max_depth' => true,
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ];

        return $this->json([
            'data' => $ingredient,
        ], Response::HTTP_OK, [], $context);
    }
} 
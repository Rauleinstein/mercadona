<?php

namespace App\Controller\Api;

use App\Entity\Recipe;
use App\Repository\RecipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\Context\Normalizer\ObjectNormalizerContextBuilder;

#[Route('/api/recipes', name: 'api_recipes_')]
class RecipeController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private RecipeRepository $recipeRepository,
        private SerializerInterface $serializer,
        private ValidatorInterface $validator,
    ) {
    }

    #[Route('', name: 'index', methods: ['GET'])]
    public function index(Request $request): JsonResponse
    {
        $search = $request->query->get('search');
        $category = $request->query->get('category');
        $difficulty = $request->query->get('difficulty');

        $criteria = [];
        if ($difficulty) {
            $criteria['difficulty'] = $difficulty;
        }

        $recipes = $this->recipeRepository->findByFilters($search, $category, $criteria);

        $context = [
            'groups' => ['recipe:read'],
            'enable_max_depth' => true,
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ];

        return $this->json([
            'data' => $recipes,
        ], Response::HTTP_OK, [], $context);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(int $id): JsonResponse
    {
        $recipe = $this->recipeRepository->find($id);
        
        if (!$recipe) {
            return $this->json([
                'error' => 'Recipe not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $context = [
            'groups' => ['recipe:read'],
            'enable_max_depth' => true,
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ];

        return $this->json([
            'data' => $recipe,
        ], Response::HTTP_OK, [], $context);
    }

    #[Route('', name: 'create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        try {
            $recipe = $this->serializer->deserialize(
                $request->getContent(),
                Recipe::class,
                'json',
                ['groups' => ['recipe:write']]
            );

            $errors = $this->validator->validate($recipe);
            if (count($errors) > 0) {
                return $this->json([
                    'error' => (string) $errors,
                ], Response::HTTP_BAD_REQUEST);
            }

            $recipe->setAuthor($this->getUser());
            $this->entityManager->persist($recipe);
            $this->entityManager->flush();

            $context = [
                'groups' => ['recipe:read'],
                'enable_max_depth' => true,
                'circular_reference_handler' => function ($object) {
                    return $object->getId();
                }
            ];

            return $this->json([
                'data' => $recipe,
            ], Response::HTTP_CREATED, [], $context);
        } catch (\Exception $e) {
            return $this->json([
                'error' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/{id}', name: 'update', methods: ['PUT'])]
    public function update(Request $request, Recipe $recipe): JsonResponse
    {
        try {
            if ($recipe->getAuthor() !== $this->getUser()) {
                throw new \Exception('You are not allowed to update this recipe');
            }

            $this->serializer->deserialize(
                $request->getContent(),
                Recipe::class,
                'json',
                [
                    'object_to_populate' => $recipe,
                    'groups' => ['recipe:write'],
                ]
            );

            $errors = $this->validator->validate($recipe);
            if (count($errors) > 0) {
                return $this->json([
                    'error' => (string) $errors,
                ], Response::HTTP_BAD_REQUEST);
            }

            $recipe->setUpdatedAt(new \DateTimeImmutable());
            $this->entityManager->flush();

            $context = [
                'groups' => ['recipe:read'],
                'enable_max_depth' => true,
                'circular_reference_handler' => function ($object) {
                    return $object->getId();
                }
            ];

            return $this->json([
                'data' => $recipe,
            ], Response::HTTP_OK, [], $context);
        } catch (\Exception $e) {
            return $this->json([
                'error' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    public function delete(Recipe $recipe): JsonResponse
    {
        try {
            if ($recipe->getAuthor() !== $this->getUser()) {
                throw new \Exception('You are not allowed to delete this recipe');
            }

            $this->entityManager->remove($recipe);
            $this->entityManager->flush();

            return $this->json(null, Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return $this->json([
                'error' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
} 

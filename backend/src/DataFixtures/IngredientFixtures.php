<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class IngredientFixtures extends Fixture
{
    public const INGREDIENT_CHICKEN = 'ingredient-chicken';
    public const INGREDIENT_RICE = 'ingredient-rice';
    public const INGREDIENT_TOMATO = 'ingredient-tomato';
    public const INGREDIENT_ONION = 'ingredient-onion';
    public const INGREDIENT_GARLIC = 'ingredient-garlic';

    public function load(ObjectManager $manager): void
    {
        $ingredients = [
            [
                'name' => 'Chicken Breast',
                'description' => 'Boneless, skinless chicken breast',
                'unit' => 'gram',
                'basePrice' => '7.99',
                'nutritionalInfo' => [
                    'calories' => 165,
                    'protein' => 31,
                    'carbs' => 0,
                    'fat' => 3.6
                ],
                'reference' => self::INGREDIENT_CHICKEN
            ],
            [
                'name' => 'White Rice',
                'description' => 'Long grain white rice',
                'unit' => 'gram',
                'basePrice' => '2.99',
                'nutritionalInfo' => [
                    'calories' => 130,
                    'protein' => 2.7,
                    'carbs' => 28,
                    'fat' => 0.3
                ],
                'reference' => self::INGREDIENT_RICE
            ],
            [
                'name' => 'Tomato',
                'description' => 'Fresh red tomatoes',
                'unit' => 'piece',
                'basePrice' => '0.50',
                'nutritionalInfo' => [
                    'calories' => 22,
                    'protein' => 1.1,
                    'carbs' => 4.8,
                    'fat' => 0.2
                ],
                'reference' => self::INGREDIENT_TOMATO
            ],
            [
                'name' => 'Onion',
                'description' => 'Fresh yellow onion',
                'unit' => 'piece',
                'basePrice' => '0.40',
                'nutritionalInfo' => [
                    'calories' => 44,
                    'protein' => 1.2,
                    'carbs' => 10.1,
                    'fat' => 0.1
                ],
                'reference' => self::INGREDIENT_ONION
            ],
            [
                'name' => 'Garlic',
                'description' => 'Fresh garlic cloves',
                'unit' => 'clove',
                'basePrice' => '0.10',
                'nutritionalInfo' => [
                    'calories' => 4,
                    'protein' => 0.2,
                    'carbs' => 1,
                    'fat' => 0
                ],
                'reference' => self::INGREDIENT_GARLIC
            ],
        ];

        foreach ($ingredients as $ingredientData) {
            $ingredient = new Ingredient();
            $ingredient->setName($ingredientData['name']);
            $ingredient->setDescription($ingredientData['description']);
            $ingredient->setUnit($ingredientData['unit']);
            $ingredient->setBasePrice($ingredientData['basePrice']);
            $ingredient->setNutritionalInfo($ingredientData['nutritionalInfo']);
            $manager->persist($ingredient);
            $this->addReference($ingredientData['reference'], $ingredient);
        }

        $manager->flush();
    }
} 


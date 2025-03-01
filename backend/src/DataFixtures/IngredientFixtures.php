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
    public const INGREDIENT_QUINOA = 'ingredient-quinoa';
    public const INGREDIENT_SWEET_POTATO = 'ingredient-sweet-potato';
    public const INGREDIENT_CHICKPEAS = 'ingredient-chickpeas';
    public const INGREDIENT_FETA = 'ingredient-feta';
    public const INGREDIENT_TOFU = 'ingredient-tofu';
    public const INGREDIENT_SOY_SAUCE = 'ingredient-soy-sauce';
    public const INGREDIENT_OLIVE_OIL = 'ingredient-olive-oil';
    public const INGREDIENT_LEMON = 'ingredient-lemon';
    public const INGREDIENT_SPINACH = 'ingredient-spinach';
    public const INGREDIENT_BELL_PEPPER = 'ingredient-bell-pepper';
    public const INGREDIENT_MUSHROOMS = 'ingredient-mushrooms';
    public const INGREDIENT_GREEK_YOGURT = 'ingredient-greek-yogurt';
    public const INGREDIENT_HONEY = 'ingredient-honey';
    public const INGREDIENT_SESAME_SEEDS = 'ingredient-sesame-seeds';
    public const INGREDIENT_GINGER = 'ingredient-ginger';

    public function load(ObjectManager $manager): void
    {
        $ingredients = [
            [
                'name' => 'Chicken Breast',
                'description' => 'Boneless, skinless chicken breast',
                'unit' => 'gram',
                'basePrice' => '7.99',
                'image' => 'https://images.unsplash.com/photo-1604503468506-a8da13d82791?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
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
                'image' => 'https://images.unsplash.com/photo-1536304993881-ff6e9eefa2a6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
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
                'image' => 'https://images.unsplash.com/photo-1561136594-7f68413baa99?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
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
                'image' => 'https://images.unsplash.com/photo-1580201092675-a0a6a6cafbb1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
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
                'image' => 'https://images.unsplash.com/photo-1615477550927-6ec413874f75?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
                'nutritionalInfo' => [
                    'calories' => 4,
                    'protein' => 0.2,
                    'carbs' => 1,
                    'fat' => 0
                ],
                'reference' => self::INGREDIENT_GARLIC
            ],
            [
                'name' => 'Quinoa',
                'description' => 'Organic white quinoa',
                'unit' => 'gram',
                'basePrice' => '5.99',
                'image' => 'https://images.unsplash.com/photo-1586201375761-83865001e8ac?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
                'nutritionalInfo' => [
                    'calories' => 120,
                    'protein' => 4.4,
                    'carbs' => 21.3,
                    'fat' => 1.9
                ],
                'reference' => self::INGREDIENT_QUINOA
            ],
            [
                'name' => 'Sweet Potato',
                'description' => 'Fresh orange sweet potato',
                'unit' => 'piece',
                'basePrice' => '1.29',
                'image' => 'https://images.unsplash.com/photo-1596097635121-14b38c5d7a55?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
                'nutritionalInfo' => [
                    'calories' => 103,
                    'protein' => 2,
                    'carbs' => 23.6,
                    'fat' => 0.2
                ],
                'reference' => self::INGREDIENT_SWEET_POTATO
            ],
            [
                'name' => 'Chickpeas',
                'description' => 'Cooked organic chickpeas',
                'unit' => 'gram',
                'basePrice' => '2.49',
                'image' => 'https://images.unsplash.com/photo-1515543904379-3d757afe72e4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
                'nutritionalInfo' => [
                    'calories' => 164,
                    'protein' => 8.9,
                    'carbs' => 27,
                    'fat' => 2.6
                ],
                'reference' => self::INGREDIENT_CHICKPEAS
            ],
            [
                'name' => 'Feta Cheese',
                'description' => 'Greek feta cheese',
                'unit' => 'gram',
                'basePrice' => '4.99',
                'image' => 'https://images.unsplash.com/photo-1559561853-08451507cbe7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
                'nutritionalInfo' => [
                    'calories' => 264,
                    'protein' => 14.2,
                    'carbs' => 4.1,
                    'fat' => 21.3
                ],
                'reference' => self::INGREDIENT_FETA
            ],
            [
                'name' => 'Tofu',
                'description' => 'Firm organic tofu',
                'unit' => 'gram',
                'basePrice' => '3.99',
                'image' => 'https://images.unsplash.com/photo-1546069901-5ec6a79120b0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
                'nutritionalInfo' => [
                    'calories' => 144,
                    'protein' => 15.6,
                    'carbs' => 3.5,
                    'fat' => 8.7
                ],
                'reference' => self::INGREDIENT_TOFU
            ],
            [
                'name' => 'Soy Sauce',
                'description' => 'Traditional soy sauce',
                'unit' => 'ml',
                'basePrice' => '4.99',
                'image' => 'https://images.unsplash.com/photo-1583774144097-64bc0b5c318d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
                'nutritionalInfo' => [
                    'calories' => 9,
                    'protein' => 1.3,
                    'carbs' => 0.8,
                    'fat' => 0
                ],
                'reference' => self::INGREDIENT_SOY_SAUCE
            ],
            [
                'name' => 'Extra Virgin Olive Oil',
                'description' => 'Premium olive oil',
                'unit' => 'ml',
                'basePrice' => '8.99',
                'image' => 'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
                'nutritionalInfo' => [
                    'calories' => 120,
                    'protein' => 0,
                    'carbs' => 0,
                    'fat' => 14
                ],
                'reference' => self::INGREDIENT_OLIVE_OIL
            ],
            [
                'name' => 'Lemon',
                'description' => 'Fresh yellow lemon',
                'unit' => 'piece',
                'basePrice' => '0.69',
                'image' => 'https://images.unsplash.com/photo-1582476473562-b25216765883?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
                'nutritionalInfo' => [
                    'calories' => 17,
                    'protein' => 0.6,
                    'carbs' => 5.4,
                    'fat' => 0.2
                ],
                'reference' => self::INGREDIENT_LEMON
            ],
            [
                'name' => 'Baby Spinach',
                'description' => 'Fresh organic baby spinach',
                'unit' => 'gram',
                'basePrice' => '3.99',
                'image' => 'https://images.unsplash.com/photo-1576045057995-568f588f82fb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
                'nutritionalInfo' => [
                    'calories' => 23,
                    'protein' => 2.9,
                    'carbs' => 3.6,
                    'fat' => 0.4
                ],
                'reference' => self::INGREDIENT_SPINACH
            ],
            [
                'name' => 'Bell Pepper',
                'description' => 'Fresh colored bell pepper',
                'unit' => 'piece',
                'basePrice' => '1.29',
                'image' => 'https://images.unsplash.com/photo-1563565375-f3fdfdbefa83?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
                'nutritionalInfo' => [
                    'calories' => 30,
                    'protein' => 1,
                    'carbs' => 7,
                    'fat' => 0.2
                ],
                'reference' => self::INGREDIENT_BELL_PEPPER
            ],
            [
                'name' => 'Mushrooms',
                'description' => 'Fresh button mushrooms',
                'unit' => 'gram',
                'basePrice' => '4.99',
                'image' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
                'nutritionalInfo' => [
                    'calories' => 22,
                    'protein' => 3.1,
                    'carbs' => 3.3,
                    'fat' => 0.3
                ],
                'reference' => self::INGREDIENT_MUSHROOMS
            ],
            [
                'name' => 'Greek Yogurt',
                'description' => 'Plain Greek yogurt',
                'unit' => 'gram',
                'basePrice' => '4.49',
                'image' => 'https://images.unsplash.com/photo-1488477181946-6428a0291777?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
                'nutritionalInfo' => [
                    'calories' => 59,
                    'protein' => 10,
                    'carbs' => 3.6,
                    'fat' => 0.4
                ],
                'reference' => self::INGREDIENT_GREEK_YOGURT
            ],
            [
                'name' => 'Honey',
                'description' => 'Raw organic honey',
                'unit' => 'ml',
                'basePrice' => '7.99',
                'image' => 'https://images.unsplash.com/photo-1587049352851-8d4e89133924?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
                'nutritionalInfo' => [
                    'calories' => 304,
                    'protein' => 0.3,
                    'carbs' => 82.4,
                    'fat' => 0
                ],
                'reference' => self::INGREDIENT_HONEY
            ],
            [
                'name' => 'Sesame Seeds',
                'description' => 'Toasted sesame seeds',
                'unit' => 'gram',
                'basePrice' => '5.99',
                'image' => 'https://images.unsplash.com/photo-1527324688151-0e627063f2b1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
                'nutritionalInfo' => [
                    'calories' => 573,
                    'protein' => 17.7,
                    'carbs' => 23.5,
                    'fat' => 49.7
                ],
                'reference' => self::INGREDIENT_SESAME_SEEDS
            ],
            [
                'name' => 'Fresh Ginger',
                'description' => 'Fresh ginger root',
                'unit' => 'gram',
                'basePrice' => '3.99',
                'image' => 'https://images.unsplash.com/photo-1615485500704-8e990f9900e1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
                'nutritionalInfo' => [
                    'calories' => 80,
                    'protein' => 1.8,
                    'carbs' => 17.8,
                    'fat' => 0.8
                ],
                'reference' => self::INGREDIENT_GINGER
            ],
        ];

        foreach ($ingredients as $ingredientData) {
            $ingredient = new Ingredient();
            $ingredient->setName($ingredientData['name']);
            $ingredient->setDescription($ingredientData['description']);
            $ingredient->setUnit($ingredientData['unit']);
            $ingredient->setBasePrice($ingredientData['basePrice']);
            $ingredient->setNutritionalInfo($ingredientData['nutritionalInfo']);
            if (isset($ingredientData['image'])) {
                $ingredient->setImage($ingredientData['image']);
            }
            $manager->persist($ingredient);
            $this->addReference($ingredientData['reference'], $ingredient);
        }

        $manager->flush();
    }
} 


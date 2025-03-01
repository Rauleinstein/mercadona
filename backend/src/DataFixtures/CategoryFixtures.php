<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const CATEGORY_MAIN_DISH = 'category-main-dish';
    public const CATEGORY_DESSERT = 'category-dessert';
    public const CATEGORY_APPETIZER = 'category-appetizer';
    public const CATEGORY_BREAKFAST = 'category-breakfast';
    public const CATEGORY_ASIAN = 'category-asian';
    public const CATEGORY_MEDITERRANEAN = 'category-mediterranean';
    public const CATEGORY_VEGETARIAN = 'category-vegetarian';
    public const CATEGORY_QUICK_MEALS = 'category-quick-meals';

    public function load(ObjectManager $manager): void
    {
        $categories = [
            [
                'name' => 'Main Dishes',
                'description' => 'Primary courses and entrées',
                'reference' => self::CATEGORY_MAIN_DISH
            ],
            [
                'name' => 'Desserts',
                'description' => 'Sweet treats and desserts',
                'reference' => self::CATEGORY_DESSERT
            ],
            [
                'name' => 'Appetizers',
                'description' => 'Starters and small plates',
                'reference' => self::CATEGORY_APPETIZER
            ],
            [
                'name' => 'Breakfast',
                'description' => 'Morning meals and brunch items',
                'reference' => self::CATEGORY_BREAKFAST
            ],
            [
                'name' => 'Asian Cuisine',
                'description' => 'Dishes from various Asian culinary traditions',
                'reference' => self::CATEGORY_ASIAN
            ],
            [
                'name' => 'Mediterranean',
                'description' => 'Healthy and flavorful Mediterranean dishes',
                'reference' => self::CATEGORY_MEDITERRANEAN
            ],
            [
                'name' => 'Vegetarian',
                'description' => 'Meat-free dishes full of flavor',
                'reference' => self::CATEGORY_VEGETARIAN
            ],
            [
                'name' => 'Quick Meals',
                'description' => 'Fast and easy recipes for busy days',
                'reference' => self::CATEGORY_QUICK_MEALS
            ],
        ];

        foreach ($categories as $categoryData) {
            $category = new Category();
            $category->setName($categoryData['name']);
            $category->setDescription($categoryData['description']);
            $manager->persist($category);
            $this->addReference($categoryData['reference'], $category);
        }

        $manager->flush();
    }
} 

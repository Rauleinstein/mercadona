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

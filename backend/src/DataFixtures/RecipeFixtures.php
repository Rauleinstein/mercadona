<?php

namespace App\DataFixtures;

use App\Entity\Recipe;
use App\Entity\RecipeIngredient;
use App\Entity\Category;
use App\Entity\User;
use App\Entity\Ingredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RecipeFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            CategoryFixtures::class,
            IngredientFixtures::class,
        ];
    }

    public function load(ObjectManager $manager): void
    {
        // Chicken and Rice Recipe
        $chickenRice = new Recipe();
        $chickenRice->setName('Chicken and Rice');
        $chickenRice->setDescription('A simple and healthy chicken and rice dish');
        $chickenRice->setPreparationTime(15);
        $chickenRice->setCookingTime(30);
        $chickenRice->setServings(4);
        $chickenRice->setDifficulty('MEDIUM');
        $chickenRice->setInstructions(implode("\n", [
            'Cook rice according to package instructions',
            'Season chicken breast with salt and pepper',
            'Cook chicken in a pan until golden brown',
            'Slice chicken and serve over rice',
            'Garnish with fresh herbs if desired'
        ]));
        $chickenRice->setAuthor($this->getReference(UserFixtures::REGULAR_USER_REFERENCE, User::class));
        
        /** @var Category $mainDishCategory */
        $mainDishCategory = $this->getReference(CategoryFixtures::CATEGORY_MAIN_DISH, Category::class);
        $mainDishCategory->addRecipe($chickenRice);

        // Add recipe ingredients
        $chickenIngredient = new RecipeIngredient();
        $chickenIngredient->setIngredient($this->getReference(IngredientFixtures::INGREDIENT_CHICKEN, Ingredient::class));
        $chickenIngredient->setQuantity('500');
        $chickenIngredient->setUnit('gram');
        $chickenRice->addRecipeIngredient($chickenIngredient);
        $chickenIngredient->setOptional(false);
        $manager->persist($chickenIngredient);

        $riceIngredient = new RecipeIngredient();
        $riceIngredient->setIngredient($this->getReference(IngredientFixtures::INGREDIENT_RICE, Ingredient::class));
        $riceIngredient->setQuantity('400');
        $riceIngredient->setUnit('gram');
        $chickenRice->addRecipeIngredient($riceIngredient);
        $riceIngredient->setOptional(false);
        $manager->persist($riceIngredient);

        $manager->persist($chickenRice);

        // Tomato and Garlic Appetizer Recipe
        $tomatoGarlic = new Recipe();
        $tomatoGarlic->setName('Tomato and Garlic Appetizer');
        $tomatoGarlic->setDescription('A quick and flavorful appetizer');
        $tomatoGarlic->setPreparationTime(10);
        $tomatoGarlic->setCookingTime(5);
        $tomatoGarlic->setServings(2);
        $tomatoGarlic->setDifficulty('EASY');
        $tomatoGarlic->setInstructions(implode("\n", [
            'Slice tomatoes into rounds',
            'Mince garlic cloves',
            'Mix garlic with olive oil',
            'Top tomato slices with garlic mixture',
            'Season with salt and pepper'
        ]));
        $tomatoGarlic->setAuthor($this->getReference(UserFixtures::ADMIN_USER_REFERENCE, User::class));
        
        /** @var Category $appetizerCategory */
        $appetizerCategory = $this->getReference(CategoryFixtures::CATEGORY_APPETIZER, Category::class);
        $appetizerCategory->addRecipe($tomatoGarlic);

        // Add recipe ingredients
        $tomatoIngredient = new RecipeIngredient();
        $tomatoIngredient->setIngredient($this->getReference(IngredientFixtures::INGREDIENT_TOMATO, Ingredient::class));
        $tomatoIngredient->setQuantity('4');
        $tomatoIngredient->setUnit('piece');
        $tomatoGarlic->addRecipeIngredient($tomatoIngredient);
        $tomatoIngredient->setOptional(false);
        $manager->persist($tomatoIngredient);

        $garlicIngredient = new RecipeIngredient();
        $garlicIngredient->setIngredient($this->getReference(IngredientFixtures::INGREDIENT_GARLIC, Ingredient::class));
        $garlicIngredient->setQuantity('3');
        $garlicIngredient->setUnit('clove');
        $tomatoGarlic->addRecipeIngredient($garlicIngredient);
        $garlicIngredient->setOptional(false);
        $manager->persist($garlicIngredient);

        $manager->persist($tomatoGarlic);

        $manager->flush();
    }
} 

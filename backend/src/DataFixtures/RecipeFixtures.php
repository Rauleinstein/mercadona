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
        // 1. Mediterranean Quinoa Bowl
        $quinoaBowl = new Recipe();
        $quinoaBowl->setName('Mediterranean Quinoa Bowl');
        $quinoaBowl->setDescription('A healthy and filling bowl with quinoa, chickpeas, and Mediterranean flavors');
        $quinoaBowl->setPreparationTime(15);
        $quinoaBowl->setCookingTime(20);
        $quinoaBowl->setServings(4);
        $quinoaBowl->setDifficulty('EASY');
        $quinoaBowl->setImage('https://images.unsplash.com/photo-1512621776951-a57141f2eefd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80');
        $quinoaBowl->setInstructions(implode("\n", [
            'Cook quinoa according to package instructions',
            'Drain and rinse chickpeas',
            'Chop spinach and bell peppers',
            'Mix olive oil with lemon juice for dressing',
            'Combine all ingredients in a bowl',
            'Crumble feta cheese on top',
            'Season with salt and pepper to taste'
        ]));
        $quinoaBowl->setAuthor($this->getReference(UserFixtures::REGULAR_USER_REFERENCE, User::class));
        
        /** @var Category $mediterraneanCategory */
        $mediterraneanCategory = $this->getReference(CategoryFixtures::CATEGORY_MEDITERRANEAN, Category::class);
        $mediterraneanCategory->addRecipe($quinoaBowl);

        $this->addRecipeIngredient($manager, $quinoaBowl, IngredientFixtures::INGREDIENT_QUINOA, '200', 'gram', false);
        $this->addRecipeIngredient($manager, $quinoaBowl, IngredientFixtures::INGREDIENT_CHICKPEAS, '400', 'gram', false);
        $this->addRecipeIngredient($manager, $quinoaBowl, IngredientFixtures::INGREDIENT_SPINACH, '100', 'gram', false);
        $this->addRecipeIngredient($manager, $quinoaBowl, IngredientFixtures::INGREDIENT_BELL_PEPPER, '2', 'piece', false);
        $this->addRecipeIngredient($manager, $quinoaBowl, IngredientFixtures::INGREDIENT_FETA, '100', 'gram', false);
        $this->addRecipeIngredient($manager, $quinoaBowl, IngredientFixtures::INGREDIENT_OLIVE_OIL, '30', 'ml', false);
        $this->addRecipeIngredient($manager, $quinoaBowl, IngredientFixtures::INGREDIENT_LEMON, '1', 'piece', false);

        $manager->persist($quinoaBowl);

        // 2. Honey Ginger Tofu Stir-Fry
        $tofuStirFry = new Recipe();
        $tofuStirFry->setName('Honey Ginger Tofu Stir-Fry');
        $tofuStirFry->setDescription('A flavorful Asian-inspired tofu dish with a sweet and savory sauce');
        $tofuStirFry->setPreparationTime(20);
        $tofuStirFry->setCookingTime(15);
        $tofuStirFry->setServings(3);
        $tofuStirFry->setDifficulty('MEDIUM');
        $tofuStirFry->setImage('https://images.unsplash.com/photo-1512058564366-18510be2db19?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80');
        $tofuStirFry->setInstructions(implode("\n", [
            'Press and cube tofu',
            'Mix honey, soy sauce, and grated ginger for sauce',
            'Heat oil in a wok or large pan',
            'Cook tofu until golden brown',
            'Add vegetables and stir-fry',
            'Pour sauce over and cook until thickened',
            'Garnish with sesame seeds'
        ]));
        $tofuStirFry->setAuthor($this->getReference(UserFixtures::ADMIN_USER_REFERENCE, User::class));
        
        /** @var Category $asianCategory */
        $asianCategory = $this->getReference(CategoryFixtures::CATEGORY_ASIAN, Category::class);
        $asianCategory->addRecipe($tofuStirFry);

        $this->addRecipeIngredient($manager, $tofuStirFry, IngredientFixtures::INGREDIENT_TOFU, '400', 'gram', false);
        $this->addRecipeIngredient($manager, $tofuStirFry, IngredientFixtures::INGREDIENT_HONEY, '30', 'ml', false);
        $this->addRecipeIngredient($manager, $tofuStirFry, IngredientFixtures::INGREDIENT_SOY_SAUCE, '45', 'ml', false);
        $this->addRecipeIngredient($manager, $tofuStirFry, IngredientFixtures::INGREDIENT_GINGER, '20', 'gram', false);
        $this->addRecipeIngredient($manager, $tofuStirFry, IngredientFixtures::INGREDIENT_BELL_PEPPER, '2', 'piece', false);
        $this->addRecipeIngredient($manager, $tofuStirFry, IngredientFixtures::INGREDIENT_SESAME_SEEDS, '15', 'gram', true);

        $manager->persist($tofuStirFry);

        // 3. Stuffed Sweet Potatoes
        $stuffedPotatoes = new Recipe();
        $stuffedPotatoes->setName('Quinoa Stuffed Sweet Potatoes');
        $stuffedPotatoes->setDescription('Baked sweet potatoes filled with quinoa and vegetables');
        $stuffedPotatoes->setPreparationTime(15);
        $stuffedPotatoes->setCookingTime(45);
        $stuffedPotatoes->setServings(4);
        $stuffedPotatoes->setDifficulty('EASY');
        $stuffedPotatoes->setImage('https://images.unsplash.com/photo-1596095627338-9b03601a7f44?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80');
        $stuffedPotatoes->setInstructions(implode("\n", [
            'Preheat oven to 200°C',
            'Wash and pierce sweet potatoes',
            'Bake sweet potatoes for 45 minutes',
            'Cook quinoa according to package',
            'Sauté mushrooms and spinach',
            'Mix vegetables with quinoa',
            'Fill potatoes with quinoa mixture',
            'Top with Greek yogurt'
        ]));
        $stuffedPotatoes->setAuthor($this->getReference(UserFixtures::REGULAR_USER_REFERENCE, User::class));
        
        /** @var Category $vegetarianCategory */
        $vegetarianCategory = $this->getReference(CategoryFixtures::CATEGORY_VEGETARIAN, Category::class);
        $vegetarianCategory->addRecipe($stuffedPotatoes);

        $this->addRecipeIngredient($manager, $stuffedPotatoes, IngredientFixtures::INGREDIENT_SWEET_POTATO, '4', 'piece', false);
        $this->addRecipeIngredient($manager, $stuffedPotatoes, IngredientFixtures::INGREDIENT_QUINOA, '200', 'gram', false);
        $this->addRecipeIngredient($manager, $stuffedPotatoes, IngredientFixtures::INGREDIENT_MUSHROOMS, '200', 'gram', false);
        $this->addRecipeIngredient($manager, $stuffedPotatoes, IngredientFixtures::INGREDIENT_SPINACH, '100', 'gram', false);
        $this->addRecipeIngredient($manager, $stuffedPotatoes, IngredientFixtures::INGREDIENT_GREEK_YOGURT, '200', 'gram', true);

        $manager->persist($stuffedPotatoes);

        // 4. Quick Chickpea Stir-Fry
        $chickpeaStirFry = new Recipe();
        $chickpeaStirFry->setName('Quick Chickpea Stir-Fry');
        $chickpeaStirFry->setDescription('A fast and protein-rich vegetarian stir-fry');
        $chickpeaStirFry->setPreparationTime(10);
        $chickpeaStirFry->setCookingTime(15);
        $chickpeaStirFry->setServings(2);
        $chickpeaStirFry->setDifficulty('EASY');
        $chickpeaStirFry->setImage('https://images.unsplash.com/photo-1604329760661-e71dc83f8f26?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80');
        $chickpeaStirFry->setInstructions(implode("\n", [
            'Drain and rinse chickpeas',
            'Chop all vegetables',
            'Heat olive oil in a large pan',
            'Sauté garlic and ginger',
            'Add vegetables and chickpeas',
            'Season with soy sauce',
            'Cook until vegetables are tender'
        ]));
        $chickpeaStirFry->setAuthor($this->getReference(UserFixtures::ADMIN_USER_REFERENCE, User::class));
        
        /** @var Category $quickCategory */
        $quickCategory = $this->getReference(CategoryFixtures::CATEGORY_QUICK_MEALS, Category::class);
        $quickCategory->addRecipe($chickpeaStirFry);

        $this->addRecipeIngredient($manager, $chickpeaStirFry, IngredientFixtures::INGREDIENT_CHICKPEAS, '400', 'gram', false);
        $this->addRecipeIngredient($manager, $chickpeaStirFry, IngredientFixtures::INGREDIENT_BELL_PEPPER, '1', 'piece', false);
        $this->addRecipeIngredient($manager, $chickpeaStirFry, IngredientFixtures::INGREDIENT_GARLIC, '3', 'clove', false);
        $this->addRecipeIngredient($manager, $chickpeaStirFry, IngredientFixtures::INGREDIENT_GINGER, '15', 'gram', false);
        $this->addRecipeIngredient($manager, $chickpeaStirFry, IngredientFixtures::INGREDIENT_SOY_SAUCE, '30', 'ml', false);
        $this->addRecipeIngredient($manager, $chickpeaStirFry, IngredientFixtures::INGREDIENT_OLIVE_OIL, '15', 'ml', false);

        $manager->persist($chickpeaStirFry);

        // 5. Mediterranean Breakfast Bowl
        $breakfastBowl = new Recipe();
        $breakfastBowl->setName('Mediterranean Breakfast Bowl');
        $breakfastBowl->setDescription('A healthy and filling breakfast with Greek yogurt and honey');
        $breakfastBowl->setPreparationTime(10);
        $breakfastBowl->setCookingTime(0);
        $breakfastBowl->setServings(1);
        $breakfastBowl->setDifficulty('EASY');
        $breakfastBowl->setImage('https://images.unsplash.com/photo-1511690656952-34342bb7c2f2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80');
        $breakfastBowl->setInstructions(implode("\n", [
            'Place Greek yogurt in a bowl',
            'Drizzle with honey',
            'Add quinoa if using leftover',
            'Sprinkle with sesame seeds',
            'Add a squeeze of lemon juice',
            'Mix gently and serve'
        ]));
        $breakfastBowl->setAuthor($this->getReference(UserFixtures::REGULAR_USER_REFERENCE, User::class));
        
        /** @var Category $breakfastCategory */
        $breakfastCategory = $this->getReference(CategoryFixtures::CATEGORY_BREAKFAST, Category::class);
        $breakfastCategory->addRecipe($breakfastBowl);

        $this->addRecipeIngredient($manager, $breakfastBowl, IngredientFixtures::INGREDIENT_GREEK_YOGURT, '250', 'gram', false);
        $this->addRecipeIngredient($manager, $breakfastBowl, IngredientFixtures::INGREDIENT_HONEY, '30', 'ml', false);
        $this->addRecipeIngredient($manager, $breakfastBowl, IngredientFixtures::INGREDIENT_QUINOA, '50', 'gram', true);
        $this->addRecipeIngredient($manager, $breakfastBowl, IngredientFixtures::INGREDIENT_SESAME_SEEDS, '10', 'gram', true);
        $this->addRecipeIngredient($manager, $breakfastBowl, IngredientFixtures::INGREDIENT_LEMON, '0.5', 'piece', true);

        $manager->persist($breakfastBowl);

        // 6. Mushroom Quinoa Risotto
        $quinoaRisotto = new Recipe();
        $quinoaRisotto->setName('Mushroom Quinoa Risotto');
        $quinoaRisotto->setDescription('A healthy twist on traditional risotto using quinoa instead of rice');
        $quinoaRisotto->setPreparationTime(15);
        $quinoaRisotto->setCookingTime(25);
        $quinoaRisotto->setServings(4);
        $quinoaRisotto->setDifficulty('MEDIUM');
        $quinoaRisotto->setImage('https://images.unsplash.com/photo-1476124369491-e7addf5db371?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80');
        $quinoaRisotto->setInstructions(implode("\n", [
            'Rinse quinoa thoroughly',
            'Sauté mushrooms with garlic',
            'Cook quinoa with vegetable broth',
            'Combine mushrooms and quinoa',
            'Add Greek yogurt for creaminess',
            'Season with salt and pepper',
            'Garnish with fresh herbs'
        ]));
        $quinoaRisotto->setAuthor($this->getReference(UserFixtures::ADMIN_USER_REFERENCE, User::class));
        
        /** @var Category $vegetarianCategory */
        $vegetarianCategory = $this->getReference(CategoryFixtures::CATEGORY_VEGETARIAN, Category::class);
        $vegetarianCategory->addRecipe($quinoaRisotto);

        $this->addRecipeIngredient($manager, $quinoaRisotto, IngredientFixtures::INGREDIENT_QUINOA, '300', 'gram', false);
        $this->addRecipeIngredient($manager, $quinoaRisotto, IngredientFixtures::INGREDIENT_MUSHROOMS, '400', 'gram', false);
        $this->addRecipeIngredient($manager, $quinoaRisotto, IngredientFixtures::INGREDIENT_GARLIC, '4', 'clove', false);
        $this->addRecipeIngredient($manager, $quinoaRisotto, IngredientFixtures::INGREDIENT_GREEK_YOGURT, '100', 'gram', true);
        $this->addRecipeIngredient($manager, $quinoaRisotto, IngredientFixtures::INGREDIENT_OLIVE_OIL, '30', 'ml', false);

        $manager->persist($quinoaRisotto);

        // 7. Asian-Style Sweet Potato Noodles
        $sweetPotatoNoodles = new Recipe();
        $sweetPotatoNoodles->setName('Asian-Style Sweet Potato Noodles');
        $sweetPotatoNoodles->setDescription('Spiralized sweet potato noodles with an Asian-inspired sauce');
        $sweetPotatoNoodles->setPreparationTime(20);
        $sweetPotatoNoodles->setCookingTime(15);
        $sweetPotatoNoodles->setServings(2);
        $sweetPotatoNoodles->setDifficulty('MEDIUM');
        $sweetPotatoNoodles->setImage('https://images.unsplash.com/photo-1603133872878-684f208fb84b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80');
        $sweetPotatoNoodles->setInstructions(implode("\n", [
            'Spiralize sweet potatoes into noodles',
            'Prepare sauce with soy sauce, honey, and ginger',
            'Heat oil in a large wok',
            'Stir-fry sweet potato noodles until tender',
            'Add sauce and toss to combine',
            'Garnish with sesame seeds',
            'Serve hot'
        ]));
        $sweetPotatoNoodles->setAuthor($this->getReference(UserFixtures::REGULAR_USER_REFERENCE, User::class));
        
        /** @var Category $asianCategory */
        $asianCategory = $this->getReference(CategoryFixtures::CATEGORY_ASIAN, Category::class);
        $asianCategory->addRecipe($sweetPotatoNoodles);

        $this->addRecipeIngredient($manager, $sweetPotatoNoodles, IngredientFixtures::INGREDIENT_SWEET_POTATO, '2', 'piece', false);
        $this->addRecipeIngredient($manager, $sweetPotatoNoodles, IngredientFixtures::INGREDIENT_SOY_SAUCE, '45', 'ml', false);
        $this->addRecipeIngredient($manager, $sweetPotatoNoodles, IngredientFixtures::INGREDIENT_HONEY, '30', 'ml', false);
        $this->addRecipeIngredient($manager, $sweetPotatoNoodles, IngredientFixtures::INGREDIENT_GINGER, '20', 'gram', false);
        $this->addRecipeIngredient($manager, $sweetPotatoNoodles, IngredientFixtures::INGREDIENT_SESAME_SEEDS, '15', 'gram', true);

        $manager->persist($sweetPotatoNoodles);

        // 8. Mediterranean Chickpea Salad
        $chickpeaSalad = new Recipe();
        $chickpeaSalad->setName('Mediterranean Chickpea Salad');
        $chickpeaSalad->setDescription('A refreshing salad with chickpeas, feta, and Mediterranean flavors');
        $chickpeaSalad->setPreparationTime(15);
        $chickpeaSalad->setCookingTime(0);
        $chickpeaSalad->setServings(4);
        $chickpeaSalad->setDifficulty('EASY');
        $chickpeaSalad->setImage('https://images.unsplash.com/photo-1505253716362-afaea1d3d1af?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80');
        $chickpeaSalad->setInstructions(implode("\n", [
            'Drain and rinse chickpeas',
            'Chop bell peppers and onions',
            'Crumble feta cheese',
            'Mix olive oil and lemon juice for dressing',
            'Combine all ingredients',
            'Season with salt and pepper',
            'Chill before serving'
        ]));
        $chickpeaSalad->setAuthor($this->getReference(UserFixtures::ADMIN_USER_REFERENCE, User::class));
        
        /** @var Category $mediterraneanCategory */
        $mediterraneanCategory = $this->getReference(CategoryFixtures::CATEGORY_MEDITERRANEAN, Category::class);
        $mediterraneanCategory->addRecipe($chickpeaSalad);

        $this->addRecipeIngredient($manager, $chickpeaSalad, IngredientFixtures::INGREDIENT_CHICKPEAS, '400', 'gram', false);
        $this->addRecipeIngredient($manager, $chickpeaSalad, IngredientFixtures::INGREDIENT_BELL_PEPPER, '2', 'piece', false);
        $this->addRecipeIngredient($manager, $chickpeaSalad, IngredientFixtures::INGREDIENT_ONION, '1', 'piece', false);
        $this->addRecipeIngredient($manager, $chickpeaSalad, IngredientFixtures::INGREDIENT_FETA, '150', 'gram', false);
        $this->addRecipeIngredient($manager, $chickpeaSalad, IngredientFixtures::INGREDIENT_OLIVE_OIL, '45', 'ml', false);
        $this->addRecipeIngredient($manager, $chickpeaSalad, IngredientFixtures::INGREDIENT_LEMON, '1', 'piece', false);

        $manager->persist($chickpeaSalad);

        // 9. Quick Tofu Scramble
        $tofuScramble = new Recipe();
        $tofuScramble->setName('Quick Tofu Scramble');
        $tofuScramble->setDescription('A protein-rich breakfast alternative to scrambled eggs');
        $tofuScramble->setPreparationTime(10);
        $tofuScramble->setCookingTime(10);
        $tofuScramble->setServings(2);
        $tofuScramble->setDifficulty('EASY');
        $tofuScramble->setImage('https://images.unsplash.com/photo-1625944525533-473f1a3d54e7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80');
        $tofuScramble->setInstructions(implode("\n", [
            'Crumble tofu with your hands',
            'Heat olive oil in a pan',
            'Sauté onions and bell peppers',
            'Add crumbled tofu',
            'Season with soy sauce',
            'Cook until heated through',
            'Serve hot'
        ]));
        $tofuScramble->setAuthor($this->getReference(UserFixtures::REGULAR_USER_REFERENCE, User::class));
        
        /** @var Category $quickCategory */
        $quickCategory = $this->getReference(CategoryFixtures::CATEGORY_QUICK_MEALS, Category::class);
        $quickCategory->addRecipe($tofuScramble);

        $this->addRecipeIngredient($manager, $tofuScramble, IngredientFixtures::INGREDIENT_TOFU, '300', 'gram', false);
        $this->addRecipeIngredient($manager, $tofuScramble, IngredientFixtures::INGREDIENT_ONION, '1', 'piece', false);
        $this->addRecipeIngredient($manager, $tofuScramble, IngredientFixtures::INGREDIENT_BELL_PEPPER, '1', 'piece', false);
        $this->addRecipeIngredient($manager, $tofuScramble, IngredientFixtures::INGREDIENT_SOY_SAUCE, '15', 'ml', false);
        $this->addRecipeIngredient($manager, $tofuScramble, IngredientFixtures::INGREDIENT_OLIVE_OIL, '15', 'ml', false);

        $manager->persist($tofuScramble);

        // 10. Honey Ginger Quinoa Breakfast Bowl
        $honeyQuinoa = new Recipe();
        $honeyQuinoa->setName('Honey Ginger Quinoa Breakfast Bowl');
        $honeyQuinoa->setDescription('A warm and comforting breakfast bowl with Asian-inspired flavors');
        $honeyQuinoa->setPreparationTime(5);
        $honeyQuinoa->setCookingTime(15);
        $honeyQuinoa->setServings(2);
        $honeyQuinoa->setDifficulty('EASY');
        $honeyQuinoa->setImage('https://images.unsplash.com/photo-1607301406259-dfb186e15de8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80');
        $honeyQuinoa->setInstructions(implode("\n", [
            'Cook quinoa according to package instructions',
            'Mix honey with grated ginger',
            'Warm the honey-ginger mixture slightly',
            'Pour over cooked quinoa',
            'Top with Greek yogurt',
            'Sprinkle with sesame seeds',
            'Serve warm'
        ]));
        $honeyQuinoa->setAuthor($this->getReference(UserFixtures::ADMIN_USER_REFERENCE, User::class));
        
        /** @var Category $breakfastCategory */
        $breakfastCategory = $this->getReference(CategoryFixtures::CATEGORY_BREAKFAST, Category::class);
        $breakfastCategory->addRecipe($honeyQuinoa);

        $this->addRecipeIngredient($manager, $honeyQuinoa, IngredientFixtures::INGREDIENT_QUINOA, '200', 'gram', false);
        $this->addRecipeIngredient($manager, $honeyQuinoa, IngredientFixtures::INGREDIENT_HONEY, '45', 'ml', false);
        $this->addRecipeIngredient($manager, $honeyQuinoa, IngredientFixtures::INGREDIENT_GINGER, '15', 'gram', false);
        $this->addRecipeIngredient($manager, $honeyQuinoa, IngredientFixtures::INGREDIENT_GREEK_YOGURT, '200', 'gram', true);
        $this->addRecipeIngredient($manager, $honeyQuinoa, IngredientFixtures::INGREDIENT_SESAME_SEEDS, '10', 'gram', true);

        $manager->persist($honeyQuinoa);

        $manager->flush();
    }

    private function addRecipeIngredient(
        ObjectManager $manager,
        Recipe $recipe,
        string $ingredientReference,
        string $quantity,
        string $unit,
        bool $optional
    ): void {
        $recipeIngredient = new RecipeIngredient();
        $recipeIngredient->setIngredient($this->getReference($ingredientReference, Ingredient::class));
        $recipeIngredient->setQuantity($quantity);
        $recipeIngredient->setUnit($unit);
        $recipeIngredient->setOptional($optional);
        $recipe->addRecipeIngredient($recipeIngredient);
        $manager->persist($recipeIngredient);
    }
} 

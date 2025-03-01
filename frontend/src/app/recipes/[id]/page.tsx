'use client';
import { notFound } from 'next/navigation';
import { Recipe } from '@/types/recipe';
import { fetchRecipeById } from '@/services/api';
import { useState, useEffect } from 'react';
import { Card, CardContent } from '@/components/ui/card';

// Import all recipe components from the barrel file
import {
  RecipeLoading,
  RecipeError,
  RecipeHeader,
  RecipeMetadata,
  RecipeActions,
  RecipeTabs,
  RecipeFooter
} from '@/components/recipes';

export default function RecipePage({ params }: { params: { id: string } }) {
  const recipeId = parseInt(params.id);
  const [recipe, setRecipe] = useState<Recipe | null>(null);
  const [isLoading, setIsLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchRecipe = async () => {
      try {
        setIsLoading(true);
        setError(null);
        const response = await fetchRecipeById(recipeId);
        setRecipe(response.data);
      } catch (error) {
        console.error('Error fetching recipe:', error);
        if ((error as any)?.status === 404) {
          notFound();
        }
        setError('Failed to load recipe. Please try again later.');
      } finally {
        setIsLoading(false);
      }
    };
    
    if (!isNaN(recipeId)) {
      fetchRecipe();
    } else {
      setError('Invalid recipe ID');
      setIsLoading(false);
    }
  }, [recipeId]);

  if (isLoading) {
    return <RecipeLoading />;
  }

  if (error) {
    return <RecipeError error={error} />;
  }

  if (!recipe) {
    return null;
  }

  return (
    <main className="container mx-auto px-4 py-8">
      <Card className="max-w-4xl mx-auto overflow-hidden print:shadow-none">
        <RecipeHeader 
          name={recipe.name} 
          image={recipe.image} 
          description={recipe.description} 
        />

        <CardContent className="p-6">
          <RecipeActions 
            categories={recipe.categories} 
            recipeName={recipe.name}
            recipeDescription={recipe.description}
          />

          <RecipeMetadata 
            preparationTime={recipe.preparationTime}
            cookingTime={recipe.cookingTime}
            servings={recipe.servings}
            difficulty={recipe.difficulty}
          />

          <RecipeTabs 
            recipeIngredients={recipe.recipeIngredients}
            instructions={recipe.instructions}
          />

          <RecipeFooter 
            author={recipe.author}
            updatedAt={recipe.updatedAt}
          />
        </CardContent>
      </Card>
    </main>
  );
}

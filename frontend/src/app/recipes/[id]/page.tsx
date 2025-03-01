import { notFound } from 'next/navigation';
import Image from 'next/image';
import { Recipe } from '@/types/recipe';
import { fetchRecipeById } from '@/services/api';
import { Metadata } from 'next';
import { formatDuration } from '@/utils/time';

type Props = {
  params: {
    id: string;
  };
  searchParams: { [key: string]: string | string[] | undefined };
};

export async function generateMetadata(
  { params, searchParams }: Props,
): Promise<Metadata> {
  console.log('generateMetadata called with params:', params);
  // Await params to ensure it's fully resolved
  const { id } = await params;
  
  if (!id) {
    return {
      title: 'Recipe Not Found',
      description: 'The requested recipe could not be found.',
    };
  }

  const recipeId = parseInt(id);
  
  if (isNaN(recipeId)) {
    return {
      title: 'Invalid Recipe ID',
      description: 'The recipe ID provided is not valid.',
    };
  }
  
  try {
    const response = await fetchRecipeById(recipeId);
    const recipe = response.data;
    
    if (!recipe) {
      return {
        title: 'Recipe Not Found',
        description: 'The requested recipe could not be found.',
      };
    }
    
    return {
      title: `${recipe.name} - Recipe`,
      description: recipe.description,
      openGraph: {
        title: recipe.name,
        description: recipe.description,
        ...(recipe.image && {
          images: [{ url: recipe.image }],
        }),
      },
    };
  } catch (error) {
    return {
      title: 'Recipe Not Found',
      description: 'The requested recipe could not be found.',
    };
  }
}

export default async function RecipePage({ params }: Props) {
  console.log('RecipePage component called with params:', params);
  // Await params to ensure it's fully resolved
  const { id } = await params;
  console.log('Resolved ID:', id);
  
  const recipeId = parseInt(id);
  console.log('Parsed recipeId:', recipeId);
  
  if (isNaN(recipeId)) {
    console.log('Invalid recipeId (NaN), redirecting to 404');
    notFound();
  }
  
  try {
    console.log('Attempting to fetch recipe with ID:', recipeId);
    const response = await fetchRecipeById(recipeId);
    console.log('Recipe fetch response:', response);
    
    if (!response || !response.data) {
      console.log('No response or no data, redirecting to 404');
      notFound();
    }
    
    const recipe = response.data;

    return (
      <main className="container mx-auto px-4 py-8">
        <article className="max-w-4xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
          {recipe.image && (
            <div className="relative w-full h-[400px]">
              <Image
                src={recipe.image}
                alt={recipe.name}
                fill
                className="object-cover"
                priority
              />
            </div>
          )}
          
          <div className="p-6">
            <header className="mb-6">
              <h1 className="text-3xl font-bold text-gray-900 mb-2">{recipe.name}</h1>
              <p className="text-gray-600 mb-4">{recipe.description}</p>
              
              <div className="flex flex-wrap gap-4 text-sm text-gray-600">
                <div className="flex items-center">
                  <span className="font-medium">Prep time:</span>
                  <span className="ml-2">{formatDuration(recipe.preparationTime)}</span>
                </div>
                <div className="flex items-center">
                  <span className="font-medium">Cook time:</span>
                  <span className="ml-2">{formatDuration(recipe.cookingTime)}</span>
                </div>
                <div className="flex items-center">
                  <span className="font-medium">Servings:</span>
                  <span className="ml-2">{recipe.servings}</span>
                </div>
                <div className="flex items-center">
                  <span className="font-medium">Difficulty:</span>
                  <span className="ml-2 capitalize">{recipe.difficulty}</span>
                </div>
              </div>
            </header>

            <section className="mb-8">
              <h2 className="text-2xl font-bold text-gray-900 mb-4">Ingredients</h2>
              <ul className="space-y-2">
                {recipe.recipeIngredients.map((item) => (
                  <li key={item.id} className="flex items-center text-gray-700">
                    <span className="font-medium mr-2">
                      {item.quantity} {item.unit}
                    </span>
                    {item.ingredient.name}
                  </li>
                ))}
              </ul>
            </section>

            <section className="mb-8">
              <h2 className="text-2xl font-bold text-gray-900 mb-4">Instructions</h2>
              <div className="prose max-w-none">
                {recipe.instructions.split('\n').map((instruction: string, index: number) => (
                  <p key={index} className="mb-4 text-gray-700">
                    {instruction}
                  </p>
                ))}
              </div>
            </section>

            <footer className="mt-8 pt-6 border-t border-gray-200">
              <div className="flex items-center justify-between text-sm text-gray-600">
                <div>
                  <span className="font-medium">Created by:</span>
                  <span className="ml-2">{recipe.author.name}</span>
                </div>
                <div className="flex gap-2">
                  {recipe.categories.map((category) => (
                    <span
                      key={category.id}
                      className="px-3 py-1 bg-gray-100 rounded-full text-gray-700"
                    >
                      {category.name}
                    </span>
                  ))}
                </div>
              </div>
            </footer>
          </div>
        </article>
      </main>
    );
  } catch (error) {
    if ((error as any)?.status === 404) {
      notFound();
    }
    
    return (
      <main className="container mx-auto px-4 py-8">
        <div className="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-8 text-center">
          <h1 className="text-2xl font-bold text-gray-900 mb-4">Error Loading Recipe</h1>
          <p className="text-gray-600 mb-6">
            We encountered an error while loading this recipe. Please try again later.
          </p>
          <a
            href="/recipes"
            className="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700"
          >
            Back to Recipes
          </a>
        </div>
      </main>
    );
  }
} 


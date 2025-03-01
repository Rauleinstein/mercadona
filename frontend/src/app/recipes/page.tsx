'use client';

import { useState, useEffect } from 'react';
import SearchAndFilters from './components/SearchAndFilters';
import RecipeCard from './components/RecipeCard';
import { Recipe } from '@/types/recipe';
import { fetchRecipes } from '@/services/api';

export default function RecipeList() {
  const [recipes, setRecipes] = useState<Recipe[]>([]);
  const [isLoading, setIsLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);
  const [searchQuery, setSearchQuery] = useState('');
  const [selectedCategory, setSelectedCategory] = useState('');
  const [selectedDifficulty, setSelectedDifficulty] = useState('');

  useEffect(() => {
    const loadRecipes = async () => {
      try {
        setIsLoading(true);
        setError(null);
        const response = await fetchRecipes({
          search: searchQuery,
          category: selectedCategory,
          difficulty: selectedDifficulty,
        });
        setRecipes(response.data);
      } catch (err) {
        setError(err instanceof Error ? err.message : 'Failed to load recipes');
      } finally {
        setIsLoading(false);
      }
    };

    // Debounce the API call for search
    const timeoutId = setTimeout(loadRecipes, 300);
    return () => clearTimeout(timeoutId);
  }, [searchQuery, selectedCategory, selectedDifficulty]);

  return (
    <div className="min-h-screen bg-gray-50 dark:bg-gray-900">
      {/* Header */}
      <header className="bg-white dark:bg-gray-800 shadow-sm">
        <div className="container mx-auto px-6 py-8">
          <h1 className="text-3xl font-bold text-gray-900 dark:text-white">Recipes</h1>
          <p className="mt-2 text-gray-600 dark:text-gray-300">Discover and cook delicious meals</p>
        </div>
      </header>

      {/* Search and Filters */}
      <div className="container mx-auto px-6 py-8">
        <SearchAndFilters
          onSearch={setSearchQuery}
          onCategoryChange={setSelectedCategory}
          onDifficultyChange={setSelectedDifficulty}
        />

        {/* Error State */}
        {error && (
          <div className="rounded-lg bg-red-50 dark:bg-red-900/50 p-4 mb-8">
            <div className="flex">
              <div className="flex-shrink-0">
                <svg className="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                  <path fillRule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clipRule="evenodd" />
                </svg>
              </div>
              <div className="ml-3">
                <h3 className="text-sm font-medium text-red-800 dark:text-red-200">
                  Error loading recipes
                </h3>
                <p className="mt-1 text-sm text-red-700 dark:text-red-300">{error}</p>
              </div>
            </div>
          </div>
        )}

        {/* Loading State */}
        {isLoading ? (
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {[...Array(6)].map((_, index) => (
              <div key={index} className="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-4 animate-pulse">
                <div className="aspect-video bg-gray-200 dark:bg-gray-700 rounded-lg mb-4"></div>
                <div className="h-6 bg-gray-200 dark:bg-gray-700 rounded w-3/4 mb-4"></div>
                <div className="h-4 bg-gray-200 dark:bg-gray-700 rounded w-full mb-2"></div>
                <div className="h-4 bg-gray-200 dark:bg-gray-700 rounded w-2/3"></div>
              </div>
            ))}
          </div>
        ) : (
          /* Recipe Grid */
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {recipes.length > 0 ? (
              recipes.map((recipe) => (
                <RecipeCard key={recipe.id} recipe={recipe} />
              ))
            ) : (
              <div className="col-span-full text-center py-12">
                <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                  No recipes found
                </h3>
                <p className="text-gray-600 dark:text-gray-400">
                  Try adjusting your search or filters to find what you're looking for.
                </p>
              </div>
            )}
          </div>
        )}
      </div>
    </div>
  );
} 


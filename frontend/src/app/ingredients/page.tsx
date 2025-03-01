'use client';

import { useState, useEffect } from 'react';
import { fetchIngredients } from '@/services/api';
import { IngredientCard } from '@/components/IngredientCard';
import { Ingredient } from '@/types/ingredient';
import { AlertCircle } from 'lucide-react';
  
export default function IngredientsPage() {
  const [ingredients, setIngredients] = useState<Ingredient[]>([]);
  const [isLoading, setIsLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);
  const [searchQuery, setSearchQuery] = useState('');

  useEffect(() => {
    const loadIngredients = async () => {
      try {
        setIsLoading(true);
        setError(null);
        const response = await fetchIngredients({
          search: searchQuery,
        });
        setIngredients(response.data);
      } catch (err) {
        setError(err instanceof Error ? err.message : 'Failed to load ingredients');
      } finally {
        setIsLoading(false);
      }
    };

    // Debounce the API call for search
    const timeoutId = setTimeout(loadIngredients, 300);
    return () => clearTimeout(timeoutId);
  }, [searchQuery]);

  return (
    <div className="min-h-screen bg-background">
      {/* Header */}
      <header className="bg-card shadow-sm">
        <div className="container mx-auto px-6 py-8">
          <h1 className="text-3xl font-bold text-foreground">Ingredients</h1>
          <p className="mt-2 text-muted-foreground">Browse all available ingredients</p>
        </div>
      </header>

      <div className="container mx-auto px-6 py-8">
        {/* Search */}
        <div className="mb-8">
          <form className="flex gap-2" onSubmit={(e) => e.preventDefault()}>
            <div className="flex-grow">
              <input
                type="text"
                value={searchQuery}
                onChange={(e) => setSearchQuery(e.target.value)}
                placeholder="Search ingredients..."
                className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
              />
            </div>
          </form>
        </div>

        {/* Error State */}
        {error && (
          <div className="rounded-lg bg-destructive/10 p-4 mb-8 border border-destructive/20">
            <div className="flex">
              <div className="flex-shrink-0">
                <AlertCircle className="h-5 w-5 text-destructive" />
              </div>
              <div className="ml-3">
                <h3 className="text-sm font-medium text-destructive">
                  Error loading ingredients
                </h3>
                <p className="mt-1 text-sm text-destructive/80">{error}</p>
              </div>
            </div>
          </div>
        )}

        {/* Loading State */}
        {isLoading ? (
          <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            {[...Array(8)].map((_, index) => (
              <div key={index} className="bg-card rounded-xl shadow-sm p-4 animate-pulse">
                <div className="aspect-square bg-muted rounded-lg mb-4"></div>
                <div className="h-6 bg-muted rounded w-3/4 mb-4"></div>
                <div className="h-4 bg-muted rounded w-full mb-2"></div>
              </div>
            ))}
          </div>
        ) : (
          /* Ingredients Grid */
          <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            {ingredients.length > 0 ? (
              ingredients.map((ingredient) => (
                <IngredientCard key={ingredient.id} ingredient={ingredient} />
              ))
            ) : (
              <div className="col-span-full text-center py-12">
                <h3 className="text-xl font-semibold text-foreground mb-2">
                  No ingredients found
                </h3>
                <p className="text-muted-foreground">
                  Try adjusting your search to find what you're looking for.
                </p>
              </div>
            )}
          </div>
        )}
      </div>
    </div>
  );
} 
import React from 'react';
import Image from 'next/image';
import Link from 'next/link';
import { Ingredient } from '@/types/ingredient';
import { cn } from '@/lib/utils';

interface IngredientCardProps {
  ingredient: Ingredient;
}

export function IngredientCard({ ingredient }: IngredientCardProps) {
  // Ensure basePrice is properly formatted to avoid hydration issues
  const formattedPrice = ingredient.basePrice 
    ? `€${parseFloat(ingredient.basePrice).toFixed(2)}` 
    : null;

  return (
    <Link href={`/ingredients/${ingredient.id}`} className="block">
      <div className="bg-card rounded-lg shadow-md overflow-hidden transition-transform hover:scale-105">
        <div className="relative h-48 w-full">
          {ingredient.image ? (
            <Image
              src={ingredient.image}
              alt={ingredient.name}
              fill
              className="object-cover"
            />
          ) : (
            <div className="w-full h-full flex items-center justify-center bg-muted">
              <span className="text-muted-foreground text-xl">No Image</span>
            </div>
          )}
        </div>
        <div className="p-4">
          <h3 className="text-lg font-semibold text-foreground">{ingredient.name}</h3>
          {ingredient.description && (
            <p className="text-muted-foreground mt-2 line-clamp-2">{ingredient.description}</p>
          )}
          <div className="mt-4 flex justify-between items-center">
            <span className="text-sm text-muted-foreground">{ingredient.unit}</span>
            {formattedPrice && (
              <span className="text-sm font-medium text-green-600">
                {formattedPrice}
              </span>
            )}
          </div>
        </div>
      </div>
    </Link>
  );
} 
import React from 'react';
import Image from 'next/image';
import Link from 'next/link';
import { Ingredient } from '@/types/ingredient';

interface IngredientCardProps {
  ingredient: Ingredient;
}

export function IngredientCard({ ingredient }: IngredientCardProps) {
  return (
    <Link href={`/ingredients/${ingredient.id}`} className="block">
      <div className="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:scale-105">
        <div className="relative h-48 w-full">
          {ingredient.image ? (
            <Image
              src={ingredient.image}
              alt={ingredient.name}
              fill
              className="object-cover"
            />
          ) : (
            <div className="w-full h-full flex items-center justify-center bg-gray-200">
              <span className="text-gray-400 text-xl">No Image</span>
            </div>
          )}
        </div>
        <div className="p-4">
          <h3 className="text-lg font-semibold text-gray-800">{ingredient.name}</h3>
          {ingredient.description && (
            <p className="text-gray-600 mt-2 line-clamp-2">{ingredient.description}</p>
          )}
          <div className="mt-4 flex justify-between items-center">
            <span className="text-sm text-gray-500">{ingredient.unit}</span>
            {ingredient.basePrice && (
              <span className="text-sm font-medium text-green-600">
                €{parseFloat(ingredient.basePrice).toFixed(2)}
              </span>
            )}
          </div>
        </div>
      </div>
    </Link>
  );
} 
'use client';

import { useState, useEffect } from 'react';
import Image from 'next/image';
import Link from 'next/link';
import { useRouter } from 'next/navigation';
import { fetchIngredientById } from '@/services/api';
import { Metadata } from 'next';
import { ArrowLeft, AlertCircle } from 'lucide-react';
import { Ingredient } from '@/types/ingredient';


export default function IngredientPage({ params }: { params: { id: string } }) {
  const router = useRouter();
  const [ingredient, setIngredient] = useState<Ingredient | null>(null);
  const [isLoading, setIsLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const loadIngredient = async () => {
      try {
        setIsLoading(true);
        setError(null);
        const { data } = await fetchIngredientById(parseInt(params.id));
        setIngredient(data);
      } catch (err) {
        setError(err instanceof Error ? err.message : 'Failed to load ingredient');
      } finally {
        setIsLoading(false);
      }
    };

    loadIngredient();
  }, [params.id]);

  if (isLoading) {
    return (
      <div className="container mx-auto py-8 px-4">
        <div className="animate-pulse">
          <div className="h-8 w-32 bg-muted rounded mb-6" /> {/* Back button */}
          <div className="bg-card rounded-lg shadow-md overflow-hidden">
            <div className="md:flex">
              <div className="md:w-1/3">
                <div className="h-64 md:h-96 bg-muted" /> {/* Image placeholder */}
              </div>
              <div className="md:w-2/3 p-6">
                <div className="h-8 bg-muted rounded w-3/4 mb-4" /> {/* Title */}
                <div className="h-4 bg-muted rounded w-full mb-2" /> {/* Description */}
                <div className="h-4 bg-muted rounded w-2/3 mb-6" />
                
                <div className="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                  <div className="h-20 bg-muted rounded" /> {/* Unit */}
                  <div className="h-20 bg-muted rounded" /> {/* Price */}
                </div>
                
                <div className="h-40 bg-muted rounded" /> {/* Nutritional info */}
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }

  if (error) {
    return (
      <div className="container mx-auto py-8 px-4">
        <Link 
          href="/ingredients" 
          className="inline-flex items-center mb-6 text-muted-foreground hover:text-foreground"
        >
          <ArrowLeft className="w-4 h-4 mr-2" />
          Back to ingredients
        </Link>

        <div className="rounded-lg bg-destructive/10 p-4 border border-destructive/20">
          <div className="flex">
            <div className="flex-shrink-0">
              <AlertCircle className="h-5 w-5 text-destructive" />
            </div>
            <div className="ml-3">
              <h3 className="text-sm font-medium text-destructive">
                Error loading ingredient
              </h3>
              <p className="mt-1 text-sm text-destructive/80">{error}</p>
            </div>
          </div>
        </div>
      </div>
    );
  }

  if (!ingredient) {
    router.push('/404');
    return null;
  }

  return (
    <div className="container mx-auto py-8 px-4">
      <Link 
        href="/ingredients" 
        className="inline-flex items-center mb-6 text-muted-foreground hover:text-foreground transition-colors"
      >
        <ArrowLeft className="w-4 h-4 mr-2" />
        Back to ingredients
      </Link>

      <div className="bg-card rounded-lg shadow-md overflow-hidden">
        <div className="md:flex">
          <div className="md:w-1/3">
            <div className="relative h-64 md:h-96 w-full">
              {ingredient.image ? (
                <Image
                  src={ingredient.image}
                  alt={ingredient.name}
                  fill
                  className="object-cover"
                  priority
                />
              ) : (
                <div className="w-full h-full flex items-center justify-center bg-muted">
                  <span className="text-muted-foreground text-xl">No Image</span>
                </div>
              )}
            </div>
          </div>
          <div className="md:w-2/3 p-6">
            <h1 className="text-3xl font-bold text-foreground">{ingredient.name}</h1>
            
            {ingredient.description && (
              <p className="mt-4 text-muted-foreground">{ingredient.description}</p>
            )}
            
            <div className="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
              <div className="bg-muted/50 p-4 rounded-lg">
                <h3 className="font-medium text-foreground">Unit</h3>
                <p className="mt-1 text-muted-foreground">{ingredient.unit}</p>
              </div>
              
              {ingredient.basePrice && (
                <div className="bg-muted/50 p-4 rounded-lg">
                  <h3 className="font-medium text-foreground">Base Price</h3>
                  <p className="mt-1 text-green-600 font-medium">
                    €{parseFloat(ingredient.basePrice).toFixed(2)}
                  </p>
                </div>
              )}
            </div>
            
            {ingredient.nutritionalInfo && (
              <div className="mt-6">
                <h3 className="text-xl font-semibold text-foreground mb-3">
                  Nutritional Information
                </h3>
                <div className="bg-muted/50 p-4 rounded-lg">
                  <ul className="space-y-2">
                    {Object.entries(ingredient.nutritionalInfo).map(([key, value]) => (
                      <li key={key} className="flex justify-between">
                        <span className="text-muted-foreground capitalize">{key}</span>
                        <span className="font-medium text-foreground">{value}</span>
                      </li>
                    ))}
                  </ul>
                </div>
              </div>
            )}
          </div>
        </div>
      </div>
    </div>
  );
} 
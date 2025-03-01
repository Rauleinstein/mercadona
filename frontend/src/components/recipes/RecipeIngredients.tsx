import { ScrollArea } from '@/components/ui/scroll-area';
import { Card, CardContent } from '@/components/ui/card';
import { Checkbox } from '@/components/ui/checkbox';
import { RecipeIngredient } from '@/types/recipe';
import { Ingredient } from '@/types/ingredient';
import Image from 'next/image';
import { ImageIcon } from 'lucide-react';

interface ExtendedRecipeIngredient extends Omit<RecipeIngredient, 'ingredient'> {
  ingredient: Ingredient;
}

interface RecipeIngredientsProps {
  ingredients: ExtendedRecipeIngredient[];
}

const RecipeIngredients = ({ ingredients }: RecipeIngredientsProps) => {
  return (
    <ScrollArea className="h-[400px] pr-4">
      <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
        {ingredients.map((item) => (
          <Card key={item.id} className="overflow-hidden">
            <div className="flex h-full">
              <div className="flex-1 p-4">
                <div className="flex items-start gap-4">
                  <div className="flex-shrink-0">
                    <Checkbox id={`ingredient-${item.id}`} className="mt-1" />
                  </div>
                  <div className="flex-1">
                    <div className="flex items-center justify-between mb-2">
                      <label
                        htmlFor={`ingredient-${item.id}`}
                        className="text-lg font-semibold leading-none"
                      >
                        {item.ingredient.name}
                      </label>
                      <span className="text-sm text-muted-foreground">
                        {item.quantity} {item.unit}
                      </span>
                    </div>
                    {item.ingredient.description && (
                      <p className="text-sm text-muted-foreground mt-2 line-clamp-2">
                        {item.ingredient.description}
                      </p>
                    )}
                  </div>
                </div>
              </div>
              <div className="relative w-32 min-h-[8rem]">
                {item.ingredient.image ? (
                  <Image
                    src={item.ingredient.image}
                    alt={item.ingredient.name}
                    fill
                    className="object-cover"
                  />
                ) : (
                  <div className="absolute inset-0 flex items-center justify-center bg-muted">
                    <ImageIcon className="h-8 w-8 text-muted-foreground" />
                  </div>
                )}
              </div>
            </div>
          </Card>
        ))}
      </div>
    </ScrollArea>
  );
};

export default RecipeIngredients; 
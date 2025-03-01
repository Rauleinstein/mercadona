import { ScrollArea } from '@/components/ui/scroll-area';
import { Checkbox } from '@/components/ui/checkbox';
import { RecipeIngredient } from '@/types/recipe';

interface RecipeIngredientsProps {
  ingredients: RecipeIngredient[];
}

const RecipeIngredients = ({ ingredients }: RecipeIngredientsProps) => {
  return (
    <ScrollArea className="h-[400px] pr-4">
      <div className="space-y-2">
        {ingredients.map((item) => (
          <div key={item.id} className="flex items-center gap-3">
            <Checkbox id={`ingredient-${item.id}`} className="print:hidden" />
            <label
              htmlFor={`ingredient-${item.id}`}
              className="flex-1 text-sm leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
            >
              <span className="font-medium">{item.quantity} {item.unit}</span>{' '}
              {item.ingredient.name}
            </label>
          </div>
        ))}
      </div>
    </ScrollArea>
  );
};

export default RecipeIngredients; 
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs';
import { RecipeIngredient } from '@/types/recipe';
import RecipeIngredients from './RecipeIngredients';
import RecipeInstructions from './RecipeInstructions';
import RecipeNutrition from './RecipeNutrition';

interface RecipeTabsProps {
  recipeIngredients: RecipeIngredient[];
  instructions: string;
}

const RecipeTabs = ({ recipeIngredients, instructions }: RecipeTabsProps) => {
  return (
    <Tabs defaultValue="ingredients" className="mb-8">
      <TabsList className="print:hidden">
        <TabsTrigger value="ingredients">Ingredients</TabsTrigger>
        <TabsTrigger value="instructions">Instructions</TabsTrigger>
        <TabsTrigger value="nutrition">Nutrition</TabsTrigger>
      </TabsList>
      <TabsContent value="ingredients" className="mt-6">
        <RecipeIngredients ingredients={recipeIngredients} />
      </TabsContent>
      <TabsContent value="instructions" className="mt-6">
        <RecipeInstructions instructions={instructions} />
      </TabsContent>
      <TabsContent value="nutrition" className="mt-6">
        <RecipeNutrition />
      </TabsContent>
    </Tabs>
  );
};

export default RecipeTabs; 
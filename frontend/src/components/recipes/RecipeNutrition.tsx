import { Info } from 'lucide-react';

const RecipeNutrition = () => {
  return (
    <div className="flex items-center justify-center h-[400px] bg-muted/50 rounded-lg">
      <div className="text-center">
        <Info className="h-12 w-12 text-muted-foreground mx-auto mb-4" />
        <p className="text-muted-foreground">
          Nutrition information will be available soon
        </p>
      </div>
    </div>
  );
};

export default RecipeNutrition; 
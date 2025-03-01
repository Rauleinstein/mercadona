import { Clock, ChefHat, Users } from 'lucide-react';
import { Card, CardContent } from '@/components/ui/card';
import { formatDuration } from '@/utils/time';

interface RecipeMetadataProps {
  preparationTime: number;
  cookingTime: number;
  servings: number;
  difficulty: string;
}

const RecipeMetadata = ({
  preparationTime,
  cookingTime,
  servings,
  difficulty,
}: RecipeMetadataProps) => {
  return (
    <div className="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
      <Card>
        <CardContent className="p-4 flex flex-col items-center text-center">
          <Clock className="h-6 w-6 text-primary mb-2" />
          <div className="text-sm font-medium">Prep Time</div>
          <div className="text-muted-foreground">{formatDuration(preparationTime)}</div>
        </CardContent>
      </Card>
      <Card>
        <CardContent className="p-4 flex flex-col items-center text-center">
          <Clock className="h-6 w-6 text-primary mb-2" />
          <div className="text-sm font-medium">Cook Time</div>
          <div className="text-muted-foreground">{formatDuration(cookingTime)}</div>
        </CardContent>
      </Card>
      <Card>
        <CardContent className="p-4 flex flex-col items-center text-center">
          <Users className="h-6 w-6 text-primary mb-2" />
          <div className="text-sm font-medium">Servings</div>
          <div className="text-muted-foreground">{servings}</div>
        </CardContent>
      </Card>
      <Card>
        <CardContent className="p-4 flex flex-col items-center text-center">
          <ChefHat className="h-6 w-6 text-primary mb-2" />
          <div className="text-sm font-medium">Difficulty</div>
          <div className="text-muted-foreground capitalize">{difficulty}</div>
        </CardContent>
      </Card>
    </div>
  );
};

export default RecipeMetadata; 
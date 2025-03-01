import Image from 'next/image';
import Link from 'next/link';
import { Clock, BarChart3, Users } from 'lucide-react';
import { Recipe } from '@/types/recipe';
import { 
  Card, 
  CardContent, 
  CardFooter, 
  CardHeader, 
  CardTitle, 
  CardDescription 
} from '@/components/ui/card';
import { cn } from '@/lib/utils';

interface RecipeCardProps {
  recipe: Recipe;
}

export default function RecipeCard({ recipe }: RecipeCardProps) {
  const totalTime = recipe.preparationTime + recipe.cookingTime;
  const mainCategory = recipe.categories[0]?.name || 'Uncategorized';

  return (
    <Link href={`/recipes/${recipe.id}`} className="block h-full">
      <Card className="h-full overflow-hidden transition-all hover:shadow-md">
        <div className="aspect-video relative overflow-hidden">
          <Image
            src={recipe.image || '/recipe-placeholder.svg'}
            alt={recipe.name}
            fill
            className="object-cover transition-transform hover:scale-105"
          />
        </div>
        <CardHeader className="pb-2">
          <div className="flex justify-between items-start gap-2">
            <CardTitle className="text-xl font-semibold tracking-tight">{recipe.name}</CardTitle>
            <span className="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary/10 text-primary">
              {mainCategory}
            </span>
          </div>
          <CardDescription className="line-clamp-2 leading-relaxed">
            {recipe.description}
          </CardDescription>
        </CardHeader>
        <CardFooter className="flex items-center justify-between text-sm text-muted-foreground pt-0">
          <div className="flex items-center">
            <Clock className="w-4 h-4 mr-1" />
            {totalTime} mins
          </div>
          <div className="flex items-center">
            <BarChart3 className="w-4 h-4 mr-1" />
            <span className="capitalize">{recipe.difficulty}</span>
          </div>
          <div className="flex items-center">
            <Users className="w-4 h-4 mr-1" />
            {recipe.servings} servings
          </div>
        </CardFooter>
      </Card>
    </Link>
  );
} 

import { Card, CardContent } from '@/components/ui/card';
import { Skeleton } from '@/components/ui/skeleton';

const RecipeLoading = () => {
  return (
    <div className="container mx-auto px-4 py-8">
      <Card className="max-w-4xl mx-auto overflow-hidden">
        <div className="relative w-full h-[400px]">
          <Skeleton className="h-full w-full" />
        </div>
        <CardContent className="p-6">
          <Skeleton className="h-8 w-2/3 mb-4" />
          <Skeleton className="h-4 w-full mb-6" />
          <div className="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            {[...Array(4)].map((_, i) => (
              <Skeleton key={i} className="h-12 w-full" />
            ))}
          </div>
          <div className="space-y-4">
            {[...Array(3)].map((_, i) => (
              <Skeleton key={i} className="h-4 w-full" />
            ))}
          </div>
        </CardContent>
      </Card>
    </div>
  );
};

export default RecipeLoading; 
import { Printer, Share2, Tag } from 'lucide-react';
import { Button } from '@/components/ui/button';
import { Badge } from '@/components/ui/badge';
import { Category } from '@/types/recipe';
import { useEffect, useState } from 'react';
import { ClientOnly } from '@/components/client-only';

interface RecipeActionsProps {
  categories: Category[];
  recipeName: string;
  recipeDescription: string;
}

const RecipeActions = ({
  categories,
  recipeName,
  recipeDescription,
}: RecipeActionsProps) => {
  const [canShare, setCanShare] = useState(false);

  useEffect(() => {
    // Check if the share API is available on the client side
    setCanShare(!!navigator.share);
  }, []);

  const handlePrint = () => {
    window.print();
  };

  const handleShare = async () => {
    if (navigator.share) {
      try {
        await navigator.share({
          title: recipeName,
          text: recipeDescription,
          url: window.location.href,
        });
      } catch (error) {
        console.error('Error sharing:', error);
      }
    }
  };

  return (
    <div className="flex flex-wrap items-center gap-4 mb-8 print:hidden">
      <ClientOnly>
        <Button variant="outline" size="sm" onClick={handlePrint}>
          <Printer className="h-4 w-4 mr-2" />
          Print Recipe
        </Button>
        
        {canShare && (
          <Button variant="outline" size="sm" onClick={handleShare}>
            <Share2 className="h-4 w-4 mr-2" />
            Share
          </Button>
        )}
      </ClientOnly>
      
      <div className="ml-auto flex gap-2">
        {categories.map((category) => (
          <Badge key={category.id} variant="secondary">
            <Tag className="h-3 w-3 mr-1" />
            {category.name}
          </Badge>
        ))}
      </div>
    </div>
  );
};

export default RecipeActions; 
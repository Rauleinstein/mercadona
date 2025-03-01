import { User } from '@/types/recipe';

interface RecipeFooterProps {
  author: User;
  updatedAt: string;
}

const RecipeFooter = ({ author, updatedAt }: RecipeFooterProps) => {
  return (
    <footer className="mt-8 pt-6 border-t border-border">
      <div className="flex items-center justify-between text-sm text-muted-foreground">
        <div className="flex items-center gap-2">
          <span className="font-medium">Created by</span>
          <span>{author.name}</span>
        </div>
        <div className="flex items-center gap-2">
          <span className="font-medium">Last updated</span>
          <span>{new Date(updatedAt).toLocaleDateString()}</span>
        </div>
      </div>
    </footer>
  );
};

export default RecipeFooter; 
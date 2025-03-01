import { AlertCircle } from 'lucide-react';

interface RecipeErrorProps {
  error: string;
}

const RecipeError = ({ error }: RecipeErrorProps) => {
  return (
    <div className="container mx-auto px-4 py-8 flex justify-center items-center min-h-[400px]">
      <div className="flex items-center gap-2 text-lg text-destructive">
        <AlertCircle className="h-5 w-5" />
        {error}
      </div>
    </div>
  );
};

export default RecipeError; 
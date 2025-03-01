import Image from 'next/image';
import { ChefHat } from 'lucide-react';

interface RecipeHeaderProps {
  name: string;
  image: string | null;
  description: string;
}

const RecipeHeader = ({ name, image, description }: RecipeHeaderProps) => {
  return (
    <div className="relative w-full h-[400px] md:h-[500px]">
      {image ? (
        <>
          <Image
            src={image}
            alt={name}
            fill
            className="object-cover"
            priority
          />
          <div className="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent" />
          <div className="absolute bottom-0 left-0 right-0 p-6 text-white">
            <h1 className="text-3xl md:text-4xl font-bold mb-2">{name}</h1>
            <p className="text-white/90 max-w-2xl">{description}</p>
          </div>
        </>
      ) : (
        <div className="h-full flex items-center justify-center bg-muted">
          <ChefHat className="h-20 w-20 text-muted-foreground" />
        </div>
      )}
    </div>
  );
};

export default RecipeHeader; 
import { ScrollArea } from '@/components/ui/scroll-area';

interface RecipeInstructionsProps {
  instructions: string;
}

const RecipeInstructions = ({ instructions }: RecipeInstructionsProps) => {
  return (
    <ScrollArea className="h-[400px] pr-4">
      <div className="space-y-6">
        {instructions.split('\n').map((instruction, index) => (
          instruction.trim() && (
            <div key={index} className="flex gap-4">
              <div className="flex-none">
                <div className="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center">
                  <span className="text-sm font-medium text-primary">{index + 1}</span>
                </div>
              </div>
              <p className="flex-1 text-foreground">{instruction}</p>
            </div>
          )
        ))}
      </div>
    </ScrollArea>
  );
};

export default RecipeInstructions; 
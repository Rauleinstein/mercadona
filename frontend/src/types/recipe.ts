export interface Category {
  id: number;
  name: string;
}

export interface User {
  id: number;
  email: string;
  name: string;
}

export interface RecipeIngredient {
  id: number;
  quantity: number;
  unit: string;
  ingredient: {
    id: number;
    name: string;
    description?: string;
  };
}

export interface Recipe {
  id: number;
  name: string;
  description: string;
  preparationTime: number;
  cookingTime: number;
  servings: number;
  difficulty: string;
  instructions: string;
  image: string | null;
  author: User;
  categories: Category[];
  recipeIngredients: RecipeIngredient[];
  createdAt: string;
  updatedAt: string;
}

export interface RecipeFilters {
  search?: string;
  category?: string;
  difficulty?: string;
}

export interface ApiResponse<T> {
  data: T;
  message?: string;
  error?: string;
} 

export interface Ingredient {
  id: number;
  name: string;
  description: string | null;
  image: string | null;
  unit: string;
  nutritionalInfo: Record<string, any> | null;
  basePrice: string | null;
}

export interface IngredientFilters {
  search?: string;
}

export interface ApiResponse<T> {
  data: T;
  error?: string;
} 
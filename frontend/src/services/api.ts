import { Recipe, RecipeFilters, ApiResponse } from '@/types/recipe';
import { Ingredient, IngredientFilters } from '@/types/ingredient';

// Helper function to determine if we're on the server side
const isServer = typeof window === 'undefined';

// Function to get the base URL depending on the environment
function getBaseUrl(): string {
  if (process.env.NEXT_PUBLIC_API_URL) {
    return process.env.NEXT_PUBLIC_API_URL;
  }
  // For client-side requests, use localhost
  return 'http://localhost:8000/api';
}

const API_BASE_URL = getBaseUrl();

class ApiError extends Error {
  constructor(public status: number, message: string) {
    super(message);
    this.name = 'ApiError';
  }
}

async function handleResponse<T>(response: Response): Promise<T> {
  if (!response.ok) {
    const error = await response.json().catch(() => ({ message: 'An error occurred' }));
    throw new ApiError(response.status, error.message || `HTTP error! status: ${response.status}`);
  }
  return response.json();
}

export async function fetchRecipes(filters?: RecipeFilters): Promise<ApiResponse<Recipe[]>> {
  const queryParams = new URLSearchParams();
  
  if (filters?.search) {
    queryParams.append('search', filters.search);
  }
  if (filters?.category) {
    queryParams.append('category', filters.category);
  }
  if (filters?.difficulty) {
    queryParams.append('difficulty', filters.difficulty);
  }

  const url = `${API_BASE_URL}/recipes${queryParams.toString() ? `?${queryParams.toString()}` : ''}`;
  
  try {
    const response = await fetch(url, {
      headers: {
        'Accept': 'application/json',
      },
      next: {
        revalidate: 60, // Cache for 60 seconds
      },
    });
    return handleResponse<ApiResponse<Recipe[]>>(response);
  } catch (error) {
    if (error instanceof ApiError) {
      throw error;
    }
    throw new ApiError(500, 'Failed to fetch recipes');
  }
}

export async function fetchRecipeById(id: number): Promise<ApiResponse<Recipe>> {
  const url = `${API_BASE_URL}/recipes/${id}`;

  const response = await fetch(url, {
    headers: {
      'Accept': 'application/json',
    },
    next: {
      revalidate: 5, // Cache for 60 seconds
    },
  });

  return handleResponse<ApiResponse<Recipe>>(response);
}

export async function createRecipe(recipe: Omit<Recipe, 'id'>): Promise<ApiResponse<Recipe>> {
  try {
    const response = await fetch(`${API_BASE_URL}/recipes`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
      },
      body: JSON.stringify(recipe),
    });
    return handleResponse<ApiResponse<Recipe>>(response);
  } catch (error) {
    if (error instanceof ApiError) {
      throw error;
    }
    throw new ApiError(500, 'Failed to create recipe');
  }
}

export async function updateRecipe(id: number, recipe: Partial<Recipe>): Promise<ApiResponse<Recipe>> {
  try {
    const response = await fetch(`${API_BASE_URL}/recipes/${id}`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
      },
      body: JSON.stringify(recipe),
    });
    return handleResponse<ApiResponse<Recipe>>(response);
  } catch (error) {
    if (error instanceof ApiError) {
      throw error;
    }
    throw new ApiError(500, 'Failed to update recipe');
  }
}

export async function deleteRecipe(id: number): Promise<ApiResponse<void>> {
  try {
    const response = await fetch(`${API_BASE_URL}/recipes/${id}`, {
      method: 'DELETE',
      headers: {
        'Accept': 'application/json',
      },
    });
    return handleResponse<ApiResponse<void>>(response);
  } catch (error) {
    if (error instanceof ApiError) {
      throw error;
    }
    throw new ApiError(500, 'Failed to delete recipe');
  }
}

export async function fetchIngredients(filters?: IngredientFilters): Promise<ApiResponse<Ingredient[]>> {

  const url = `${API_BASE_URL}/ingredients`;

  console.log('Fetching ingredients from:', url);
  
  try {
    const response = await fetch(url, {
      headers: {
        'Accept': 'application/json',
      },
      next: {
        revalidate: 60, // Cache for 60 seconds
      },
    });
    return handleResponse<ApiResponse<Ingredient[]>>(response);
  } catch (error) {
    if (error instanceof ApiError) {
      throw error;
    }
    throw new ApiError(500, 'Failed to fetch ingredients');
  }
}

export async function fetchIngredientById(id: number): Promise<ApiResponse<Ingredient>> {
  const url = `${API_BASE_URL}/ingredients/${id}`;
  console.log('Fetching ingredient from:', url);

  const response = await fetch(url, {
    headers: {
      'Accept': 'application/json',
    },
    next: {
      revalidate: 60, // Cache for 60 seconds
    },
  });

  return handleResponse<ApiResponse<Ingredient>>(response);
} 
 
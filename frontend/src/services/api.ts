import { Recipe, RecipeFilters, ApiResponse } from '@/types/recipe';

// Helper function to determine if we're on the server side
const isServer = typeof window === 'undefined';

// Function to get the base URL depending on the environment
function getBaseUrl(): string {
  if (process.env.NEXT_PUBLIC_API_URL) {
    return process.env.NEXT_PUBLIC_API_URL;
  }
  
  // For server-side requests, use the internal Docker network
  if (isServer) {
    return 'http://backend:8000/api';
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
  try {
    const url = `${API_BASE_URL}/recipes/${id}`;
    
    const response = await fetch(url, {
      method: 'GET',
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
      },
      next: {
        revalidate: 60,
      },
    });
    
    if (!response.ok) {
      console.error("[API] Error response:", response.status, response.statusText);
      const errorData = await response.json().catch(() => ({ message: 'Failed to parse error response' }));
      console.error("[API] Error data:", errorData);
      throw new ApiError(response.status, errorData.message || `HTTP error! status: ${response.status}`);
    }
    
    const data = await response.json();
    return data;
  } catch (error: unknown) {
    
    if (error instanceof Error) {
      console.error("[API] Error details:", {
        message: error.message,
        name: error.name,
        stack: error.stack
      });
    }
    
    if (error instanceof TypeError && error.message === 'Failed to fetch') {
      throw new ApiError(503, 'Unable to connect to the API server. Please ensure the backend server is running.');
    }
    
    if (error instanceof ApiError) {
      throw error;
    }
    
    throw new ApiError(500, error instanceof Error ? error.message : 'Failed to fetch recipe');
  }
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
 
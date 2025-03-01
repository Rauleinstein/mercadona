import Link from 'next/link';
import { ArrowLeft } from 'lucide-react';

export default function IngredientsNotFound() {
  return (
    <div className="container mx-auto py-16 px-4 text-center">
      <h1 className="text-4xl font-bold text-gray-900 mb-4">Ingredient Not Found</h1>
      <p className="text-xl text-gray-600 mb-8">
        Sorry, the ingredient you are looking for could not be found.
      </p>
      <Link
        href="/ingredients"
        className="inline-flex items-center text-green-600 hover:text-green-700"
      >
        <ArrowLeft className="w-4 h-4 mr-2" />
        Back to ingredients
      </Link>
    </div>
  );
} 
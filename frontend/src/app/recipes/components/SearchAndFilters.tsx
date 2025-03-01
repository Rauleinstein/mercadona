'use client';

import { useState } from 'react';

interface SearchAndFiltersProps {
  onSearch: (query: string) => void;
  onCategoryChange: (category: string) => void;
  onDifficultyChange: (difficulty: string) => void;
}

export default function SearchAndFilters({
  onSearch,
  onCategoryChange,
  onDifficultyChange,
}: SearchAndFiltersProps) {
  const [searchQuery, setSearchQuery] = useState('');

  const handleSearch = (e: React.ChangeEvent<HTMLInputElement>) => {
    const query = e.target.value;
    setSearchQuery(query);
    onSearch(query);
  };

  return (
    <div className="flex flex-col md:flex-row gap-4 mb-8">
      {/* Search Bar */}
      <div className="flex-1">
        <div className="relative">
          <input
            type="text"
            value={searchQuery}
            onChange={handleSearch}
            placeholder="Search recipes..."
            className="w-full px-4 py-3 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
          />
          <span className="absolute right-3 top-3 text-gray-400">
            <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
          </span>
        </div>
      </div>

      {/* Filter Buttons */}
      <div className="flex gap-4">
        <select 
          onChange={(e) => onCategoryChange(e.target.value)}
          className="px-4 py-3 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
        >
          <option value="">All Categories</option>
          <option value="main">Main Course</option>
          <option value="salad">Salad</option>
          <option value="dessert">Dessert</option>
        </select>
        <select 
          onChange={(e) => onDifficultyChange(e.target.value)}
          className="px-4 py-3 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
        >
          <option value="">All Difficulties</option>
          <option value="easy">Easy</option>
          <option value="medium">Medium</option>
          <option value="hard">Hard</option>
        </select>
      </div>
    </div>
  );
} 

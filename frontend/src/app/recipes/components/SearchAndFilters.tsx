'use client';

import { useState } from 'react';
import { Search } from 'lucide-react';
import { Input } from '@/components/ui/input';
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select';

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

  const handleCategoryChange = (value: string) => {
    // Convert "all" to empty string for the API
    onCategoryChange(value === "all" ? "" : value);
  };

  const handleDifficultyChange = (value: string) => {
    // Convert "all" to empty string for the API
    onDifficultyChange(value === "all" ? "" : value);
  };

  return (
    <div className="flex flex-col md:flex-row gap-4 mb-8">
      {/* Search Bar */}
      <div className="flex-1 relative">
        <div className="relative">
          <Input
            type="text"
            value={searchQuery}
            onChange={handleSearch}
            placeholder="Search recipes..."
            className="pl-10"
          />
          <Search className="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-muted-foreground" />
        </div>
      </div>

      {/* Filter Buttons */}
      <div className="flex gap-4">
        <Select onValueChange={handleCategoryChange} defaultValue="all">
          <SelectTrigger className="w-[180px]">
            <SelectValue placeholder="Category" />
          </SelectTrigger>
          <SelectContent>
            <SelectItem value="all">All Categories</SelectItem>
            <SelectItem value="main">Main Course</SelectItem>
            <SelectItem value="salad">Salad</SelectItem>
            <SelectItem value="dessert">Dessert</SelectItem>
          </SelectContent>
        </Select>
        
        <Select onValueChange={handleDifficultyChange} defaultValue="all">
          <SelectTrigger className="w-[180px]">
            <SelectValue placeholder="Difficulty" />
          </SelectTrigger>
          <SelectContent>
            <SelectItem value="all">All Difficulties</SelectItem>
            <SelectItem value="easy">Easy</SelectItem>
            <SelectItem value="medium">Medium</SelectItem>
            <SelectItem value="hard">Hard</SelectItem>
          </SelectContent>
        </Select>
      </div>
    </div>
  );
} 

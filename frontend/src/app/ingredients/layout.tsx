import React from 'react';
import { Metadata } from 'next';

export const metadata: Metadata = {
  title: 'Ingredients | Mercadona',
  description: 'Browse all available ingredients at Mercadona',
};

export default function IngredientsLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  return (
    <section className="bg-gray-50 min-h-screen">
      {children}
    </section>
  );
} 
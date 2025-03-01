import Image from "next/image";
import Link from "next/link";

export default function Home() {
  return (
    <div className="min-h-screen">
      {/* Hero Section */}
      <section className="relative h-[90vh] flex items-center justify-center bg-gradient-to-br from-emerald-50 to-teal-100 dark:from-emerald-950 dark:to-teal-900">
        <div className="container mx-auto px-6 relative z-10">
          <div className="flex flex-col lg:flex-row items-center gap-12">
            <div className="flex-1 text-center lg:text-left">
              <h1 className="text-4xl md:text-5xl lg:text-6xl font-bold text-emerald-950 dark:text-emerald-50 mb-6">
                Your Personal Recipe
                <span className="text-emerald-600 dark:text-emerald-400"> Assistant</span>
              </h1>
              <p className="text-lg md:text-xl text-gray-700 dark:text-gray-300 mb-8">
                Discover, create, and share delicious recipes. Plan your meals and shopping with ease.
              </p>
              <div className="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                <Link 
                  href="/recipes"
                  className="px-8 py-3 bg-emerald-600 text-white rounded-full hover:bg-emerald-700 transition duration-300 text-lg font-semibold"
                >
                  Explore Recipes
                </Link>
                <Link 
                  href="/signup"
                  className="px-8 py-3 border-2 border-emerald-600 text-emerald-600 dark:text-emerald-400 rounded-full hover:bg-emerald-600 hover:text-white transition duration-300 text-lg font-semibold"
                >
                  Get Started
                </Link>
              </div>
            </div>
            <div className="flex-1 relative">
              <div className="w-full aspect-square relative">
                <Image
                  src="/hero-image.svg"
                  alt="Recipe illustration"
                  fill
                  className="object-contain rounded-2xl"
                  priority
                />
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Features Section */}
      <section className="py-20 bg-white dark:bg-gray-900">
        <div className="container mx-auto px-6">
          <h2 className="text-3xl md:text-4xl font-bold text-center text-gray-900 dark:text-white mb-16">
            Everything you need to cook with confidence
          </h2>
          <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            {/* Recipe Management */}
            <div className="p-6 rounded-xl bg-gray-50 dark:bg-gray-800">
              <div className="w-12 h-12 bg-emerald-100 dark:bg-emerald-900 rounded-lg flex items-center justify-center mb-4">
                <svg className="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
              </div>
              <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-2">Recipe Management</h3>
              <p className="text-gray-600 dark:text-gray-400">Create, organize, and share your favorite recipes with step-by-step instructions.</p>
            </div>

            {/* Smart Shopping */}
            <div className="p-6 rounded-xl bg-gray-50 dark:bg-gray-800">
              <div className="w-12 h-12 bg-emerald-100 dark:bg-emerald-900 rounded-lg flex items-center justify-center mb-4">
                <svg className="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
              </div>
              <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-2">Smart Shopping Lists</h3>
              <p className="text-gray-600 dark:text-gray-400">Automatically generate shopping lists and track prices across different stores.</p>
            </div>

            {/* Meal Planning */}
            <div className="p-6 rounded-xl bg-gray-50 dark:bg-gray-800">
              <div className="w-12 h-12 bg-emerald-100 dark:bg-emerald-900 rounded-lg flex items-center justify-center mb-4">
                <svg className="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
              </div>
              <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-2">Meal Planning</h3>
              <p className="text-gray-600 dark:text-gray-400">Plan your weekly meals and get personalized recipe suggestions.</p>
            </div>
          </div>
        </div>
      </section>

      {/* CTA Section */}
      <section className="py-20 bg-emerald-600 dark:bg-emerald-800">
        <div className="container mx-auto px-6 text-center">
          <h2 className="text-3xl md:text-4xl font-bold text-white mb-8">
            Start Your Culinary Journey Today
          </h2>
          <p className="text-xl text-emerald-100 mb-8 max-w-2xl mx-auto">
            Join thousands of home cooks who are already enjoying easier meal planning and shopping.
          </p>
          <Link 
            href="/signup"
            className="inline-block px-8 py-3 bg-white text-emerald-600 rounded-full hover:bg-emerald-50 transition duration-300 text-lg font-semibold"
          >
            Create Free Account
          </Link>
        </div>
      </section>
    </div>
  );
}

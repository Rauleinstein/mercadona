import Image from "next/image";
import Link from "next/link";
import { Button } from "@/components/ui/button";
import { Card, CardContent } from "@/components/ui/card";
import { BookOpen, ShoppingCart, Calendar } from "lucide-react";

export default function Home() {
  return (
    <div className="min-h-screen">
      {/* Hero Section */}
      <section className="relative h-[90vh] flex items-center justify-center bg-gradient-to-br from-primary/5 to-primary/10 dark:from-primary/10 dark:to-primary/5">
        <div className="container mx-auto px-6 relative z-10">
          <div className="flex flex-col lg:flex-row items-center gap-12">
            <div className="flex-1 text-center lg:text-left">
              <h1 className="text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight text-foreground mb-6">
                Your Personal Recipe
                <span className="text-primary"> Assistant</span>
              </h1>
              <p className="text-xl text-muted-foreground mb-8 max-w-xl leading-relaxed">
                Discover, create, and share delicious recipes. Plan your meals and shopping with ease.
              </p>
              <div className="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                <Button asChild size="lg" className="rounded-full">
                  <Link href="/recipes">
                    Explore Recipes
                  </Link>
                </Button>
                <Button asChild variant="outline" size="lg" className="rounded-full">
                  <Link href="/signup">
                    Get Started
                  </Link>
                </Button>
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
      <section className="py-20 bg-background">
        <div className="container mx-auto px-6">
          <h2 className="text-3xl md:text-4xl font-bold text-center text-foreground mb-16 tracking-tight">
            Everything you need to cook with confidence
          </h2>
          <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            {/* Recipe Management */}
            <Card>
              <CardContent className="p-6">
                <div className="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
                  <BookOpen className="w-6 h-6 text-primary" />
                </div>
                <h3 className="text-xl font-semibold text-foreground mb-2">Recipe Management</h3>
                <p className="text-muted-foreground leading-relaxed">Create, organize, and share your favorite recipes with step-by-step instructions.</p>
              </CardContent>
            </Card>

            {/* Smart Shopping */}
            <Card>
              <CardContent className="p-6">
                <div className="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
                  <ShoppingCart className="w-6 h-6 text-primary" />
                </div>
                <h3 className="text-xl font-semibold text-foreground mb-2">Smart Shopping Lists</h3>
                <p className="text-muted-foreground leading-relaxed">Automatically generate shopping lists and track prices across different stores.</p>
              </CardContent>
            </Card>

            {/* Meal Planning */}
            <Card>
              <CardContent className="p-6">
                <div className="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
                  <Calendar className="w-6 h-6 text-primary" />
                </div>
                <h3 className="text-xl font-semibold text-foreground mb-2">Meal Planning</h3>
                <p className="text-muted-foreground leading-relaxed">Plan your weekly meals and get personalized recipe suggestions.</p>
              </CardContent>
            </Card>
          </div>
        </div>
      </section>

      {/* CTA Section */}
      <section className="py-20 bg-primary">
        <div className="container mx-auto px-6 text-center">
          <h2 className="text-3xl md:text-4xl font-bold text-primary-foreground mb-8 tracking-tight">
            Start Your Culinary Journey Today
          </h2>
          <p className="text-xl text-primary-foreground/80 mb-8 max-w-2xl mx-auto leading-relaxed">
            Join thousands of home cooks who are already enjoying easier meal planning and shopping.
          </p>
          <Button asChild size="lg" variant="secondary" className="rounded-full">
            <Link href="/signup">
              Create Free Account
            </Link>
          </Button>
        </div>
      </section>
    </div>
  );
}

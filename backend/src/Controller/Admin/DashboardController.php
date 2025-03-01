<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Ingredient;
use App\Entity\Recipe;
use App\Entity\RecipeIngredient;
use App\Entity\ShoppingList;
use App\Entity\ShoppingListItem;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(RecipeCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Recipe App Admin')
            ->setFaviconPath('favicon.svg')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Recipe Management');
        yield MenuItem::linkToCrud('Recipes', 'fas fa-utensils', Recipe::class);
        yield MenuItem::linkToCrud('Categories', 'fas fa-tags', Category::class);
        yield MenuItem::linkToCrud('Ingredients', 'fas fa-carrot', Ingredient::class);
        yield MenuItem::linkToCrud('Recipe Ingredients', 'fas fa-list', RecipeIngredient::class);

        yield MenuItem::section('Shopping');
        yield MenuItem::linkToCrud('Shopping Lists', 'fas fa-shopping-cart', ShoppingList::class);
        yield MenuItem::linkToCrud('Shopping List Items', 'fas fa-shopping-basket', ShoppingListItem::class);

        yield MenuItem::section('Users');
        yield MenuItem::linkToCrud('Users', 'fas fa-users', User::class);

        yield MenuItem::section('Tools');
        yield MenuItem::linkToRoute('Back to Website', 'fas fa-home', 'app_home');
    }
} 

<?php

namespace App\Controller\Admin;

use App\Entity\Recipe;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RecipeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Recipe::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Recipe')
            ->setEntityLabelInPlural('Recipes')
            ->setSearchFields(['name', 'description', 'instructions'])
            ->setDefaultSort(['createdAt' => 'DESC']);
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('name');
        yield TextEditorField::new('description')
            ->hideOnIndex();
        yield IntegerField::new('preparationTime')
            ->setLabel('Prep Time (min)');
        yield IntegerField::new('cookingTime')
            ->setLabel('Cook Time (min)');
        yield IntegerField::new('servings');
        yield TextField::new('difficulty')
            ->setFormTypeOption('choices', [
                'Easy' => 'easy',
                'Medium' => 'medium',
                'Hard' => 'hard'
            ]);
        yield TextEditorField::new('instructions')
            ->hideOnIndex();
        yield ImageField::new('image')
            ->setBasePath('uploads/recipes')
            ->setUploadDir('public/uploads/recipes')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(false);
        yield AssociationField::new('author');
        yield AssociationField::new('categories');
        yield CollectionField::new('recipeIngredients')
            ->useEntryCrudForm(RecipeIngredientCrudController::class)
            ->hideOnIndex();
        yield DateTimeField::new('createdAt')
            ->hideOnForm();
        yield DateTimeField::new('updatedAt')
            ->hideOnForm();
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_EDIT, Action::SAVE_AND_ADD_ANOTHER);
    }
} 

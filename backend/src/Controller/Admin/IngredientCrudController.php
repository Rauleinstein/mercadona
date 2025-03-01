<?php

namespace App\Controller\Admin;

use App\Entity\Ingredient;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;

class IngredientCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ingredient::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Ingredient')
            ->setEntityLabelInPlural('Ingredients')
            ->setSearchFields(['name', 'description'])
            ->setDefaultSort(['name' => 'ASC']);
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('name');
        yield TextEditorField::new('description')
            ->hideOnIndex();
        yield ImageField::new('image')
            ->setBasePath('uploads/ingredients')
            ->setUploadDir('public/uploads/ingredients')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(false);
        yield TextField::new('unit')
            ->setFormTypeOption('choices', [
                'Grams' => 'g',
                'Kilograms' => 'kg',
                'Milliliters' => 'ml',
                'Liters' => 'l',
                'Units' => 'unit',
                'Pieces' => 'pcs',
                'Tablespoons' => 'tbsp',
                'Teaspoons' => 'tsp'
            ]);
        yield ArrayField::new('nutritionalInfo')
            ->hideOnIndex();
        yield MoneyField::new('basePrice')
            ->setCurrency('EUR')
            ->setStoredAsCents(false);
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

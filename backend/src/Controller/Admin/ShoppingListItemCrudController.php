<?php

namespace App\Controller\Admin;

use App\Entity\ShoppingListItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ShoppingListItemCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ShoppingListItem::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Shopping List Item')
            ->setEntityLabelInPlural('Shopping List Items')
            ->setDefaultSort(['id' => 'ASC']);
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield AssociationField::new('shoppingList');
        yield AssociationField::new('ingredient');
        yield NumberField::new('quantity')
            ->setNumDecimals(2);
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
        yield BooleanField::new('purchased');
        yield TextField::new('notes');
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

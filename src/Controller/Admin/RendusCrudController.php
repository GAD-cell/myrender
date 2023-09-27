<?php

namespace App\Controller\Admin;

use App\Entity\Rendus;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class RendusCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Rendus::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            // Id shouldn't be modified
            IdField::new('id')->hideOnForm(),
            // Completed will be rendered as a toggle only in edit
            BooleanField::new('completed')
                ->onlyOnForms()
                ->hideWhenCreating(),
            // otherwise it may be displayed on index as a string (as an Integer since Text won't be able to convert bool to string)
            IntegerField::new('completed')
                ->onlyOnIndex()
                ->formatValue(function ($value) {
                    return ($value ? 'COMPLETED' : 'ACTIVE');
                }),
            // Title will be rendered so as to include a link, and be striked whenever completed
            TextField::new('title')
                ->setTemplatePath('admin/fields/todo_index_title.html.twig'),
            DateField::new('created'),
            DateField::new('updated'),
        ];
    }
    
}

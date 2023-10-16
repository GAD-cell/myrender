<?php

namespace App\Controller\Admin;

use App\Entity\Rendu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RenduCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Rendu::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('logiciel'),
            TextField::new('moteur_rendu'),
            TextEditorField::new('description'),
            AssociationField::new('album')
        ];
    }
    
}

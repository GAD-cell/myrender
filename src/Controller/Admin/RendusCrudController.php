<?php

namespace App\Controller\Admin;

use App\Entity\Rendus;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;


class RendusCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Rendus::class;
    }

    

    
}


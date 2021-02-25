<?php

namespace App\Controller\Admin;

use App\Entity\Hideway;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class HidewayCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Hideway::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}

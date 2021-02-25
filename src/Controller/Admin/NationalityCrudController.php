<?php

namespace App\Controller\Admin;

use App\Entity\Nationality;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class NationalityCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Nationality::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            TextField::new('slug')->hideOnForm(),
        ];
    }
}

<?php

namespace App\Controller\Admin;

use App\Entity\Administrator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AdministratorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Administrator::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->setRequired(false),
            TextField::new('name'),
            TextField::new('firstName'),
            TextField::new('email'),
            TextField::new('password'),
            DateTimeField::new('createdAt')->hideOnForm(),
        ];
    }
}

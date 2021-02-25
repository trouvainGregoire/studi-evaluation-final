<?php

namespace App\Controller\Admin;

use App\Entity\Hideway;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class HidewayCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Hideway::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->setRequired(false)->hideOnForm(),
            TextField::new('address'),
            TextField::new('code'),
            AssociationField::new('country')->setRequired(true),
        ];
    }
}

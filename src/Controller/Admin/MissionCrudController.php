<?php

namespace App\Controller\Admin;

use App\Entity\Mission;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MissionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Mission::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
            AssociationField::new('type')->setRequired(true),
            AssociationField::new('status')->setRequired(true),
            AssociationField::new('agents')->setRequired(true),
            AssociationField::new('contacts')->setRequired(true),
            AssociationField::new('targets')->setRequired(true),
            AssociationField::new('hideways'),
            AssociationField::new('speciality')->setRequired(true),
            DateTimeField::new('startAt'),
            DateTimeField::new('endAt'),
            AssociationField::new('country')->setRequired(true),
            TextField::new('codeName'),
        ];

    }
}

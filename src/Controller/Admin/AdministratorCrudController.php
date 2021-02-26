<?php

namespace App\Controller\Admin;

use App\Entity\Administrator;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

class AdministratorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Administrator::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->setRequired(false)->hideOnForm(),
            TextField::new('name'),
            TextField::new('firstName'),
            TextField::new('email'),
            TextField::new('plainPassword')->setLabel('Password')->setRequired(true)->hideOnIndex(),
            DateTimeField::new('createdAt')->hideOnForm(),
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $encodedPassword = $this->encodePassword($entityInstance, $entityInstance->getPlainPassword());
        $entityInstance->setPassword($encodedPassword);

        parent::persistEntity($entityManager, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $encodedPassword = $this->encodePassword($entityInstance, $entityInstance->getPlainPassword());
        $entityInstance->setPassword($encodedPassword);

        parent::updateEntity($entityManager, $entityInstance);
    }

    private function encodePassword($administrator, $password)
    {
        $passwordEncoderFactory = new EncoderFactory([
            Administrator::class => new MessageDigestPasswordEncoder('sha512', true, 5000)
        ]);

        $encoder = $passwordEncoderFactory->getEncoder($administrator);

        return $encoder->encodePassword($password, $administrator->getSalt());
    }
}

<?php


namespace App\Validator;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class MissionContactValidator extends ConstraintValidator
{

    public function validate($value, Constraint $constraint)
    {
        if(!$constraint instanceof MissionContact){
            throw new UnexpectedTypeException($constraint, MissionContact::class);
        }

        // custom constraints should ignore null and empty values to allow
        // other constraints (NotBlank, NotNull, etc.) to take care of that
        if (null === $value || '' === $value) {
            return;
        }

        // On recupere l'entitée
        $mission = $this->context->getObject();

        // On verifie si chaque contact est bien de la même nationnalité que celle de la mission
        foreach ($mission->getContacts() as $contact){
            if($contact->getNationality()->getId() !== $mission->getCountry()->getNationality()->getId()){
                $this->context->buildViolation($constraint->message)
                    ->setParameter('{{ name }}', $contact->getName())
                    ->addViolation();
            }
        }

    }
}

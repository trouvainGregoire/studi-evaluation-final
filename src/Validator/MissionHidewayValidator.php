<?php


namespace App\Validator;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class MissionHidewayValidator extends ConstraintValidator
{

    public function validate($value, Constraint $constraint)
    {
        if(!$constraint instanceof MissionHideway){
            throw new UnexpectedTypeException($constraint, MissionHideway::class);
        }

        // custom constraints should ignore null and empty values to allow
        // other constraints (NotBlank, NotNull, etc.) to take care of that
        if (null === $value || '' === $value) {
            return;
        }

        // On recupere l'entitée
        $mission = $this->context->getObject();

        // On verifie si chaque planque est bien dans le pays de la mission
        foreach ($mission->getHideways() as $hideway){
            if($hideway->getCountry()->getId() !== $mission->getCountry()->getId()){
                $this->context->buildViolation($constraint->message)
                    ->setParameter('{{ name }}', $hideway->getAddress())
                    ->addViolation();
            }
        }
    }
}

<?php


namespace App\Validator;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class MissionAgentValidator extends ConstraintValidator
{

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof MissionAgent) {
            throw new UnexpectedTypeException($constraint, MissionAgent::class);
        }

        // custom constraints should ignore null and empty values to allow
        // other constraints (NotBlank, NotNull, etc.) to take care of that
        if (null === $value || '' === $value) {
            return;
        }

        // On recupere l'entitée
        $mission = $this->context->getObject();

        $atLeastOneAgentWithRequiredSpeciality = false;

        // On verifie s'il y a au moins 1 agent disposant de la spécialité requise
        foreach ($mission->getAgents() as $agent) {
            foreach ($agent->getSpecialities() as $speciality) {
                if ($speciality->getId() === $mission->getSpeciality()->getId()) {
                    $atLeastOneAgentWithRequiredSpeciality = true;
                }
            }
        }

        if (!$atLeastOneAgentWithRequiredSpeciality) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }

    }
}

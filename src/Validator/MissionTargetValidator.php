<?php


namespace App\Validator;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class MissionTargetValidator extends ConstraintValidator
{

    public function validate($value, Constraint $constraint)
    {
        if(!$constraint instanceof MissionTarget){
            throw new UnexpectedTypeException($constraint, MissionTarget::class);
        }

        // custom constraints should ignore null and empty values to allow
        // other constraints (NotBlank, NotNull, etc.) to take care of that
        if (null === $value || '' === $value) {
            return;
        }

        // On recupere l'entitée
        $mission = $this->context->getObject();

        // On verifie si chaque cible est bien d'une nationnalité différente que celle des agents
        foreach ($mission->getTargets() as $target){
            foreach ($mission->getAgents() as $agent){
                if($target->getNationality()->getId() === $agent->getNationality()->getId()){
                    $this->context->buildViolation($constraint->message)
                        ->setParameter('{{ name }}', $target->getName())
                        ->setParameter('{{ agentName }}', $agent->getName())
                        ->addViolation();
                }
            }
        }

    }
}

<?php


namespace App\Validator;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class MissionTarget extends Constraint
{
    public $message = 'The "{{ name }}" target cannot have the same nationality as the "{{ agentName }}" agent of the mission.';

    public function validatedBy()
    {
        return static::class.'Validator';
    }
}

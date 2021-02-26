<?php


namespace App\Validator;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class MissionAgent extends Constraint
{
    public $message = 'At least one agent with the required speciality of the mission must be assigned.';

    public function validatedBy()
    {
        return static::class.'Validator';
    }
}

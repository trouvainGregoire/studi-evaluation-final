<?php


namespace App\Validator;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class MissionHideway extends Constraint
{
    public $message = 'The "{{ name }}" hideway must be in the same country of the mission.';

    public function validatedBy()
    {
        return static::class.'Validator';
    }
}

<?php


namespace App\Validator;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class MissionContact extends Constraint
{
    public $message = 'The "{{ name }}" contact must be of the nationality of the country of the mission.';

    public function validatedBy()
    {
        return static::class.'Validator';
    }
}

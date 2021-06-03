<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Dni extends Constraint
{
    public $message = 'The string "{{ string }}" contains an illegal DNI.';
}

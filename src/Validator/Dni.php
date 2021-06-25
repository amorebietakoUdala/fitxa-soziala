<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Dni extends Constraint
{
    public $message = 'DNI edo Pasaporte okerra "{{ string }}" .';
}

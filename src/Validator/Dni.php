<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class Dni extends Constraint
{
    public $message = 'DNI edo Pasaporte okerra "{{ string }}" .';
}

<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class DniValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof Dni) {
            throw new UnexpectedTypeException($constraint, Dni::class);
        }

        $dokumentu_mota   = $this->context->getRoot()->get('dokumentu_mota')->getData();
        
        $jaiotze_data   = $this->context->getRoot()->get('jaiotze_data')->getData();
        
        $dni_noiz1 = clone $jaiotze_data;
        $dni_noiz=$dni_noiz1->modify ('+14 year')->getTimestamp();
        
        $now=time();
        
        if ( $dni_noiz >= $now && ( null === $value || '' === $value ) ) {
            if ( null === $value ) $value="";
            return;
        }
        
        if ( $dni_noiz <  $now && ( null === $value || '' === $value ) ) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', "" )
                ->addViolation();
            return ;
        }
        
        
        if ( stristr( (string) $dokumentu_mota, "pasap" ) !== false ) return;
        
        

        if (!is_string($value)) {
            // throw this exception if your validator cannot handle the passed type so that it can be marked as invalid
            throw new UnexpectedValueException($value, 'string');

            // separate multiple types using pipes
            // throw new UnexpectedValueException($value, 'string|int');
        }

        if (!$value || strlen($value) < 8 ){
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
            return ;
        
        }
        
        $nieLetra=['X'=>0, 'Y'=>1, 'Z'=>2];
        $balidazio=['T','R','W','A','G','M','Y','F','P','D','X','B','N','J','Z','S','Q','V','H','L','C','K','E'];
        
        $letra1=$value[0];
        if( !is_numeric($letra1) ){ //NIE
            if( isset($nieLetra[$letra1]) ){
                $value[0]=$nieLetra[$letra1];
            }else{
                $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
                return ;
            }
        }
        
        $letra=substr($value, -1);
        $z=substr($value, 0, -1);
        $r=intVal($z) % 23;
        
        if( $balidazio[$r] != $letra  ){
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
        
    }
}

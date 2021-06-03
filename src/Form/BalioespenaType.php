<?php

namespace App\Form;

use App\Entity\Balioespena;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BalioespenaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('parent', null, array(
                "label"=>"Goiko maila"
            ))
            ->add('maila_eu')
            ->add('maila_es')
            ->add('beste_balioespena', null, array(
                "label"=>"Beste balioespena aukera osatu behar da"
            ))
            ->add('mailan_bakarra', null, array(
                "label"=>"Maila berdinean hau bakarrik egon daiteke."
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Balioespena::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Nazionalitatea;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NazionalitateaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('parent', null, array(
                "label"=>"Goiko maila"
            ))
            ->add('maila_eu', null, array(
                "label"=>"Maila izena"
            ))
            ->add('maila_es', null, array(
                "label"=>"Nombre nivel"
            ))
            ->add('estatua', null, array(
                "label"=>"Estatua jarri behar da"
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Nazionalitatea::class,
        ]);
    }
}

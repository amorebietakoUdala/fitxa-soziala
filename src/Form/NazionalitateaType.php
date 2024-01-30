<?php

namespace App\Form;

use App\Entity\Nazionalitatea;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NazionalitateaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('parent', null, ["label"=>"Goiko maila"])
            ->add('maila_eu', null, ["label"=>"Maila izena"])
            ->add('maila_es', null, ["label"=>"Nombre nivel"])
            ->add('estatua', null, ["label"=>"Estatua jarri behar da"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Nazionalitatea::class,
        ]);
    }
}

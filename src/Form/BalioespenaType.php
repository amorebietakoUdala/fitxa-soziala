<?php

namespace App\Form;

use App\Entity\Balioespena;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BalioespenaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('parent', null, ["label"=>"Goiko maila"])
            ->add('maila_eu')
            ->add('maila_es')
            ->add('beste_balioespena', null, ["label"=>"Beste balioespena aukera osatu behar da"])
            ->add('mailan_bakarra', null, ["label"=>"Maila berdinean hau bakarrik egon daiteke."])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Balioespena::class,
        ]);
    }
}

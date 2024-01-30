<?php

namespace App\Form;

use App\Entity\Errolda;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ErroldaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('parent', null, ["label"=>"Goiko maila"])
            ->add('maila_eu')
            ->add('maila_es')
            ->add('errolda_data', null, ["label"=>"Errolda data jarri behar da"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Errolda::class,
        ]);
    }
}

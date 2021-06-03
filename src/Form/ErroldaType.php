<?php

namespace App\Form;

use App\Entity\Errolda;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ErroldaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('parent', null, array(
                "label"=>"Goiko maila"
            ))
            ->add('maila_eu')
            ->add('maila_es')
            ->add('errolda_data', null, array(
                "label"=>"Errolda data jarri behar da"
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Errolda::class,
        ]);
    }
}

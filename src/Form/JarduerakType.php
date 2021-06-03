<?php

namespace App\Form;

use App\Entity\Jarduerak;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JarduerakType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('parent', null, array(
                "label"=>"Goiko maila"
            ))
            ->add('maila_eu')
            ->add('maila_es')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Jarduerak::class,
        ]);
    }
}

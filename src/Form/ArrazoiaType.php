<?php

namespace App\Form;

use App\Entity\Arrazoia;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArrazoiaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('parent', null, array(
                "label"=>"Goiko maila"
            ))
            ->add('maila_eu')
            ->add('maila_es')
            ->add('beste_arrazoia', null, array(
                "label"=>"Beste menpekotasun aukera osatu behar da"
            ))
            ->add('beste_babeseza', null, array(
                "label"=>"Beste babez eza aukera osatu behar da"
            ))
            ->add('beste_bazterkeria', null, array(
                "label"=>"Beste bazterkeria aukera osatu behar da"
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Arrazoia::class,
        ]);
    }
}

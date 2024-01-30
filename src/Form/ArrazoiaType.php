<?php

namespace App\Form;

use App\Entity\Arrazoia;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArrazoiaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('parent', null, ["label"=>"Goiko maila"])
            ->add('maila_eu')
            ->add('maila_es')
            ->add('beste_arrazoia', null, ["label"=>"Beste menpekotasun aukera osatu behar da"])
            ->add('beste_babeseza', null, ["label"=>"Beste babez eza aukera osatu behar da"])
            ->add('beste_bazterkeria', null, ["label"=>"Beste bazterkeria aukera osatu behar da"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Arrazoia::class,
        ]);
    }
}

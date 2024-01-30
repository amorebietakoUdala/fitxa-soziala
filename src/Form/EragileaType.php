<?php

namespace App\Form;

use App\Entity\Eragilea;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EragileaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('parent', null, ["label"=>"Goiko maila"])
            ->add('eragilea_eu', null, ["label"=>"Eragilea euskaraz "])
            ->add('eragilea_es', null, ["label"=>"Demandante  "])
            ->add('beste_gaixotasun', null, ["label"=>"Beste gaixotasuna  "])
            ->add('beste_eragile', null, ["label"=>"Beste eragilea  "])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Eragilea::class,
        ]);
    }
}

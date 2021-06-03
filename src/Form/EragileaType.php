<?php

namespace App\Form;

use App\Entity\Eragilea;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EragileaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('parent', null, array(
                "label"=>"Goiko maila"
            ))
            ->add('eragilea_eu', null, array(
                "label"=>"Eragilea euskaraz "
            ))
            ->add('eragilea_es', null, array(
                "label"=>"Demandante  "
            ))
            ->add('beste_gaixotasun', null, array(
                "label"=>"Beste gaixotasuna  "
            ))
            ->add('beste_eragile', null, array(
                "label"=>"Beste eragilea  "
            ))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Eragilea::class,
        ]);
    }
}

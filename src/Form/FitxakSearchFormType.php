<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Balioespena;
use App\Entity\Egoera;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class FitxakSearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('egoera',EntityType::class,[
                'label'=>'Egoera',
                'placeholder' => '',
                'class' => Egoera::class,
                'required' => false,
            ])
            ->add('balioespena', EntityType::class,  [
                'label' => 'Balioespen Profesionala',
                'placeholder' => '',
                'class' => Balioespena::class,
                'required' => false,
                'choice_attr' => function($choice, $key, $value) {    
                    return ['class' => 'balioespena-input maila'.$choice->getLvl(),  "data-bestebalioespena"=>"b".$choice->getBesteBalioespena(), "data-tree"=>$choice->getRoot()->getId(), "data-parent"=>$choice->getParentID(), "data-lvl" => $choice->getLvl(), "data-mailanbakarra" =>  "b".$choice->getMailanBakarra(),  ];
                },
                'attr' => [ 'class' => 'balioespena_tree'],
                'query_builder' => function($em) {
                    return $em->balioespenaLevelQB();
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}

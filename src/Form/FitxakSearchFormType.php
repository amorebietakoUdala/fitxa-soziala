<?php

namespace App\Form;

use App\Entity\Arrazoia;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Balioespena;
use App\Entity\Egoera;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class FitxakSearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
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
                'choice_attr' => fn($choice, $key, $value) => ['class' => 'balioespena-input maila'.$choice->getLvl(),  "data-bestebalioespena"=>"b".$choice->getBesteBalioespena(), "data-tree"=>$choice->getRoot()->getId(), "data-parent"=>$choice->getParentID(), "data-lvl" => $choice->getLvl(), "data-mailanbakarra" =>  "b".$choice->getMailanBakarra(),  ],
                'attr' => [ 'class' => 'balioespena_tree'],
                'query_builder' => fn($em) => $em->balioespenaLevelQB()
            ])
            ->add('arrazoia', EntityType::class,  [
                'label' => 'Arrazoia',
                'placeholder' => '',
                'class' => Arrazoia::class,
                'required' => false,
                'choice_attr' => fn($choice, $key, $value) => [
                    'class' => 'balioespena-input maila'.$choice->getLvl(),  
                    "data-bestearrazoia"=>"b".$choice->getBesteArrazoia(), 
                    "data-tree"=>$choice->getRoot()->getId(), 
                    "data-parent"=>$choice->getParentID(), 
                    "data-lvl" => $choice->getLvl(), 
//                    "data-mailanbakarra" => "b".$choice->getMailanBakarra(),  
                ],
                'attr' => [ 'class' => 'arrazoia_tree'],
                'query_builder' => fn($em) => $em->arrazoiaLevelQB(1)
            ])
            ->add('arrazoiaBigarrenMaila', EntityType::class,  [
                'class' => Arrazoia::class,
                'label' => 'Arrazoia Bigarren Maila',
                'placeholder' => '',
                'required' => false,
                'query_builder' => fn($em) => $em->arrazoiaLevelQB(2),
            ])
            ->add('fromDate', DateType::class, [
                'constraints' => [
                ],
                'label' => 'fromDate',
                'widget' => 'single_text',
                'html5' => false,
                'required' => false,
            ])
            ->add('toDate', DateType::class, [
                'constraints' => [
                ],
                'label' => 'toDate',
                'widget' => 'single_text',
                'html5' => false,
                'required' => false,
            ])
            ->add('erabiltzailea', null ,[
                'label' => 'Erabiltzailea',
                'required' => false,
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
            // Configure your form options here
        ]);
    }
}

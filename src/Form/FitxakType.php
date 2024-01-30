<?php

namespace App\Form;

use App\Entity\Fitxak;
use App\Entity\Herria;
use App\Entity\Estatuak;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

use Symfony\Component\Security\Core\Security;


class FitxakType extends AbstractType
{
    public function __construct(private readonly \Symfony\Bundle\SecurityBundle\Security $security)
    {
    }
    
    public function buildForm( FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('egoera', null, ['label'=>'Egoera'])
             ->add('izena', null, ['label'=>'Izena'])
            ->add('abizena', null, ['label'=>'Abizena'])
            ->add('dokumentu_mota', null, ['label'=>'dok. mota']) 
            ->add('dokumentu_zenbakia', null, ['label'=>'Zenbakia', 'required' => false, 'empty_data' => ''])
            ->add('jaiotze_data', null, ['label'=>'001  Fecha nacimiento', 'html5'=>false, 'widget'=>"single_text", 'input_format'=>'yyyy-mm-dd'])
            //->add('herria', null, array('label'=>'002  Municipio Residencia' ))
            
            ->add('herria', EntityType::class, [
                'class' => Herria::class,
                'multiple' => false,
                'expanded' => false,
                'choice_label' => "herria",
                'query_builder' => fn(EntityRepository $er) => $er->createQueryBuilder('h')->orderBy('h.herria', 'ASC'),
                'label' => 'Herria', 
                'required' => true,
                'attr' => ['class'=>"select2_input"],
                //'by_reference' => false,

            ])
            
            ->add('genero', null, ['label' => '003  Sexo'])
            ->add('nazionalitatea', EntityType::class,  [
                'label' => '004	Nazionalitatea eta jaioterriko lekua',
                'class' => \App\Entity\Nazionalitatea::class,
                'multiple' => true,
                'expanded' => true,
                'choice_attr' => fn($choice, $key, $value) => ['class' => 'nazionalitatea-input maila'.$choice->getLvl(), "data-estatua"=>"b".$choice->getEstatua(), "data-tree"=>$choice->getRoot()->getId(), "data-parent"=>$choice->getParentID(), "data-lvl" => $choice->getLvl() ],
                'attr' => [ 'class' => 'nazionalitatea_tree'],
                'query_builder' => fn(EntityRepository $er) => $er->createQueryBuilder('n')->add('orderBy','n.root ASC,  n.lft + n.lvl  ASC, n.id ASC')
                
                ])
            //->add('estatua')
            
            ->add('estatua', EntityType::class, [
                'class' => Estatuak::class,
                'multiple' => false,
                'expanded' => false,
                'choice_label' => "estatua",
                'query_builder' => fn(EntityRepository $er) => $er->createQueryBuilder('h')->orderBy('h.estatua', 'ASC'),
                'label' => 'Estatua', 
                'required' => true,
                'attr' => ['class'=>"select2_input"],
                //'by_reference' => false,

            ])
            
            ->add('bizitokia', null, ['label'=>'005  Domicilio, Marco físico para la residencia y alojamiento Habitual'])
            ->add('bizikidetza', null, ['label'=>'006  Grupo de convivencia'])
            
            ->add('errolda', EntityType::class,  [
                'label' => '3.1 (6)	Errolda',
                'class' => \App\Entity\Errolda::class,
                'multiple' => true,
                'expanded' => true,
                'choice_attr' => fn($choice, $key, $value) => ['class' => 'errolda-input maila'.$choice->getLvl(), "data-erroldadata"=>"b".$choice->getErroldaData(), "data-tree"=>$choice->getRoot()->getId(), "data-parent"=>$choice->getParentID(), "data-lvl" => $choice->getLvl() ],
                'attr' => [ 'class' => 'errolda_tree'],
                'query_builder' => fn(EntityRepository $er) => $er->createQueryBuilder('n')->add('orderBy','n.root ASC,  n.lft + n.lvl  ASC, n.id ASC')
                
                ])
            ->add('errolda_data', null, ['label'=>'Errolda-data', 'html5'=>false, 'widget'=>"single_text", 'input_format'=>'yyyy-mm-dd'])
            ->add('arrazoia', null,  [
                'label' => 'Arretarako pertsona erabiltzaileak duen arrazoia: Jarduera-eremu orokorrak',
                'class' => \App\Entity\Arrazoia::class,
                'multiple' => true,
                'expanded' => true,
                'choice_attr' => fn($choice, $key, $value) => ['class' => 'arrazoia-input maila'.$choice->getLvl(), "data-bestearrazoia"=>"b".$choice->getBesteArrazoia(),  "data-bestebabeseza"=>"b".$choice->getBesteBabeseza(),  "data-bestebazterkeria"=>"b".$choice->getBesteBazterkeria(),  "data-tree"=>$choice->getRoot()->getId(), "data-parent"=>$choice->getParentID(), "data-lvl" => $choice->getLvl() ],
                'attr' => [ 'class' => 'arrazoia_tree'],
                'query_builder' => function(  EntityRepository $er) {
                    return $er->createQueryBuilder('n')->add('orderBy','n.root ASC,  n.lft + n.lvl  ASC, n.id ASC');
                    //return $er->treeListQ();
                }
                ])
            ->add('beste_arrazoia')
            ->add('beste_babeseza')
            ->add('beste_bazterkeria')
            ->add('balioespena', null,  [
                'label' => 'Balioespen Profesionala: Jarduera-eremu orokorrak',
                'class' => \App\Entity\Balioespena::class,
                'multiple' => true,
                'expanded' => true,
                'choice_attr' => fn($choice, $key, $value) => ['class' => 'balioespena-input maila'.$choice->getLvl(),  "data-bestebalioespena"=>"b".$choice->getBesteBalioespena(), "data-tree"=>$choice->getRoot()->getId(), "data-parent"=>$choice->getParentID(), "data-lvl" => $choice->getLvl(), "data-mailanbakarra" =>  "b".$choice->getMailanBakarra(),  ],
                'attr' => [ 'class' => 'balioespena_tree'],
                'query_builder' => fn(EntityRepository $er) => $er->createQueryBuilder('n')->add('orderBy','n.root ASC,  n.lft + n.lvl  ASC, n.id ASC')
                ])
            ->add('beste_balioespena')
            ->add('gaitasuna', null,  [
                'label'=>'9.A.1 (15)	Harremanak izateko eta komunikatzeko oinarrizko abileziak'
            ])
            ->add('eragilea', null,  [
                'label' => 'Eskaera nondik dator',
                'class' => \App\Entity\Eragilea::class,
                'multiple' => true,
                'expanded' => true,
                'choice_attr' => fn($choice, $key, $value) => ['class' => 'eragilea-input maila'.$choice->getLvl(), "data-besteeragile"=>"b".$choice->getBesteEragile(), "data-tree"=>$choice->getRoot()->getId(), "data-parent"=>$choice->getParentID(), "data-lvl" => $choice->getLvl(), "data-bestegaixotasun" =>  "b".$choice->getBesteGaixotasun(),  ],
                'attr' => [ 'class' => 'eragilea_tree'],
                'query_builder' => fn(EntityRepository $er) => $er->createQueryBuilder('n')->add('orderBy','n.root ASC,  n.lft + n.lvl  ASC, n.id ASC')
                ])
            ->add('beste_eragile')
            ->add('beste_gaixotasun')
            ->add('oharrak')
            ->add('erabiltzailea', HiddenType::class, [
                'data' => $user = $this->security->getUser(),
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Fitxak::class,
        ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'appbundle_fitxak';
    }

    
    
}

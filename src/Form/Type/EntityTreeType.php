<?php

namespace App\Form\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\View\ChoiceView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class EntityTreeType
 *
 * 
 */
class EntityTreeType extends AbstractType
{

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'parent_method_name' => 'getParent',
            'children_method_name' => 'getChildren',
            'prefix' => '>',
        ]);
    }

    /**
     * @param FormView      $view
     * @param FormInterface $form
     * @param array         $options
     */
    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        $choices = [];

        $parent_method_name = $options['parent_method_name'];
        foreach ($view->vars['choices'] as $choice) {
            if ($choice->data->$parent_method_name() === null)
                $choices[$choice->value] = $choice->data;
        }

        $choices = $this->buildTreeChoices($choices, $options);

        $view->vars['choices'] = [];

    }

    /**
     * @param object[] $choices
     * @param int      $level
     * @return array
     */
    protected function buildTreeChoices($choices, array $options, $level = 0): array
    {

        $result = [];
        $children_method_name = $options['children_method_name'];

        /*foreach ($choices as $choice) {
        
            $result[$choice->getId()] = new ChoiceView(
                $choice,
                (string)$choice->getId(),
                str_repeat($options['prefix'], $level) . ' ' . $choice->getName(),
                []
            );

            if ($choice->$children_method_name() && !$choice->$children_method_name()->isEmpty())
                $result = array_merge(
                    $result,
                    $this->buildTreeChoices($choice->$children_method_name(), $options, $level + 1)
                );

        }*/
        
        foreach ($choices as $choice) {
            $result = array_merge(
            $result,
            [new ChoiceView(
                    $choice,
                    (string)$choice->getId(),
                    str_repeat((string) $options['prefix'], $level) . ' ' . $choice->getName(),
                    []
                )]
            );
            if (!$choice->$children_method_name()->isEmpty())
                $result = array_merge(
                    $result,
                    $this->buildTreeChoices($choice->$children_method_name(), $options, $level + 1)
                );
        }

        return $result;

    }

    /**
     * @return string|null
     */
    public function getParent(): ?string
    {
        return EntityType::class;
    }
}

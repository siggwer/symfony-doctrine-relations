<?php

namespace App\Form;

use App\Entity\Foo;
use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class FooType
 * @package App\Form
 */
class FooType extends AbstractType
{
    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('tags', EntityType::class, [
                'multiple' => true,
                'expanded' => true,
                'class' => Tag::class,
                'choice_label' => 'name',
            ])
            ->add("bars", CollectionType::class, [
                'label' => false,
                'entry_type' => BarType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false
            ])
        ;
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Foo::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Productadd;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
// ProductType is the name of the abstract representation of the form
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // We can see the different fields of the future form
        $builder
            ->add('name')
            ->add('episode')
            ->add('episode_id')
            ->add('description')
            ->add('manufacturer')
            ->add('price')
            ->add('category')
            ->add('picture', FileType::class, [
                'mapped' => false,
                'required' => false,

            ])
            ->add('creation', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Productadd::class,
        ]);
    }
}

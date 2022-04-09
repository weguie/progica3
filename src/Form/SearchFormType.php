<?php

namespace App\Form;

use App\Entity\Cities;
use App\Entity\PropertySearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;

class SearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
           

            ->add('city', SearchType::class, [
                    'label' => 'Ville',
                    'required'   => false,
                    'attr' => ['class' => Cities::class],
                    ])
        //  ->add('title', TextType::class, [
        //        'label' => 'Titre',
        //        'required'   => false,
        //       ])

        //  ->add( 'city', EntityType::class, [
        //                 'label' => 'Ville',
        //                 'class' => Cities::class,
        //                 'choice_label' => 'name',
        //                 'multiple' => false,
        //                 'query_builder' => function (EntityRepository $er) {
        //                     return $er->createQueryBuilder('c')
        //                         ->orderBy('c.name', 'ASC');
        //                 },
        //             ] )
            ->add('submit', SubmitType::class, [
                    'attr' => [
                    'class' => 'btn btn-dark'
                ],
                'label' => 'Rechercher',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PropertySearch::class,
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}

<?php

namespace App\Form;

use App\Entity\SearchProduit;
use App\Entity\Option;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchproduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('options',EntityType::class,
                [

                    'required'=>false,
                    'label'=>false,
                    'class'=>Option::class,
                    'choice_label'=>'name',
                    'multiple'=>true
                ]
                );
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchProduit::class,
            'method'=> 'get',
            'crsf_protection' =>false

        ]);
    }
}

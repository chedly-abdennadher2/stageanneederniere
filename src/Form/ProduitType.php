<?php

namespace App\Form;

use App\Entity\Produit;
use App\Entity\Option;
Use App\Entity\Tag;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type')

            ->add('tags',EntityType::class,
                [
                    'class'=>Tag::class,
                    'choice_label'=>'name',
                    'multiple'=>true
                ]
            )
           ->add('imageFile',Filetype::class,
           [
               'required'=>false,
           ]

           )

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Contact;
use Graficart\RecaptchaBundle\Type\RecaptchaSubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactformType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName',TextType::class)
            ->add('lastName',TextType::class)
            ->add('phone',TextType::class)
            ->add('email',EmailType::class)
            ->add('message',TextareaType::class)
            ->add('recaptcha',RecaptchaSubmitType::class,[
                "label"=> 'envoyer',
            ])

            ->add ("envoyer",SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
                'attr' => [
                    'novalidate' => 'novalidate', // comment me to reactivate the html5 validation!  :feu_de_signalisation_horizontal:
                ]
                ]
        );
    }
}

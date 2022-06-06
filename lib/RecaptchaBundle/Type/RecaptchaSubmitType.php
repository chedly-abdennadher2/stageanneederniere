<?php


namespace Graficart\RecaptchaBundle\Type;


use Graficart\RecaptchaBundle\Constraints\Recaptcha;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecaptchaSubmitType extends AbstractType
{
    /*
     * @var string
     */
     private $key;
public function __construct(string $key)
{
$this->key=$key;
}



    public function configureOptions(OptionsResolver $resolver)
{
$resolver->setDefaults(
   [ 'mapped'=>false,
       'constraints'=>new Recaptcha()
   ]
);
}
public function getBlockPrefix()
{
    return 'recaptcha';
}
public function getParent()
{
return TextType::class;
}
public function buildView(FormView $view, FormInterface $form, array $options)
{
$view->vars['label']=false;
$view->vars['button']=$options['label'];
$view->vars['key']=$this->key;
}
}
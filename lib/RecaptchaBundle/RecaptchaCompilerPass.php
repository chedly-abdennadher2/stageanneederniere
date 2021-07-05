<?php


namespace Graficart\RecaptchaBundle;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class RecaptchaCompilerPass implements  CompilerPassInterface
{
public  function process(ContainerBuilder $container)
{
if ($container->hasParameter('twig.form.resources'))
{
    $ressources=$container->getParameter('twig.form.resources');
    array_unshift($ressources,'@Recaptcha/fields.html.twig');
    $container->setParameter('twig.form.resources',$ressources);
}

}
}
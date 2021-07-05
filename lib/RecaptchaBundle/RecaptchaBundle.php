<?php


namespace Graficart\RecaptchaBundle;


use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Graficart\RecaptchaBundle\RecaptchaCompilerPass;

class RecaptchaBundle extends Bundle
{
public function build(ContainerBuilder $container)
{
    parent::build($container);
    $container->addCompilerPass(new RecaptchaCompilerPass());
}
}
<?php


namespace Graficart\RecaptchaBundle\DependencyInjection;


use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class RecaptchaExtension extends Extension
{

    /**
     * Loads a specific configuration.
     *
     * @throws \InvalidArgumentException When provided tag is not defined in this extension
     */
    public function load(array $configs, ContainerBuilder $container)
    {
     $configuration=new Configuration();
      $config=$this->processConfiguration($configuration,$configs);
      dump ($config);
      die();
    }
}
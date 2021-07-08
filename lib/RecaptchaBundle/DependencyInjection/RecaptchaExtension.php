<?php


namespace Graficart\RecaptchaBundle\DependencyInjection;


use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class RecaptchaExtension extends Extension
{

    /**
     * Loads a specific configuration.
     *
     * @throws \InvalidArgumentException When provided tag is not defined in this extension
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container,
            new FileLocator(__DIR__.'/../Resources/config'));

        $loader->load('services.yaml');
     $configuration=new Configuration();
     $config=$this->processConfiguration($configuration,$configs);
     $container->setParameter('recaptcha.key',$config['key']);
     $container->setParameter('recaptcha.secret',$config['secret']);

    }
}
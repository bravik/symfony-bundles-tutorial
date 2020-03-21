<?php
namespace bravik\CalendarBundle\DependencyInjection;

use bravik\CalendarBundle\Controller\EditorController;
use bravik\CalendarBundle\Service\EventExporter\ExporterInterface;
use Exception;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class CalendarExtension extends Extension
{
    /**
     * Loads a specific configuration.
     *
     * @param array $configs
     * @param ContainerBuilder $container
     * @throws Exception
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $container->registerForAutoconfiguration(ExporterInterface::class)
            ->addTag('bravik.calendar.exporter');

        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../../config')
        );
        $loader->load('services.yaml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

//        $container->setParameter('bravik.calendar.enable_soft_delete', $config['enable_soft_delete']);


        $definition = $container->getDefinition(EditorController::class);
        $definition->setArguments([
          '$enableSoftDelete' => $config['enable_soft_delete'],
        ]);
    }
}

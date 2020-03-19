<?php
namespace bravik\CalendarBundle\DependencyInjection\Compiler;

use bravik\CalendarBundle\Service\EventExporter\ExporterManager;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ExporterRegistrationPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        // Always check first if the primary service is defined
        if (!$container->has(ExporterManager::class)) {
            return;
        }

        $exporterManagerDefinition = $container->findDefinition(ExporterManager::class);

        $taggedServices = $container->findTaggedServiceIds('bravik.calendar.exporter');

        $exporterReferences = [];
        foreach ($taggedServices as $id => $tags) {
            $exporterReferences[] = new Reference($id);
        }

        $exporterManagerDefinition->setArguments(['$exporters' => $exporterReferences]);
    }
}
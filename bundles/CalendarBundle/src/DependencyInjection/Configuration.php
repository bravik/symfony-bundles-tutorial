<?php
namespace bravik\CalendarBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * @return TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('calendar');

        $treeBuilder->getRootNode()
            ->children()
                ->booleanNode('enable_soft_delete')
                    ->defaultFalse()
                    ->info('Enables soft delete mode for articles. Articles would be marked as `archived` instead of deletion')
                    ->validate()
                        ->ifTrue(function ($v) { return $v <= 0; })
                        ->thenInvalid('Number must be positive')
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}

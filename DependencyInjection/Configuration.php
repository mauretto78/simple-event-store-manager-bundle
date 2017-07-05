<?php

namespace SimpleEventStoreManager\Bundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('event_store_manager');
        $rootNode
            ->children()
            ->enumNode('driver')
            ->values([
                'in-memory',
                'mongo',
                'pdo',
                'redis',
            ])
            ->defaultValue('mongo')
            ->isRequired()
            ->end()
            ->end()
            ->children()
            ->arrayNode('parameters')
            ->isRequired()
            ->prototype('variable')
            ->end()
            ->end()
        ;
        return $treeBuilder;
    }
}

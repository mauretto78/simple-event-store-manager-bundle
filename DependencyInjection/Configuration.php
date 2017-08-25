<?php
/**
 * This file is part of the Simple EventStore EventStoreManager package.
 *
 * (c) Mauro Cassani<https://github.com/mauretto78>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
        $rootNode = $treeBuilder->root('simple_event_store_manager');
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
                ->enumNode('api_format')
                    ->values([
                        'json',
                        'xml',
                        'yaml',
                    ])
                    ->defaultValue('json')
                ->end()
                ->enumNode('return_type')
                ->values([
                    'array',
                    'object'
                ])
                ->defaultValue('array')
                ->end()
                ->arrayNode('parameters')
                    ->isRequired()
                    ->prototype('variable')
                    ->end()
                ->end()
                ->arrayNode('elastic')
                    ->prototype('variable')
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}

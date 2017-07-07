<?php
/**
 * This file is part of the Simple EventStore Manager package.
 *
 * (c) Mauro Cassani<https://github.com/mauretto78>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SimpleEventStoreManager\Bundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class SimpleEventStoreManagerExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        // Load services.yml file
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        // set Configuration
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        // set Symfony parameter called 'simple_event_store_manager'
        $container->setParameter('simple_event_store_manager', $config);
    }
}

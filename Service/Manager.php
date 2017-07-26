<?php
/**
 * This file is part of the Simple EventStore Manager package.
 *
 * (c) Mauro Cassani<https://github.com/mauretto78>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SimpleEventStoreManager\Bundle\Service;

use SimpleEventStoreManager\Application\EventManager;

class Manager
{
    /**
     * @var EventManager
     */
    private $manager;

    /**
     * Manager constructor.
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->setMananger($config);
    }

    /**
     * @param $config
     */
    private function setMananger($config)
    {
        $this->manager = new EventManager(
            $config['driver'],
            $config['parameters'],
            ($config['elastic']) ? ['elastic' => true, 'elastic_hosts' => $config['elastic']] : null
        );
    }

    /**
     * @return EventManager
     */
    public function getMananger()
    {
        return $this->manager;
    }
}

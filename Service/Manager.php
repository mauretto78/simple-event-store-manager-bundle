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

use SimpleEventStoreManager\Application\EventsManager;

class Manager
{
    /**
     * @var EventsManager
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
        $this->manager = new EventsManager($config['driver'], $config['parameters']);
    }
    /**
     * @return EventsManager
     */
    public function getMananger()
    {
        return $this->manager;
    }
}

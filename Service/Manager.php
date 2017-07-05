<?php

namespace SimpleEventStoreManager\Bundle\Service;

use SimpleEventStoreManager\Application\StreamManager;

class Manager
{
    /**
     * @var StreamManager
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
        $this->manager = new StreamManager($config['driver'], $config['parameters']);
    }
    /**
     * @return StreamManager
     */
    public function getMananger()
    {
        return $this->manager;
    }
}

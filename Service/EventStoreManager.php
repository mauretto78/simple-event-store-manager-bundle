<?php
/**
 * This file is part of the Simple EventStore EventStoreManager package.
 *
 * (c) Mauro Cassani<https://github.com/mauretto78>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SimpleEventStoreManager\Bundle\Service;

use SimpleEventStoreManager\Application\Event\EventManager as EM;
use SimpleEventStoreManager\Application\Event\EventQuery as EQ;
use SimpleEventStoreManager\Application\Event\EventQuery;
use SimpleEventStoreManager\Domain\Model\Contracts\EventAggregateRepositoryInterface;

class EventStoreManager
{
    /**
     * @var EM
     */
    private $eventManager;

    /**
     * @var EQ
     */
    private $eventQuery;

    /**
     * EventStoreManager constructor.
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->setEventMananger($config);
        $this->setEventQuery($this->eventManager);
    }

    /**
     * @param $config
     */
    private function setEventMananger($config)
    {
        $returnType = ($config['return_type'] === 'array') ? EventAggregateRepositoryInterface::RETURN_AS_ARRAY : EventAggregateRepositoryInterface::RETURN_AS_OBJECT;
        $this->eventManager = EM::build()
            ->setDriver($config['driver'])
            ->setConnection($config['parameters'])
            ->setReturnType($returnType);

        if($config['elastic']){
            $this->eventManager->setElasticServer($config['elastic']);
        }
    }

    /**
     * @return EM
     */
    public function getEventMananger()
    {
        return $this->eventManager;
    }

    /**
     * @param EM $eventManager
     */
    private function setEventQuery(EM $eventManager)
    {
        $this->eventQuery = new EventQuery($eventManager);
    }

    /**
     * @return EQ
     */
    public function getEventQuery()
    {
        return $this->eventQuery;
    }
}

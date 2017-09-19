<?php
/**
 * This file is part of the Simple EventStore EventStoreManager package.
 *
 * (c) Mauro Cassani<https://github.com/mauretto78>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SimpleEventStoreManager\Bundle\Controller;

use JMS\Serializer\SerializerBuilder;
use SimpleEventStoreManager\Application\Event\EventRepresentation;
use SimpleEventStoreManager\Application\EventQuery;
use SimpleEventStoreManager\Bundle\Service\EventStoreManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EventStoreManagerBundleController extends Controller
{
    /**
     * @Route("/{aggregate}/{page}",
     *     requirements={"page" = "\d+"},
     *     defaults={"page" = null}) ,
     *     name="event_store_manager_index")
     */
    public function aggregateAction(Request $request, $aggregate, $page = null)
    {
        /** @var EventStoreManager $eventStoreManager */
        $eventStoreManager = $this->container->get('simple_event_store_manager');
        $eventManager = $eventStoreManager->getEventMananger();

        $config = $this->container->getParameter('simple_event_store_manager');
        $dataTransformer = 'SimpleEventStoreManager\\Infrastructure\\DataTransformers\\'.ucfirst($config['api_format']).'EventDataTransformer';
        $eventRepresentation = new EventRepresentation(
            $eventManager,
            new $dataTransformer(
                SerializerBuilder::create()->build(),
                $request,
                true
            )
        );

        return $eventRepresentation->aggregate($aggregate, ($page) ?: 1);
    }
}

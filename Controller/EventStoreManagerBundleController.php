<?php
/**
 * This file is part of the Simple EventStore Manager package.
 *
 * (c) Mauro Cassani<https://github.com/mauretto78>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SimpleEventStoreManager\Bundle\Controller;

use JMS\Serializer\SerializerBuilder;
use SimpleEventStoreManager\Application\EventQuery;
use SimpleEventStoreManager\Bundle\Service\Manager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EventStoreManagerBundleController extends Controller
{
    /**
     * @Route("/{page}", requirements={"page" = "\d+"}, defaults={"page" = null}) , name="event_store_manager_index")
     */
    public function indexAction(Request $request, $page = null)
    {
        /** @var Manager $manager */
        $manager = $this->container->get('simple_event_store_manager');
        $eventStore = $manager->getMananger()->eventStore();

        $config = $this->container->getParameter('simple_event_store_manager');
        $dataTransformer = 'SimpleEventStoreManager\\Infrastructure\\DataTransformers\\'.ucfirst($config['api_format']).'EventDataTransformer';
        $eventsQuery = new EventQuery(
            $eventStore,
            new $dataTransformer(
                SerializerBuilder::create()->build(),
                $request,
                true
            )
        );

        return $eventsQuery->paginate(($page) ?: 1);
    }
}

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
use SimpleEventStoreManager\Application\EventsQuery;
use SimpleEventStoreManager\Bundle\Service\Manager;
use SimpleEventStoreManager\Infrastructure\DataTransformer\JsonEventDataTransformer;
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
        $currentPage = ($page) ?: 1;

        /** @var Manager $manager */
        $manager = $this->container->get('simple_event_store_manager');
        $eventStore = $manager->getMananger()->eventStore();
        $eventsQuery = new EventsQuery(
            $eventStore,
            new JsonEventDataTransformer(
                SerializerBuilder::create()->build(),
                $request,
                true
            )
        );

        return $eventsQuery->query($currentPage);
    }
}

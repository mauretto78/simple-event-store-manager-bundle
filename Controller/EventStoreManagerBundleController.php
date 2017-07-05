<?php

namespace SimpleEventStoreManager\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class EventStoreManagerBundleController extends Controller
{
    /**
     * @Route("/index", name="event_store_manager_index")
     */
    public function indexAction()
    {
        return [];
    }
}

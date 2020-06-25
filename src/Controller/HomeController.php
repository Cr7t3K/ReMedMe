<?php


namespace App\Controller;


use App\Services\SendPushNotificationsManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param SendPushNotificationsManager $pushNotificationsManager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(SendPushNotificationsManager $pushNotificationsManager)
    {
//        $request = Request::createFromGlobals();
//        $request->request->get();
        $pushNotificationsManager->sendPush();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}

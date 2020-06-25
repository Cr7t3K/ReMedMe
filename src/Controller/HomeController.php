<?php


namespace App\Controller;


use App\Repository\RelativeRepository;
use App\Services\SendPushNotificationsManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param SendPushNotificationsManager $sendPushNotificationsManager
     * @param RelativeRepository $relativeRepository
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \ErrorException
     */
    public function index(SendPushNotificationsManager $sendPushNotificationsManager, RelativeRepository $relativeRepository)
    {
        $sendPushNotificationsManager->sendPush($relativeRepository);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}

<?php


namespace App\Controller;

use App\Entity\User;
use App\Services\SendPushNotificationsManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PushSubscriptionController
 * @package App\Controller
 * @Route("/push")
 */
class PushSubscriptionController extends AbstractController
{
    /**
     * @Route("/{id}", methods={"POST"}, name="push_subscribe")
     * @param Request $request
     * @param User $user
     * @return void
     */
    public function pushNotifPost(Request $request, User $user)
    {
        // create a new subscription entry in your database (endpoint is unique)
        $endpoint = $request->request->get('endpoint');
        $pKey = $request->request->get('pKey');
        $authKey = $request->request->get('authKey');
        $user->setEndpoint($endpoint);
        $user->setPKey($pKey);
        $user->setAuthKey($authKey);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        //return $this->redirectToRoute('home');
    }

    /**
     * @Route("/{id}", methods={"PUT"}, name="push_update")
     */
    public function pushNotifPut()
    {
        // update the key and token of subscription corresponding to the endpoint
    }

    /**
     * @Route("/{id}", methods={"DELETE"}, name="push_delete")
     */
    public function pushNotifDelete()
    {
        // delete the subscription corresponding to the endpoint
    }
}

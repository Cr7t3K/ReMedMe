<?php


namespace App\Controller;

use App\Entity\User;
use App\Services\SendPushNotificationsManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PushSubscriptionController
 * @package App\Controller
 * @Route("/push")
 */
class PushSubscriptionController extends AbstractController
{
    /**
     * @Route("/", methods={"POST"}, name="push_subscribe")
     * @param Request $request
     * @return Response
     */
    public function pushNotifPost(Request $request)
    {
        $user = $this->getUser();
        if (!$user)
            return new Response("ko");
        // create a new subscription entry in your database (endpoint is unique)
        $endpoint = $request->request->get('endpoint');
        $pKey = $request->request->get('publicKey');
        $authKey = $request->request->get('authToken');
        $user->setEndpoint($endpoint);
        $user->setPKey($pKey);
        $user->setAuthKey($authKey);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return new Response("ok");
    }

    /**
     * @Route("/", methods={"PUT"}, name="push_update")
     */
    public function pushNotifPut(Request $request)
    {
        $user = $this->getUser();
        if (!$user)
            return new Response("ko");

        // create a new subscription entry in your database (endpoint is unique)
        $endpoint = $request->request->get('endpoint');
        $pKey = $request->request->get('publicKey');
        $authKey = $request->request->get('authToken');
        $user->setEndpoint($endpoint);
        $user->setPKey($pKey);
        $user->setAuthKey($authKey);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        // update the key and token of subscription corresponding to the endpoint
        return new Response("ok");

    }

    /**
     * @Route("/", methods={"DELETE"}, name="push_delete")
     */
    public function pushNotifDelete()
    {
        // delete the subscription corresponding to the endpoint
        return new Response("ok");

    }
}

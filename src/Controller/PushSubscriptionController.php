<?php


namespace App\Controller;

use App\Services\SendPushNotificationsManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PushSubscriptionController
 * @package App\Controller
 * @Route("/push")
 */
class PushSubscriptionController
{
    /**
     * @Route("/{id}", methods={"POST"}, name="push_subscribe")
     */
    public function pushNotifPost()
    {
        // create a new subscription entry in your database (endpoint is unique)
        $request = Request::createFromGlobals();
        var_dump($request);
        die();
        //var_dump($request->get("endpoint"));
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

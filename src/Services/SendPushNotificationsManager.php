<?php


namespace App\Services;

use ErrorException;
use Minishlink\WebPush\MessageSentReport;
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;
use App\Repository\UserRepository;

class SendPushNotificationsManager
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws ErrorException
     */
    public function sendPush()
    {
        // here I'll get the subscription endpoint in the POST parameters
// but in reality, you'll get this information in your database
// because you already stored it (cf. push_subscription.php)

        // Test for sending several users in the same time

        $users = $this->userRepository->findAll();
//        $user = $userRepository->findOneBy(['id' => 2]);
        foreach ($users as $user)
        {
            $endpoint = $user->getEndpoint();
            $authKey = $user->getAuthKey();
            $pKey = $user->getPKey();
            $subArray = [
                    'endpoint' => $endpoint,
                    'expirationTime' => null,
                    'keys' => [
                        'p256dh' => $pKey,
                        'auth' => $authKey,
                ],
                'contentEncoding' => 'aesgcm',
                ];
            $subscription = Subscription::create($subArray);

            $auth = array(
                'VAPID' => array(
                    'subject' => 'https://github.com/Minishlink/web-push-php-example/',
                    'publicKey' => file_get_contents(__DIR__ . '/../../assets/keys/public_key.txt'), // don't forget that your public key also lives in app.js
                    'privateKey' => file_get_contents(__DIR__ . '/../../assets/keys/private_key.txt'), // in the real world, this would be in a secret file
                ),
            );

            $webPush = new WebPush($auth);

            $res = $webPush->sendNotification(
                $subscription,
                //"Georges doit prendre : 2 DOLIPRANE 500 mg"
                json_encode(['message' => 'btvfe', 'title' => 'le titre', 'img' => 'https://i328.photobucket.com/albums/l341/JE_N_DA/pencil_zpsmcipkt1e.png'])
            );

    // handle eventual errors here, and remove the subscription from your server if it is expired
            foreach ($webPush->flush() as $report) {
                $endpoint = $report->getRequest()->getUri()->__toString();

    //            if ($report->isSuccess()) {
    //                echo "[v] Message sent successfully for subscription {$endpoint}.";
    //            } else {
    //                echo "[x] Message failed to sent for subscription {$endpoint}: {$report->getReason()}";
    //            }
            }
        }
    }
}

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
     * @param UserRepository $userRepository
     * @throws ErrorException
     */
    public function sendPush(UserRepository $userRepository)
    {
        // here I'll get the subscription endpoint in the POST parameters
// but in reality, you'll get this information in your database
// because you already stored it (cf. push_subscription.php)
        $user = $userRepository->findOneBy([]);
        $endpoint = $user->getEndpoint();
        $authKey = $user->getAuthKey();
        $pKey = $user->getPKey();
        $subArray = [
//            'endpoint' => 'https://updates.push.services.mozilla.com/wpush/v2/gAAAAABe9FAuHj_8nVsfdmxZUXujtyNSlmE5M7YJhufisfEddeBUhjnm4JiEiYGyLJJciLWto_WspEpG5_KjEM1Z4nIZXlhaIGYg4RYqhgIAAc0pYh-MrotUA8N6Gc4-4BfZdrGQMFfwyN51lTVlxEw_oVWh9tvVwiL5PCeiE0UakTrD5vcGoXE',
//            'expirationTime' => null,
//            'keys' => [
//                'p256dh' => 'BFVCHdqIZr1sXtIyEHHmVvD6u3JSWxPdT5dC6cXjTZsYNODCtfPpe7T0ASgAS7tf4N_5wM4_sGTa14fHZljZZqs',
//                'auth' => '4_KwipnpLY1Sh9vFFN7HTA',
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
            "Papi! Mamie a besoin de toi, prends ton medoc! La pillule bleue   ;)"
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

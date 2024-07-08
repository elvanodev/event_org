<?php

include "client-php-master/autoload.php";

class Sms {

    function sendsms($deviceid, $phone, $message, $API) {
        $clients = new SMSGatewayMe\Client\ClientProvider($API);

        $sendMessageRequest = new SMSGatewayMe\Client\Model\SendMessageRequest([
            'phoneNumber' => $phone, 'message' => $message, 'deviceId' => $deviceid
        ]);

        $sentMessages = $clients->getMessageClient()->sendMessages([$sendMessageRequest]);
        // print_r($sentMessages);
    }

}

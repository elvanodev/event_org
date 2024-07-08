<?php

require ('client-php-master/autoload.php');

use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Api\MessageApi;
use SMSGatewayMe\Client\Model\SendMessageRequest;

class Sms {

    static protected $API = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTUzOTM4MDE1MSwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjYyNTk2LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.8iIr6_plB2m0gPHoMHqnpy5khr5ZzWUAgPQDfF7IdeQ';

    public function index() {
        // Configure client
        $config = Configuration::getDefaultConfiguration();
        $config->setApiKey('Authorization', self::$API);
        $apiClient = new ApiClient($config);

// Create callback client
        $callbackClient = new CallbackApi($apiClient);

        /**
         * Create Callback Request
         * For valid events, filter types and methods please view the swagger definition
         */
        $createCallbackRequest = new CreateCallbackRequest([
            'name' => 'Test Callback',
            'event' => 'MESSAGE_RECEIVED',
            'deviceId' => 103501,
            'filterType' => 'contains',
            'filter' => 'hello',
            'method' => 'HTTP',
            'action' => 'http://mywebsite.com/sms-callback.php',
            'secret' => 'SsshhhhNotASecret'
        ]);

        $callback = $callbackClient->createCallback($createCallbackRequest);
        print_r($callback);
    }

    public function sendsms($deviceid, $phone, $message) {


// Configure client
        $config = Configuration::getDefaultConfiguration();
        $config->setApiKey('Authorization', self::$API);
        $apiClient = new ApiClient($config);
        $messageClient = new MessageApi($apiClient);

// Sending a SMS Message
        $sendMessageRequest1 = new SendMessageRequest([
            'phoneNumber' => $phone,
            'message' => $message,
            'deviceId' => $deviceid
        ]);

        $sendMessages = $messageClient->sendMessages($sendMessageRequest1);
        print_r($sendMessages);
    }

}

?>
<?php

namespace App\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Firebase
{
    protected $client;
    protected $token = 'token';

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param $notification
     * @param $tokens
     * @return \Exception|ClientException|\Psr\Http\Message\StreamInterface
     */
    public function send_notification($notification, $tokens)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = [
            // "priority"=>"high",
            "registration_ids" => $tokens,
            'notification' => $notification,
            'data' => $notification,

            //'content-available' => true,
            'priority' => 'high'
        ];

        $headers = [
            "Authorization" => "key={$this->token}",
            'Content-Type'  => 'application/json',
        ];

        try {
            $request = $this->client->post($url, [
                'headers' => $headers,
                'json' => $fields,
            ]);

            $response = $request->getBody();
            return $response;
        } catch (ClientException $exception) {
            return $exception;
        }
    }
}

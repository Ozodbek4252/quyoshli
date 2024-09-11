<?php

namespace App\Api;

use GuzzleHttp\Client;

class Sms
{
    const URL = '';
    const ORIGINATOR = '';

    /**
     * @var Client
     */
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function send(int $phone, string $message)
    {
        $data = [
            'messages' => [
                [
                    'recipient' => $phone,
                    'message-id' => time(),
                    'sms' => [
                        'originator' => '3700',
                        'content' => [
                            'text' => $message
                        ]
                    ]
                ]
            ]
        ];

        $data_string = json_encode($data);

        $username = env("PLAYMOBILE_LOGIN");
        $password = env("PLAYMOBILE_PASSWORD");

        $ch = curl_init('http://91.204.239.44/broker-api/send ');
        curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string)
            )
        );

        $result = curl_exec($ch);

        return true;
    }
}

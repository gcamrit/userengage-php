<?php

namespace Gc\UserEngage;

use Gc\UserEngage\Http\Company;
use Gc\UserEngage\Http\User;
use GuzzleHttp\Client;

class UserEngage
{
    /**
     * @var Client
     */
    private $client;
    /**
     * @var string
     */
    private $apiUrl = 'https://app.userengage.com/api/public/';

    public function __construct($applicationKey)
    {
        $this->client = new Client([
            'headers' => [
                'Authorization' => 'Token ' . $applicationKey,
                'Content-type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'base_uri' => $this->apiUrl,
        ]);
    }

    public function user()
    {
        return new User($this->client);
    }

    public function company()
    {
        return new Company($this->client);
    }
}

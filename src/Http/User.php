<?php

namespace Gc\UserEngage\Http;

use GuzzleHttp\Client;
use Gc\UserEngage\Request\CreateUser;
use Psr\Http\Message\ResponseInterface;
use function GuzzleHttp\Psr7\stream_for;

/**
 * Class User
 * @package Gc\UserEngage\Http
 */
final class User
{
    /**
     * @var Client
     */
    private $client;

    /**
     * User constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param CreateUser $createUser
     * @return string
     */
    public function create(CreateUser $createUser)
    {
        $response = $this->client->post('users/', [
            'json' => $createUser->getData()
        ]);

        return json_encode($response->getBody(), true);
    }

    /**
     * Find user by email.
     *
     * @param string $email
     * @return string
     */
    public function findByEmail($email)
    {
        $response = $this->client->get('users/search/?email=' . $email);

        return $this->handleResponse($response);
    }

    /**
     * Find user by key.
     *
     * @param string $key
     * @return string
     */
    public function findByKey($key)
    {
        $response = $this->client->get('users/search/?key=' . $key);

        return $this->handleResponse($response);
    }

    /**
     * Get single user details.
     *
     * @param string $key
     * @return string
     */
    public function findById($key)
    {
        $response = $this->client->get('users/' . $key . '/');

        return $this->handleResponse($response);
    }

    /**
     * Simple HTTP DELETE request to Users API to delete user.
     *
     * @param $id
     * @return string
     */
    public function delete($id)
    {
        $response = $this->client->delete('users/' . $id . '/');

        return json_encode($response->getBody(), true);
    }

    /**
     * Handle UserEngage Success Response.
     *
     * @param ResponseInterface $response
     * @return mixed
     */
    private function handleResponse(ResponseInterface $response)
    {
        $stream = stream_for($response->getBody());
        $data = json_decode($stream, true);

        return $data;
    }
}

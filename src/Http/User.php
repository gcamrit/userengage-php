<?php

namespace Gc\UserEngage\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Uri;
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
     * @param array $userDetail
     * @return string
     */
    public function create(array $userDetail)
    {
        $response = $this->client->post('users/', [
            'json' => $userDetail
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

    /**
     * Find user by email.
     *
     * @param string $phoneNumber
     * @return string
     */
    public function findByPhoneNumber($phoneNumber)
    {
        $response = $this->client->get('users/search/?phone_number=' . $phoneNumber);

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
     * Find user by key.
     *
     * @param string $lookup
     * @param $attribute
     * @return string
     */
    public function findByCustomAttribute($lookup = '__gte', $attribute)
    {
        $response = $this->client->get('users/search/?custom_attr. '$lookup . '=' . $attribute);

        return $this->handleResponse($response);
    }

    public function addTag($userId, $tagLabel)
    {
        $uri = sprintf('users/%s/add_tag/', $userId);
        $response = $this->client->post(new Uri($uri), [
            'json' => ['name' => $tagLabel]
        ]);

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
        $response = $this->client->get(sprintf('users/%s/', $key));

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
        $response = $this->client->delete(sprintf('users/%s/', $id));

        return json_encode($response->getBody(), true);
    }
}

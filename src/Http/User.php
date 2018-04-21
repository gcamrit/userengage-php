<?php

namespace Gc\UserEngage\Http;

use Gc\UserEngage\AbstractResource;

/**
 * Class User
 * @package Gc\UserEngage\Http
 */
final class User extends AbstractResource
{use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\ResponseInterface;
use function GuzzleHttp\Psr7\stream_for;


    /**
     * @param array $userDetail
     * @return array
     */
    public function add(array $userDetail)
    {
        return $this->create('users/', $userDetail);
    }

    /**
     * Find user by email.
     *
     * @param string $email
     * @return string
     */
    public function findByEmail($email)
    {
        return $this->find(sprintf('users/search/?email=$s', $email));
    }

    /**
     * Find user by email.
     *
     * @param string $phoneNumber
     * @return string
     */
    public function findByPhoneNumber($phoneNumber)
    {
        return $this->find(sprintf('users/search/?phone_number=%s', $phoneNumber));
    }

    /**
     * Find user by key.
     *
     * @param string $key
     * @return string
     */
    public function findByKey($key)
    {
        return $this->find('users/search/?key=' . $key);
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
        return $this->find(sprintf('users/search/?custom_attr%s=%s', $lookup, $attribute);
    }

    public function addTag($userId, $tagLabel)
    {
        $uri = sprintf('users/%s/add_tag/', $userId);

        return $this->create($uri, ['name' => $tagLabel]);
    }

    /**
     * Get single user details.
     *
     * @param string $key
     * @return string
     */
    public function findById($key)
    {
        return $this->find(sprintf('users/%s/', $key));
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

        return $this->handleResponse($response);
    }
}

<?php

namespace Gc\UserEngage\Http;

use Gc\UserEngage\AbstractResource;

/**
 * Class User
 * @package Gc\UserEngage\Http
 */
final class User extends AbstractResource
{

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
        return $this->find(sprintf('users/search/?email=%s', $email));
    }

    /**
     * Find user by email.
     *
     * @param string $userId
     * @return string
     */
    public function findByUserId($userId)
    {
        return $this->find(sprintf('users-by-id/search/?user_id=%s', $userId));
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
        return $this->find(sprintf('users/search/?custom_attr%s=%s', $lookup, $attribute));
    }

    public function addTag($userId, $tagLabel)
    {
        $uri = sprintf('users/%s/add_tag/', $userId);
        $tags = ['name' => $tagLabel];

        return $this->create($uri, $tags);
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

    public function update($modelId, array $details)
    {
        $response = $this->client->put(sprintf('users/%s/', $modelId), [
            'json' => $details,
        ]);

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
        return parent::delete(sprintf('users/%s/', $id));
    }
}

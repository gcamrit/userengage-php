<?php

namespace Gc\UserEngage\Request;

use InvalidArgumentException;
use RuntimeException;

/**
 * Class CreateUser
 * @package Gc\UserEngage\Request
 */
final class CreateUser implements Request
{
    /**
     * @var string
     */
    private $firstName;
    /**
     * @var string
     */
    private $lastName;
    /**
     * @var string
     */
    private $email;

    /**
     * @param $value
     */
    public function setFirstName($value)
    {
        $this->firstName = $value;
    }

    /**
     * @param $value
     */
    public function setLastName($value)
    {
        $this->lastName = $value;
    }

    /**
     * @param $value
     */
    public function setEmail($value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('(' . $value . ') isn\'t a valid email address.');
        }

        $this->email = $value;
    }


    /**
     * @return string
     * @throws RuntimeException
     */
    private function getFirstName()
    {
        if (!isset($this->firstName)) {
            throw new RuntimeException('Please provide first name.');
        }
        return $this->firstName;
    }

    /**
     * @return string
     * @throws RuntimeException
     */
    private function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return string
     * @throws RuntimeException
     */
    private function getEmail()
    {
        if (!isset($this->email)) {
            throw new RuntimeException('Please provide an email address.');
        }

        return $this->email;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return [
            'first_name' => $this->getFirstName(),
            'last_name' => $this->getLastName(),
            'email' => $this->getEmail(),
        ];
    }
}

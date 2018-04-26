<?php

namespace Gc\UserEngage\Http;

use Gc\UserEngage\AbstractResource;

class Event extends AbstractResource
{
    public function add($detail)
    {
        return $this->create('events/', $detail);
    }

    public function addForUser($userId, $eventDetail)
    {
        return $this->create(sprintf('users-by-id/%s/events/', $userId), $eventDetail);
    }
}

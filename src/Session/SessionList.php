<?php

namespace Alf\ScheduleTable\Session;

use Alf\ScheduleTable\Session;

class SessionList extends \SplDoublyLinkedList
{
    public function push(Session $day)
    {
        parent::push($day);
    }

    public function unshift(Session $session)
    {
        parent::unshift($session);
    }

    public function add($index, Session $newSession)
    {
        parent::add($index, $newSession);
    }

    public function offsetSet($index, $newSession)
    {
        if (!$newSession instanceof Session) {
            throw new \InvalidArgumentException('New Session must be instance of \Alf\ScheduleTable\Session');
        }

        parent::offsetSet($index, $newSession);
    }
}


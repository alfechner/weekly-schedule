<?php

namespace Alf\ScheduleTable\Week;

class Session
{
    protected $from;
    protected $till;
    protected $content;

    function __construct(\DateTime $from, \DateTime $till, $content)
    {
        $this->from = $from;
        $this->till = $till;
        $this->content = $content;
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function getTill()
    {
        return $this->till;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getDuration()
    {
        // TODO
    }
}
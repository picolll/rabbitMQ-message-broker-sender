<?php
class Event
{
    private $id;
    private $timestamp;
    private $data;
    private $event;

    /**
     * Event constructor.
     *
     * @param $id
     * @param $timestamp
     * @param $data
     * @param $event
     */
    public function __construct($id, $timestamp, $data, $event)
    {
        $this->id        = $id;
        $this->timestamp = $timestamp;
        $this->data      = $data;
        $this->event     = $event;
    }


    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param mixed $timestamp
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }

    /**
     * @return mixed
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param mixed $event
     */
    public function setEvent($event)
    {
        $this->event = $event;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}

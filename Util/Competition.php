<?php

class Competition
{
    private static $instance;
    private $isLock;

    function __construct()
    {
        $this->isLock = false;
    }

    public static function getInstance()
    {
        if (self::$instance == null)
            self::$instance = new Competition();

        return self::$instance;
    }

    public function lock()
    {
        if ($this->isLock) var_dump($this->isLock);
        return $this->isLock;
    }

    public function defineLock($arg)
    {
        $this->isLock = (boolean)$arg;
    }

}
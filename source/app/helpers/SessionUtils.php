<?php

/**
 * Class SessionUtils
 *
 * Add Methods for accessing SESSION variables
 *
 */
class SessionUtils extends Prefab
{

    /**
     * @var $f3 Base
     */
    private $f3;

    /**
     * SessionHolder constructor.
     */
    public function __construct()
    {
        $this->f3 = F3::$fw;
    }

    public function getUserId()
    {
        return $this->get('userId');
    }

    public function get($key)
    {
        return $this->f3->get('SESSION.' . $key);
    }

    public function getUserName()
    {
        return $this->get('userName');
    }

    public function set($key, $value)
    {
        $this->f3->set('SESSION.' . $key, $value);
    }


}
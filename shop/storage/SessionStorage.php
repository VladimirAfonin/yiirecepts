<?php

namespace shop\storage;

use yii\web\Session;

class SessionStorage implements StorageInterface
{
    private $_session;
    private $_key;

    public function __construct(Session $session, $key)
    {
        $this->_session = $session;
        $this->_key = $key;
    }

    /**
     * @return array of cart items
     */
    public function load()
    {
        return $this->_session->get($this->_key, []);
    }

    /**
     * @param array $items from cart
     */
    public function save(array $items)
    {
        $this->_session->set($this->_key, $items);
    }
}
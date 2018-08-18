<?php

namespace shop;

use shop\storage\StorageInterface;
use yii\base\Component;

class ShoppingCart extends Component
{
    public $sessionKey = 'cart';
    private $_storage;
    private $_items = [];

    public function __construct(StorageInterface $storage, array $config = [])
    {
        $this->_storage = $storage;
        parent::__construct($config);
    }

    /**
     * add to cart item
     * @param $id
     * @param $amount
     */
    public function add($id, $amount): void
    {
        $this->loadItems();
        if (array_key_exists($id, $this->_items)) {
            $this->_items[$id]['amount'] += $amount;
        } else {
            $this->_items[$id] = ['id' => $id, 'amount' => $amount];
        }
        $this->saveItems();
    }

    /**
     * remove item from cart
     * @param $id
     */
    public function remove($id): void
    {
        $this->loadItems();
        $this->_items = array_diff_key($this->_items, [$id => []]);
        $this->saveItems();
    }

    /**
     *  clear cart
     */
    public function clear(): void
    {
        $this->_items = [];
        $this->saveItems();
    }

    /**
     * @return array
     */
    public function getItems()
    {
        $this->loadItems();
        return $this->_items;
    }

    private function loadItems()
    {
        $this->_items = $this->_storage->load();
    }

    private function saveItems()
    {
        $this->_storage->save($this->_items);
    }
}
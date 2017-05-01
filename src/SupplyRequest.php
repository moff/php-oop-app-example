<?php
namespace App;

class SupplyRequest implements SupplyRequestInterface
{
    private $store;
    private $list = [];

    function __construct(StoreInterface $store, array $list = [])
    {
        $this->store = $store;
        $this->list = $list;
    }

    public function getList()
    {
        return $this->list;
    }

    public function getStore()
    {
        return $this->store;
    }
}
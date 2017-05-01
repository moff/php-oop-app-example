<?php
namespace App;

class Company
{
    private $name;
    private $plants = [];
    private $stores = [];

    public function __construct($name = 'UNKNOWN')
    {
        $this->name = $name;
    }

    public function createStore($name)
    {
        $store = new Store($name);
        $this->stores[] = $store;

        return $store;
    }

    public function createPlant($name)
    {
        $plant = new Plant($name);
        $this->plants[] = $plant;

        return $plant;
    }

    public function getName()
    {
        return $this->name;
    }
}
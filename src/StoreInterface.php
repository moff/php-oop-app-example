<?php
/**
 * Created by PhpStorm.
 * User: paul
 * Date: 30.04.17
 * Time: 20:04
 */
namespace App;

interface StoreInterface
{
    public function sendRequest(PlantInterface $plant, $list);

    public function receiveProducts(array $package);

    public function getProductByType($type);
}
<?php
namespace App;

class Store extends AbstractFacility implements StoreInterface
{
    public function sendRequest(PlantInterface $plant, $list)
    {
        $plant->receiveRequest($this, $list);
    }

    public function receiveProducts(array $package)
    {
        foreach ($package as $type => $products) {
            foreach ($products as $product) {
                $this->addProduct($product);
            }
        }
    }

    public function getProductByType($type)
    {
        return array_pop($this->products[$type]);
    }
}
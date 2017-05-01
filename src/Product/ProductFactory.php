<?php
namespace App\Product;

class ProductFactory implements ProductFactoryInterface
{
    public function create($type)
    {
        return new Product($type);
    }
}
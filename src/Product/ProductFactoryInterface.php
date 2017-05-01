<?php
namespace App\Product;

interface ProductFactoryInterface
{
    public function create($type);
}
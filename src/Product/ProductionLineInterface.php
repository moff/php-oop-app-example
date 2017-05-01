<?php
namespace App\Product;

interface ProductionLineInterface
{
    public function createProducts($type, $quantity);
}
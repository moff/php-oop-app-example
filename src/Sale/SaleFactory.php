<?php
namespace App\Sale;

use App\Customer\CustomerInterface;
use App\Product\ProductInterface;

class SaleFactory implements SaleFactoryInterface
{
    public function create(ProductInterface $product, CustomerInterface $customer, $price, $cash = true)
    {
        return new Sale($product, $customer, $price, $cash);
    }
}
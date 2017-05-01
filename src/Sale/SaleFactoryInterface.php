<?php
namespace App\Sale;

use App\Customer\CustomerInterface;
use App\Product\ProductInterface;

interface SaleFactoryInterface
{
    public function create(ProductInterface $product, CustomerInterface $customer, $price, $cash = true);
}
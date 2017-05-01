<?php
namespace App\Sale;

use App\Customer\CustomerInterface;
use App\Product\ProductInterface;

class Sale implements SaleInterface
{
    private $product;
    private $customer;
    private $price;
    private $cash;

    public function __construct(ProductInterface $product, CustomerInterface $customer, $price, $cash = true)
    {
        $this->product = $product;
        $this->customer = $customer;
        $this->price = $price;
        $this->cash = $cash;
    }

    public function getCash()
    {
        return $this->cash;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function getCustomer()
    {
        return $this->customer;
    }
}
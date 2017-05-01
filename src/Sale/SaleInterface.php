<?php
namespace App\Sale;

interface SaleInterface
{
    public function getCash();
    public function getProduct();
    public function getCustomer();
}
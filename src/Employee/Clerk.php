<?php
namespace App\Employee;

use App\Customer\CustomerInterface;
use App\Logger;
use App\Product\ProductInterface;
use App\Sale\SaleFactoryInterface;
use App\Sale\SaleInterface;

class Clerk extends AbstractEmployee implements EmployeeInterface
{
    private $sales = [];
    private $saleFactory;

    public function __construct($name, SaleFactoryInterface $saleFactory)
    {
        parent::__construct($name);
        $this->saleFactory = $saleFactory;
    }

    public function sell(ProductInterface $product, CustomerInterface $customer, $price, $cash = true)
    {
        $sale = $this->saleFactory->create($product, $customer, $price, $cash);
        $this->addSale($sale);
        $this->logSale($sale);
    }

    public function addSale(SaleInterface $sale)
    {
        $this->sales[] = $sale;
    }

    private function logSale(SaleInterface $sale)
    {
        $paymentMethod = $sale->getCash() ? 'cash' : 'card';
        $additionalInfo = 'serial number: ' . $sale->getProduct()->getSerialNumber() .
            ', store: ' . $this->getFacility()->getName() .
            ', payment method: ' . $paymentMethod;

        if (!$sale->getCash()) $additionalInfo .= ', customer name: ' . $sale->getCustomer()->getName();

        Logger::getInstance()->log(
            'Sale. ',
            $additionalInfo
        );
    }
}
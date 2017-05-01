<?php
namespace App\Employee;

use App\Logger;
use App\Product\ProductionLineInterface;
use App\Product\ProductFactoryInterface;

class ProductionWorker extends AbstractEmployee implements HasSupervisorInterface, ProductionLineInterface, EmployeeInterface
{
    private $supervisor;
    private $productFactory;

    function __construct($name, ProductFactoryInterface $productFactory)
    {
        parent::__construct($name);
        $this->productFactory = $productFactory;
    }

    public function setSupervisor(HasSubordinatesInterface $productionManager)
    {
        $this->supervisor = $productionManager;
    }

    public function createProducts($type, $quantity)
    {
        for ($i = 0; $i < $quantity; $i++) {
            $product = $this->createProduct($type);
            $this->getFacility()->addProduct($product);
        }
    }

    public function createProduct($type)
    {
        $product = $this->productFactory->create($type);

        Logger::getInstance()->log(
            'Product created',
            'type: ' . $type .
            ', serial number: ' .
            $product->getSerialNumber() .
            ', plant: ' .
            $this->getName() .
            ', production manager: ' .
            $this->supervisor->getName()
        );

        return $product;
    }
}
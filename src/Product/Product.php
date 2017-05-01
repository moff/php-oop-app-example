<?php
namespace App\Product;

use App\SNGenerator;

class Product implements ProductInterface
{
    private $type;
    private $serialNumber;

    public function __construct($type)
    {
        $this->type = $type;
        $this->serialNumber = SNGenerator::getInstance()->generateSerialNumber();
    }

    public function getType()
    {
        return $this->type;
    }

    public function getSerialNumber()
    {
        return $this->serialNumber;
    }
}
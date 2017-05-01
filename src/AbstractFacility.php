<?php
namespace App;

use App\Employee\EmployeeInterface;
use App\Product\Product;

abstract class AbstractFacility
{
    protected $name;
    protected $employees = [];
    protected $products = [];

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function hire(EmployeeInterface $employee)
    {
        $this->addEmployee($employee);
        $employee->setFacility($this);
    }

    public function addEmployee(EmployeeInterface $employee)
    {
        $this->employees[] = $employee;
    }

    public function addProduct(Product $product)
    {
        $this->products[$product->getType()][] = $product;
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function getEmployees()
    {
        return $this->employees;
    }

    public function getName()
    {
        return $this->name;
    }
}
<?php
namespace App\Employee;

use App\Product\ProductionLineInterface;

class ProductionManager extends AbstractEmployee implements HasSubordinatesInterface, ProductionLineInterface, EmployeeInterface
{
    private $subordinates = [];

    public function addSubordinate(HasSupervisorInterface $employee)
    {
        $this->subordinates[] = $employee;
        $employee->setSupervisor($this);
    }

    public function createProducts($type, $quantity)
    {
        $this->getProductionWorker()->createProducts($type, $quantity);
    }

    /**
     * Get random production worker
     *
     * @return mixed
     */
    private function getProductionWorker()
    {
        $randomIndex = array_rand($this->subordinates, 1);
        return $this->subordinates[$randomIndex];
    }
}
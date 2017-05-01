<?php
namespace App\Employee;

use App\AbstractFacility;

interface EmployeeInterface
{
    public function getName();
    public function getFacility();
    public function setFacility(AbstractFacility $facility);
}
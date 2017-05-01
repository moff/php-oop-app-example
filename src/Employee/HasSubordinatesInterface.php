<?php
namespace App\Employee;

interface HasSubordinatesInterface
{
    public function addSubordinate(HasSupervisorInterface $employee);
}
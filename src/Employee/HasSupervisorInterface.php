<?php
namespace App\Employee;

interface HasSupervisorInterface
{
    public function setSupervisor(HasSubordinatesInterface $supervisor);
}
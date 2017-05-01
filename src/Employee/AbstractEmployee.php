<?php
namespace App\Employee;

use App\AbstractFacility;

abstract class AbstractEmployee
{
    protected $name;
    protected $facility;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getFacility()
    {
        return $this->facility;
    }

    public function setFacility(AbstractFacility $facility)
    {
        $this->facility = $facility;
    }
}
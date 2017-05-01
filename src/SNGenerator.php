<?php
namespace App;

use App\Core\SingletonTrait;

class SNGenerator
{
    use SingletonTrait;

    private $serials = [];

    public function serialExists($number) {
        if (in_array($number, $this->serials)) return true;
        return false;
    }

    public function generateSerialNumber() {
        $serialNumber = uniqid();

        while ($this->serialExists($serialNumber)) {
            $serialNumber = uniqid();
        }

        $this->serials[] = $serialNumber;

        return $serialNumber;
    }
}
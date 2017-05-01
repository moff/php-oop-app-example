<?php
namespace App\Employee;

use App\Core\ObserverInterface;
use App\EventManager;
use App\Logger;
use App\SupplyRequestInterface;

class SupplyManager extends AbstractEmployee implements ObserverInterface, EmployeeInterface
{
    public function handle($event)
    {
        if ($event == 'supply-request-received') {
            $this->handleSupplyRequests();
        }
    }

    public function __construct($name)
    {
        parent::__construct($name);
        EventManager::getInstance()->attach($this);
    }

    private function handleSupplyRequests()
    {
        foreach ($this->getFacility()->getSupplyRequests() as $request) {
            $this->supplyStore($request);
        }
    }

    private function supplyStore(SupplyRequestInterface $request)
    {
        $package = $this->createPackage($request);
        $this->refreshProductsList($package);

        // let's send products to the store
        $request->getStore()->receiveProducts($package);

        $this->logDelivery($request, $package);
    }

    private function refreshProductsList(array $package)
    {
        // let's create a list of serial numbers to remove from Plant's registry
        $serials = [];

        foreach ($package as $type => $products) {
            foreach ($products as $product) {
                $serials[] = $product->getSerialNumber();
            }
        }

        $this->facility->updateProductList($serials);
    }

    private function createPackage(SupplyRequestInterface $request)
    {
        $availableProducts = $this->getFacility()->getProducts();
        $list = $request->getList();

        $package = [];

        foreach ($list as $type => $quantity) {
            if (!isset($availableProducts[$type])) continue;

            $availableOfThisType = count($availableProducts[$type]);

            if ($availableOfThisType >= $quantity) {
                $package[$type] = array_splice($availableProducts[$type], 0, $quantity);
            } else {
                $package[$type] = $availableProducts[$type];
                $availableProducts[$type] = [];
            }
        }

        return $package;
    }

    private function logDelivery(SupplyRequestInterface $request, $package)
    {
        $productsString = '';
        foreach ($package as $type => $products) {
            $productsString .= $type . ' x ' . count($products);
        }

        $productsString = trim($productsString, ' ,');

        Logger::getInstance()->log(
            'Products delivered. ',
            'Plant: ' . $this->facility->getName() .
            ', store: ' . $request->getStore()->getName() .
            ', products: ' . $productsString . '; supply manager: ' . $this->getName()
        );
    }
}
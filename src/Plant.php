<?php
namespace App;

use App\Employee\ProductionManager;
use App\Product\ProductionLineInterface;

class Plant extends AbstractFacility implements ProductionLineInterface, PlantInterface
{
    private $supplyRequests = [];
    private $productionManager;

    public function getSupplyRequests()
    {
        return $this->supplyRequests;
    }

    public function receiveRequest(StoreInterface $store, array $list)
    {
        $this->addRequest($store, $list);

        EventManager::getInstance()->notify('supply-request-received');
        $this->logSupplyRequest($store, $list);
    }

    public function logSupplyRequest(StoreInterface $store, array $list)
    {
        $productListString = '';

        foreach ($list as $type => $quantity) {
            $productListString .= $type . ' x ' . $quantity . ', ';
        }

        $productListString = trim($productListString, ' ,');

        Logger::getInstance()->log(
            'Supply request received. ',
            'Store: ' . $store->getName() .
            ', products: ' . $productListString
        );
    }

    public function addRequest(StoreInterface $store, array $list)
    {
        $this->supplyRequests[] = new SupplyRequest($store, $list);
    }

    public function createProducts($type, $quantity = 1)
    {
        $this->productionManager->createProducts($type, $quantity);
    }

    public function updateProductList(array $serials)
    {
        foreach ($this->products as $type => $products) {
            foreach ($products as $key => $product) {
                if (in_array($product->getSerialNumber(), $serials)) {
                    unset($this->products[$type][$key]);
                }
            }
        }
    }

    public function setProductionManager(ProductionManager $productionManager)
    {
        $this->productionManager = $productionManager;
    }

    public function getProductionManager()
    {
        return $this->productionManager;
    }
}
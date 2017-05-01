<?php
namespace App;

use App\Employee\ProductionManager;

interface PlantInterface
{
    public function getSupplyRequests();

    public function receiveRequest(StoreInterface $store, array $list);

    public function logSupplyRequest(StoreInterface $store, array $list);

    public function addRequest(StoreInterface $store, array $list);

    public function createProducts($type, $quantity = 1);

    public function updateProductList(array $serials);

    public function setProductionManager(ProductionManager $productionManager);

    public function getProductionManager();
}
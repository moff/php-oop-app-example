<?php
require __DIR__ . '/vendor/autoload.php';

// Inheritance and abstract classes are used for entities - Customer, Employee, Facility
// Polymorphism is used by createProducts() method via ProductionLineInterface interface
// Singleton pattern is used for Logger and EventManagement via trait
// Observer pattern is used for event management
// Factory Method pattern is used to create products and sales
// Dependency injection via constructor is used in: ProductionWorker, Clerk

use App\Logger;
use App\Company;
use App\Employee\Clerk;
use App\Customer\Customer;
use App\Employee\SupplyManager;
use App\Product\ProductFactory;
use App\Employee\ProductionWorker;
use App\Employee\ProductionManager;
use App\Sale\SaleFactory;

$company = new Company('Vivify Inc.');

// create a plant
$plant = $company->createPlant('ElFacto 1');

// create employees for the plant
$productionWorker = new ProductionWorker('Filip Filipović', new ProductFactory());
$productionManager = new ProductionManager('Ljubica Ljubičić');
$supplyManager = new SupplyManager('Miloš Milošević');

// the plant hires employees
$plant->hire($productionWorker);
$plant->hire($productionManager);
$plant->hire($supplyManager);

// production manager is put in position and has subordinates
$plant->setProductionManager($productionManager);
$plant->getProductionManager()->addSubordinate($productionWorker);

// create a store
$store = $company->createStore('SuperTronics');

// create employees for the store
$clerk = new Clerk('Aleks Aleksić', new SaleFactory());

// the store hires employees
$store->hire($clerk);

// the plant creates products
$plant->createProducts('Monitor', 20);

$list = [
    'Monitor' => 10,
    'Keyboard' => 50,
];

// store requests products
$store->sendRequest($plant, $list);

// we have a customer!
$customer = new Customer('Miril Mirilović');

// customer wants to buy a monitor
$monitor = $clerk->getFacility()->getProductByType('Monitor');

// clerk sells the monitor to the customer
$clerk->sell($monitor, $customer, 80);

print_r($company);
print_r(Logger::getInstance()->getEntries());
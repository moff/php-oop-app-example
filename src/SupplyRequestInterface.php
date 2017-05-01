<?php
/**
 * Created by PhpStorm.
 * User: paul
 * Date: 30.04.17
 * Time: 23:58
 */
namespace App;

interface SupplyRequestInterface
{
    public function getList();

    public function getStore();
}
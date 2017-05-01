<?php
namespace App\Core;

interface ObserverInterface
{
    public function handle($event);
}
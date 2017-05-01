<?php
namespace App;

use App\Core\SingletonTrait;

class Logger
{
    use SingletonTrait;

    private $entries = [];

    public function log($action, $additionalInfo = '')
    {
        $entry = '[' . date('m/d/Y H:i') . ']' . ' ' . $action . ' ' . $additionalInfo;
        $this->entries[] = $entry;
    }

    public function getEntries()
    {
        return $this->entries;
    }
}
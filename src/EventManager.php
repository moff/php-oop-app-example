<?php
namespace App;

use App\Core\ObserverInterface;
use App\Core\SingletonTrait;
use App\Core\SubjectInterface;

class EventManager implements SubjectInterface
{
    use SingletonTrait;

    private $observers = [];

    public function attach(ObserverInterface $observer)
    {
        $this->observers[] = $observer;
    }

    public function detach(ObserverInterface $observer)
    {
        // TODO: Implement detach() method.
    }

    public function notify($event)
    {
        foreach ($this->observers as $observer) {
            $observer->handle($event);
        }
    }
}
<?php


namespace App\EntityListener;


use App\Entity\Administrator;
use Doctrine\ORM\Event\LifecycleEventArgs;

class AdministratorEntityListener
{
    public function prePersist(Administrator $administrator, LifecycleEventArgs $event){
        $administrator->generateCreatedAt();
    }
}

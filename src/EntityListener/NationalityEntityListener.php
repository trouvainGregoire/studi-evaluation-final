<?php

namespace App\EntityListener;


use App\Entity\Nationality;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;


class NationalityEntityListener
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(Nationality $nationality, LifecycleEventArgs $event)
    {
        $nationality->generateSlug($this->slugger);
    }

    public function preUpdate(Nationality $nationality, LifecycleEventArgs $event)
    {
        $nationality->generateSlug($this->slugger);
    }
}

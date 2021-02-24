<?php


namespace App\EntityListener;


use App\Entity\Speciality;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class SpecialityEntityListener
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(Speciality $speciality, LifecycleEventArgs $event)
    {
        $speciality->generateSlug($this->slugger);
    }

    public function preUpdate(Speciality $speciality, LifecycleEventArgs $event)
    {
        $speciality->generateSlug($this->slugger);
    }
}

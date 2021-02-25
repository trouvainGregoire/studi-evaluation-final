<?php

namespace App\Controller\Admin;

use App\Entity\Administrator;
use App\Entity\Agent;
use App\Entity\Contact;
use App\Entity\Country;
use App\Entity\Hideway;
use App\Entity\Mission;
use App\Entity\MissionStatus;
use App\Entity\MissionType;
use App\Entity\Nationality;
use App\Entity\Speciality;
use App\Entity\Target;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Test');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::linkToCrud('Agents', 'fas fa-list', Agent::class);
        yield MenuItem::linkToCrud('Contacts', 'fas fa-list', Contact::class);
        yield MenuItem::linkToCrud('Targets', 'fas fa-list', Target::class);
        yield MenuItem::linkToCrud('Hideways', 'fas fa-list', Hideway::class);
        yield MenuItem::linkToCrud('Specialities', 'fas fa-list', Speciality::class);

        yield MenuItem::section('Missions');

        yield MenuItem::linkToCrud('Missions', 'fas fa-list', Mission::class);
        yield MenuItem::linkToCrud('Mission Status', 'fas fa-list', MissionStatus::class);
        yield MenuItem::linkToCrud('Mission Types', 'fas fa-list', MissionType::class);

        yield MenuItem::section('Countries');
        yield MenuItem::linkToCrud('Countries', 'fas fa-list', Country::class);
        yield MenuItem::linkToCrud('Nationality', 'fas fa-list', Nationality::class);


        yield MenuItem::section('Users');


        yield MenuItem::linkToCrud('Administrators', 'fas fa-list', Administrator::class);
    }
}

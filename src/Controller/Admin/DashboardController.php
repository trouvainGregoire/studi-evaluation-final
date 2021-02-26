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
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @IsGranted("ROLE_ADMIN")
 */
class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(AgentCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('KGB Administration');
    }

    public function configureMenuItems(): iterable
    {

        yield MenuItem::linkToCrud('Agents', 'fas fa-user-secret', Agent::class);
        yield MenuItem::linkToCrud('Contacts', 'fas fa-user-tie', Contact::class);
        yield MenuItem::linkToCrud('Targets', 'fas fa-user-tag', Target::class);
        yield MenuItem::linkToCrud('Hideways', 'fas fa-warehouse', Hideway::class);
        yield MenuItem::linkToCrud('Specialities', 'fas fa-swatchbook', Speciality::class);

        yield MenuItem::section('Missions');

        yield MenuItem::linkToCrud('Missions', 'fas fa-mask', Mission::class);
        yield MenuItem::linkToCrud('Mission Status', 'fas fa-eye', MissionStatus::class);
        yield MenuItem::linkToCrud('Mission Types', 'fas fa-sign', MissionType::class);

        yield MenuItem::section('Countries');
        yield MenuItem::linkToCrud('Countries', 'fas fa-globe-europe', Country::class);
        yield MenuItem::linkToCrud('Nationality', 'fas fa-flag', Nationality::class);


        yield MenuItem::section('Users');


        yield MenuItem::linkToCrud('Administrators', 'fas fa-user-shield', Administrator::class);
    }
}

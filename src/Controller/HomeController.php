<?php

namespace App\Controller;

use App\Entity\Mission;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {

        $missions = $this->getDoctrine()
            ->getRepository(Mission::class)
            ->findBy([], ['startAt' => 'asc']);

        $paginatedMissions = $paginator->paginate(
          $missions,
          $request->query->getInt('page', 1),
          5
        );

        return $this->render('home/index.html.twig', [
            'missions' => $paginatedMissions,
        ]);
    }
}

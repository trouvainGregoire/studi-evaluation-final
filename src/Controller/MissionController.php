<?php

namespace App\Controller;

use App\Entity\Mission;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MissionController extends AbstractController
{
    /**
     * @Route("/missions/{id}", name="show_mission")
     */
    public function show(int $id): Response
    {
        $mission = $this->getDoctrine()
            ->getRepository(Mission::class)->find($id);

        return $this->render('mission/show.html.twig', [
            'mission' => $mission,
        ]);
    }
}

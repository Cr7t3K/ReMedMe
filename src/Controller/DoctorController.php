<?php

namespace App\Controller;

use App\Repository\RelativeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DoctorController extends AbstractController
{
    /**
     * @Route("/doctor", name="doctor")
     */
    public function index(RelativeRepository $relativeRepository)
    {

        return $this->render('doctor/index.html.twig', [
            'relatives' => $relativeRepository->findAll(),
        ]);
    }
}

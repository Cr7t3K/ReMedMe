<?php

namespace App\Controller;

use App\Entity\Relative;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/user/{id}", name="user_show", methods={"GET"})
     * @Route("/user/{id}/relative/{relative}", name="user_show_relative")
     */
    public function show(User $user, ?Relative $relative) :Response
    {
        if (!empty($relative)) {
            return $this->render('user/index.html.twig', [
                'user' => $user,
                'relative_medoc' => $relative
            ]);
        }
        return $this->render('user/index.html.twig', [
            'user' => $user,
        ]);
    }
}

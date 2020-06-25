<?php

namespace App\Controller;

use App\Entity\Relative;
use App\Entity\User;
use App\Form\RelativeType;
use App\Repository\RelativeRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/relative")
 */
class RelativeController extends AbstractController
{
    /**
     * @Route("/", name="relative_index", methods={"GET"})
     */
    public function index(RelativeRepository $relativeRepository): Response
    {
        return $this->render('relative/index.html.twig', [
            'relatives' => $relativeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="relative_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $relative = new Relative();
        $form = $this->createForm(RelativeType::class, $relative);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $relative->setRelationship($form->get('relationship')->getData())
                ->setGender($form->get('gender')->getData())
                ->setIsUser(1)
                ->setUserId($this->getUser());



            $entityManager->persist($relative);
            $entityManager->flush();

            return $this->redirectToRoute('user_show', ['id' => $this->getUser()->getId()]);
        }

        return $this->render('relative/new.html.twig', [
            'relative' => $relative,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="relative_show", methods={"GET"})
     */
    public function show(Relative $relative): Response
    {
        return $this->render('relative/show.html.twig', [
            'relative' => $relative,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="relative_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Relative $relative): Response
    {
        $form = $this->createForm(RelativeType::class, $relative);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('relative_index');
        }

        return $this->render('relative/edit.html.twig', [
            'relative' => $relative,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="relative_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Relative $relative): Response
    {
        if ($this->isCsrfTokenValid('delete'.$relative->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($relative);
            $entityManager->flush();
        }

        return $this->redirectToRoute('relative_index');
    }
}

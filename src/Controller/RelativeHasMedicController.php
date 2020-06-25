<?php

namespace App\Controller;

use App\Entity\Relative;
use App\Entity\RelativeHasMedic;
use App\Form\RelativeHasMedicType;
use App\Repository\RelativeHasMedicRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/relative/has/medic")
 */
class RelativeHasMedicController extends AbstractController
{
    /**
     * @Route("/", name="relative_has_medic_index", methods={"GET"})
     */
    public function index(RelativeHasMedicRepository $relativeHasMedicRepository): Response
    {
        return $this->render('relative_has_medic/index.html.twig', [
            'relative_has_medics' => $relativeHasMedicRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{id}", name="relative_has_medic_new", methods={"GET","POST"})
     */
    public function new(Request $request, Relative $relative): Response
    {
        $relativeHasMedic = new RelativeHasMedic();
        $form = $this->createForm(RelativeHasMedicType::class, $relativeHasMedic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $relativeHasMedic->setCreatedAt(new \DateTime());
            $relativeHasMedic->setRelativeId($relative);
            $entityManager->persist($relativeHasMedic);
            $entityManager->flush();

            return $this->redirectToRoute('user_show_relative', ['id' => $this->getUser()->getId(), 'relative' => $relativeHasMedic->getRelativeId()->getId()]);
        }

        return $this->render('relative_has_medic/new.html.twig', [
            'relative_has_medic' => $relativeHasMedic,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="relative_has_medic_show", methods={"GET"})
     */
    public function show(RelativeHasMedic $relativeHasMedic): Response
    {
        return $this->render('relative_has_medic/show.html.twig', [
            'relative_has_medic' => $relativeHasMedic,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="relative_has_medic_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, RelativeHasMedic $relativeHasMedic): Response
    {
        $form = $this->createForm(RelativeHasMedicType::class, $relativeHasMedic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_show_relative', ['id' => $this->getUser()->getId(), 'relative' => $relativeHasMedic->getRelativeId()->getId()]);
        }

        return $this->render('relative_has_medic/edit.html.twig', [
            'relative_has_medic' => $relativeHasMedic,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="relative_has_medic_delete", methods={"DELETE"})
     */
    public function delete(Request $request, RelativeHasMedic $relativeHasMedic): Response
    {
        if ($this->isCsrfTokenValid('delete'.$relativeHasMedic->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($relativeHasMedic);
            $entityManager->flush();
        }

        return $this->redirectToRoute('home');
    }
}

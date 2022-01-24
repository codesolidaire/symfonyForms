<?php

namespace App\Controller;


use App\Entity\Cat;
use App\Form\CatType;
use App\Repository\CatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route(name="cat_")
 */
class CatController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(CatRepository $catRepository): Response
    {
        $cats = [];
        $cats = $catRepository->findAll();
        //dd($cats);

        return $this->render('cat/index.html.twig', [
            'cats' => $cats,
        ]);
    }

    /**
     * @Route ("/add", name="add")
     */
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cat = new Cat();
        $form = $this->createForm(CatType::class, $cat);
        $form->handleRequest($request);
        //dd($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($cat);
            $entityManager->flush();

            return $this->redirectToRoute('cat_index');
        }

        return $this->render(
            'cat/add.html.twig',
            [
              'form' => $form->createView(),
            ]
        );
    }
}

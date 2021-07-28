<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\CatRepository;

/**
 * @Route(name="cat_")
 */
class CatController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(/*CatRepository $catRepository*/): Response
    {
        $cats = [];
        // $cats = $catRepository->findAll();

        return $this->render('cat/index.html.twig', [
            'cats' => $cats,
        ]);
    }
}

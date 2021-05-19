<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CatController extends AbstractController
{
    /**
     * @Route("/cute-cat/{id}", name="cat")
     */
    public function index(int $id): Response
    {
        return $this->render('cat/index.html.twig', [
            'id' => $id,
        ]);
    }
}

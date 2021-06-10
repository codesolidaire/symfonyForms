<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CatRepository;
use App\Form\CatType;
use App\Form\HumanType;
use App\Entity\Human;
use App\Entity\Cat;
use App\Repository\HumanRepository;

/**
 * @Route(name="cat_")
 */
class CatController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(/*CatRepository $catRepository, HumanRepository $humanRepository*/): Response
    {
        // $cats = $catRepository->findAll();
        // $humans = $humanRepository->findAll();

        return $this->render('cat/index.html.twig', [
            'cats' => $cats ?? [],
            'humans' => $humans ?? [],
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
       /**
     * @Route("/", name="home", methods={"GET"})
     */
    public function home(CategorieRepository $categorieRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'categories' => $categorieRepository->findLastThree(),
        ]);
    }
}
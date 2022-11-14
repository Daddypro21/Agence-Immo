<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name:'home',methods:['GET'])]
    public function index(PropertyRepository $property):Response
    {
        $properties = $property->findLatest();

        return $this->render('pages/home.html.twig',["properties" => $properties]);
    }
}
<?php 

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PropertyController extends AbstractController
{
    private $repository;
    private $em;

    public function __construct(PropertyRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }
    #[Route('/property', name :'property.index',methods:['GET'])]
    public function index():Response 
    {

            $property = $this->repository->findAllVisible();
            dd($property);
        return $this->render('property/index.html.twig',
        ['current_menu'=>'properties']
        );
    }

    #[Route('/biens/{slug}-{id}', name :'property.show',methods:['GET'])]
    public function show( Property $property, string $slug):Response 
    {
        /**
         * Verification du slug,
         * s'il est invalide on redirige l'utilisateur sur la même page
         */
        if($property->getSlug() !== $slug){
           return $this->redirectToRoute('property.show',
            [
                'id'=> $property->getId(),
                'slug'=> $property->getSlug()
            ],301
            ) ;
        }

        return $this->render('property/show.html.twig',
        ['current_menu'=>'properties','property'=>$property]
        );
    }
}
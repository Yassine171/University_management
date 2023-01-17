<?php
namespace App\Controller;

use APP\Entity\Etudiant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class EtudiantController extends AbstractController{

    public function __construct(
      
    ) {}

    
    #[Route(
        name: 'etudiant_add',
        path: '/api/etudiants/add',
        methods: ['POST'],
        defaults: [
            '_api_resource_class' => Etudiant::class,
        ],
    )]
    public function __invoke(Etudiant $etudiant):Etudiant
    {
        dd($etudiant);
        return $etudiant;
    }
}
<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Entity\ResponsableCompte;

class AdminController extends AbstractController
{
    private $ent;
    private $session_admin;
    private $respoCompte ;

    public function __construct(EntityManagerInterface $entity){
        $this->ent = $entity;
        $this->session_admin = new Session();
        $this->respoCompte = $this->ent->getRepository(ResponsableCompte::class);
    }

    public function indexPage(){
        return $this->render("administrateur/pages/accueil_admin.html.twig");
    }

    public function deconnexionAdmin(){
        $this->session_admin->set("nom_Complet_admin",null);
        return $this->redirectToRoute("index");
    }

    public function insertResponsable(Request $request){
        var_dump($request->request->get("nom_respo"));
        die();
    }



}

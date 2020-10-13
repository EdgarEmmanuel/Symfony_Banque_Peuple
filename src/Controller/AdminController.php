<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Session;

class AdminController extends AbstractController
{
    private $ent;
    private $session_admin;

    public function __construct(EntityManagerInterface $entity){
        $this->ent = $entity;
        $this->session_admin = new Session();
    }

    public function indexPage(){
        return $this->render("administrateur/pages/accueil_admin.html.twig");
    }

    public function deconnexionAdmin(){
        $this->session_admin->set("nom_Complet_admin",null);
        return $this->redirectToRoute("index");
    }



}

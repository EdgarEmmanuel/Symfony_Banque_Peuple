<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    private $ent;
    public function __construct(EntityManagerInterface $entity){
        $this->ent = $entity;
    }

    public function indexPage(){
        return $this->render("administrateur/pages/accueil_admin.html.twig");
    }
}

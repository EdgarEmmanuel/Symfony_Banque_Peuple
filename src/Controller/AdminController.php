<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    private $ent;
    private $compteEntity;
    public function __construct(EntityManagerInterface $entity){
        $this->ent = $entity;
       
    }

    public function verifyAdmin($login , $password){
        var_dump($login);
        die;
        return $this->render("admin/administrateur.html.twig");
    }
}

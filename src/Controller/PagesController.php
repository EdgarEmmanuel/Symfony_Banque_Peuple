<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Clients;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Doctrine\ORM\EntityManagerInterface;

class PagesController extends AbstractController
{
    private $enti;
    private $clients;

    public function __construct(EntityManagerInterface $entity){
        $this->enti = $entity;
        $this->clients = $this->enti->getRepository(Clients::class);
    }
    
    public function getPageCni()
    {
        return $this->render('admin/cni.html.twig');
    }

    public function logout(){
        return $this->render("test/index.html.twig");
    }

    public function getPageInsertCS(){
        //the page for insert client salarie

        //query from the database 
        $data = $this->enti
            ->createQuery("SELECT count(cl.id) as num from App\Entity\Clients cl where substring(cl.matricule,1,3)='BPS'")
            ->getResult();

            //set the matricule 
            foreach($data as $d){
                $matricule = "BPS".((int)$d["num"] + 1);
            }

            //put in the array to send 
            $donnees["matricules"] = $matricule;
          

        return $this->render("clients/cSalarie.html.twig",$donnees);
    }
}

<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\ClientSalarie;
use Symfony\Component\HttpFoundation\Session\Session;

class CompteController extends AbstractController
{
    private $_entity;
    private $SalarieRepository;

    public function __construct(EntityManagerInterface $entity){
        $this->_entity=$entity;
        $this->SalarieRepository = $this->_entity->getRepository(ClientSalarie::class);
    }
   
    public function verifyMatricule(Request $request){
        //first verify the length
        if(strlen($request->request->get("matricule")) < 3){
            return $this->redirectToRoute("cniPage");
        }else{
            $mat = $request->request->get("matricule")[0].$request->request->get("matricule")[1].$request->request->get("matricule")[2];
                    
            //if the length is good we verify the result of the fisrt three character
            if($mat!="BPS" && $mat!="BCI" && $mat!="BCM"){
                        //when it is different we return to the CNI page
                        return $this->redirectToRoute("cniPage");
                    }else{
                       switch($mat){
                           case "BPS": 

                            $data = $this->_entity
                                    ->createQuery("SELECT cl.id as num from App\Entity\Clients cl where cl.matricule=:mat ")
                                    ->setParameter('mat',$request->request->get("matricule"))
                                    ->getResult();


                                    //fetch the id 
                                    foreach($data as $d){
                                        $id = $d["num"];
                                    }

                            //get the information about the client with the query 
                            $Nom_complet = $this->SalarieRepository->findoneBy([
                                'idClient' => $id
                            ])->getNom() ." ".  $this->SalarieRepository->findoneBy([
                                'idClient' => $id
                            ])->getPrenom();
                                    
                            $ses = new Session();

                                //set the name for the name of the client 
                            $ses->set("nomClient",$Nom_complet);


                            //set the session for the id of the client
                            $ses->set("idClient",$id);

                            //redirection 
                            return $this->redirectToRoute("pageInserCompte");

                           break;
                       }
                    }
        }
    }

    //========================the function to insert all the account======================

    public function insertCompte(Request $request ){
        var_dump($request->request);
    }







































}

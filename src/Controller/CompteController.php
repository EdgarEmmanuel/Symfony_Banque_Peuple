<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\CompteBloque;

use App\Entity\ClientSalarie;
use App\Entity\Comptes;
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


    private  function insertInCompte($idEmp,$idAg,$idClient,$dateOuv,$cleRib,$numAcc){
        $compte = new Comptes();

        $compte->setIdAgence($idAg);

        $compte->setIdClient($idClient);

        $compte->setIdRespoCompte($idEmp);

        $compte->setDateOuverture($dateOuv);

        $compte->setCleRib($cleRib);

        $compte->setNumCompte($numAcc);

        $this->_entity->persist($compte);

        $this->_entity->flush();

        return $compte;
    }

    public  function insertBloque($idEmp,$idAg,$idClient,$dateOuv,$cleRib,$numAcc,$solde,$dateDebloc){
        $bloque = new CompteBloque();

        $bloque->setIdCompte($this->insertInCompte($idEmp,$idAg,$idClient,$dateOuv,$cleRib,$numAcc));

        $bloque->setSolde($solde);

        $bloque->setDateDeblocage($dateDebloc);


        $this->_entity->persist($bloque);
        $this->_entity->flush();

        return $bloque->getId();
    }


    public function insertEpargne($idEmp,$idAg,$idClient,$dateOuv,$cleRib,$numAcc,$solde,$dateDebloc){
        
    }


    private function getNumCompte($choix){
        switch($choix){
            case "E": 
                $num = $this->_entity
                ->createQuery("SELECT count(c.id) as numero from App\Entity\Comptes c where substring(c.num_compte,1,2)='CE' ")
                ->getResult();

                foreach($num as $n){
                    $numero = "CE".((int)$n["numero"] +1);
                }
            break;
            case "B": 
                $num = $this->_entity
                ->createQuery("SELECT count(c.id) as numero from App\Entity\Comptes c where substring(c.num_compte,1,2)='CE' ")
                ->getResult();
                
                foreach($num as $n){
                    $numero = "CB".((int)$n["numero"] +1);
                }
            break;
            case "C": 
                $num = $this->_entity
                ->createQuery("SELECT count(c.id) as numero from App\Entity\Comptes c where substring(c.num_compte,1,2)='CC' ")
                ->getResult();
                foreach($num as $n){
                    $numero = "CC".((int)$n["numero"] +1);
                }
            break;
        }
        return $numero;
    }

    public function insertCompte(Request $request ){
        var_dump($request->request);

        die();

        $ses = new Session();
        
        //get id of the responsable of the account
        $idEmp=$ses->get("idEmploye");

        //get the id of the agence 
        $idAg=$ses->get("idAgence");

        //get the id of the client 
        $idClient = $ses->get("idClient");


        $dateOuv = $request->request->get("dateOuvert");

        $cleRib = $request->request->get("cle_rib");


        $solde = $request->request->get("montant");

        $dateDebloc = $request->request->get("dateDebloc");


        switch($request->reguest->get("typeCompte")){
            case "Bloque": 
                //set the numero of the account 
                $numAcc = $this->getNumCompte("B");
                
                //insert in the account bloque 
                $id=$this->insertBloque($idEmp,$idAg,$idClient,$dateOuv,$cleRib,$numAcc,$solde,$dateDebloc);
            break;

            case "Epargne": 
                //set the numero of the account 
                $numAcc = $this->getNumCompte("B");

                $id=1;
            break;

            case "Courant": 
                //set the numero of the account 
                $numAcc = $this->getNumCompte("C");

                $id=2;
            break;
        }

        if($id!=0){
            return $this->redirectToRoute("cniPage");
        }

       
    }







































}

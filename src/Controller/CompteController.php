<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\CompteBloque;
use App\Entity\CompteCourant;

use App\Entity\Agences;
use App\Entity\ClientSalarie;
use App\Entity\ClientMoral;
use App\Entity\Clients;
use App\Entity\ClientIndependant;
use App\Entity\Comptes;
use App\Entity\ResponsableCompte;
use App\Entity\CompteEpargne;
use Symfony\Component\HttpFoundation\Session\Session;

class CompteController extends AbstractController
{
    private $_entity;
    private $SalarieRepository;
    private $ClientM;
    private $ClientI;
    private $agence;
    private $clients;
    private $respo;

    public function __construct(EntityManagerInterface $entity){
        $this->_entity=$entity;
        $this->SalarieRepository = $this->_entity->getRepository(ClientSalarie::class);
        $this->ClientM = $this->_entity->getRepository(ClientMoral::class);
        $this->ClientI = $this->_entity->getRepository(ClientIndependant::class);
        $this->agence = $this->_entity->getRepository(Agences::class);
        $this->clients = $this->_entity->getRepository(Clients::class);
        $this->respo = $this->_entity->getRepository(ResponsableCompte::class);
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
                           case "BCI": 
                                    $data = $this->_entity
                                    ->createQuery("SELECT cl.id as num from App\Entity\Clients cl where cl.matricule=:mat ")
                                    ->setParameter('mat',$request->request->get("matricule"))
                                    ->getResult();


                                    //fetch the id
                                    foreach($data as $d){
                                        $id = $d["num"];
                                    }

                                    //get the information about the client with the query 
                                    $Nom_complet = $this->ClientI->findoneBy([
                                        'idClient' => $id
                                    ])->getNom() ." ".  $this->ClientI->findoneBy([
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

                           case "BCM":
                                $data = $this->_entity
                                ->createQuery("SELECT cl.id as num from App\Entity\Clients cl where cl.matricule=:mat ")
                                ->setParameter('mat',$request->request->get("matricule"))
                                ->getResult();


                                //fetch the id
                                foreach($data as $d){
                                    $id = $d["num"];
                                }

                                //get the information about the client with the query 
                                $Nom_complet = $this->ClientM->findoneBy([
                                    'idClient' => $id
                                ])->getNomEntreprise();
                                        
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

   

    //======================== the function to insert all the account ======================


    private  function insertInCompte($idEmp,$idAg,$idClient,$dateOuv,$cleRib,$numAcc){
        $compte = new Comptes();

        $compte->setIdAgence($this->agence->find($idAg));

        
        $compte->setIdClient($this->clients->find($idClient));


        $compte->setIdRespoCompte($this->respo->find($idEmp));

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


    public function insertCourant($idEmp,$idAg,$idClient,$dateOuv,$cleRib,$numAcc,
    $solde,$raison,$nomEnter,$adresseEnt){
        $courant = new CompteCourant();

        $courant->setIdCompte($this->insertInCompte($idEmp,$idAg,$idClient,$dateOuv,$cleRib,$numAcc));

        $courant->setAdresseEmployeur($adresseEnt);

        $courant->setNomEntreprise($nomEnter);

        $courant->setRaisonSocial($raison);

        $courant->setSolde($solde);

        $this->_entity->persist($courant);
        $this->_entity->flush();

        return $courant->getId();
    }


    public function InsertEpargne($idEmp,$idAg,$idClient,$dateOuv,$cleRib,$numAcc,
    $solde){
        $Epargne = new CompteEpargne();

        $Epargne->setCompteId($this->insertInCompte($idEmp,$idAg,$idClient,$dateOuv,$cleRib,$numAcc));

        $Epargne->setSolde($solde);

        $this->_entity->persist($Epargne);
        $this->_entity->flush();

        return $Epargne->getId();
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

        // var_dump($request->request);
        // die;

        $id=0;

        //fetch the data 
        $idAg=$request->request->get("idAgence");

        $idClient=(int)$request->request->get("idClient");

        $idEmp=$request->request->get("idEmp");

        $dateOuv = $request->request->get("dateOuvert");

        $cleRib = $request->request->get("cle_rib");

        $solde = $request->request->get("montant");


        switch($request->request->get("typeCompte")){
            case "Bloque": 
                //set the numero of the account 
                $numAcc = $this->getNumCompte("B");

                //fetch the data specific for Locked Account

                $dateDebloc = $request->request->get("dateDebloc");

                //insert in the account bloque 
                $id=$this->insertBloque($idEmp,$idAg,$idClient,$dateOuv,$cleRib,$numAcc,$solde,$dateDebloc);
            break;

            case "Epargne": 
                //set the numero of the account
                $numAcc = $this->getNumCompte("E");

                //insert in the Epargne account
                $id=$this->InsertEpargne($idEmp,$idAg,$idClient,$dateOuv,$cleRib,$numAcc,$solde);
            break;

            case "Courant": 
                //set the numero of the account 
                $numAcc = $this->getNumCompte("C");

                //fetch the specific field for epargne account
                $raison=$request->request->get("raison");
                $nomEnter=$request->request->get("Name_entreprise");
                $adresseEnt=$request->request->get("adresse_Entreprise");
               
                //insert into the courant account 
                $id=$this->insertCourant($idEmp,$idAg,$idClient,$dateOuv,$cleRib,$numAcc,$solde,$raison,$nomEnter,$adresseEnt);               
            break;
        }

        if($id!=0){
            return $this->redirectToRoute("cniPage");
        }else{
            return $this->redirectToRoute("cniPage");
        }

        return $this->redirectToRoute("cniPage");
    }







































}

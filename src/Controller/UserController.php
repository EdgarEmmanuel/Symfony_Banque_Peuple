<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Component\HttpFoundation\Session\Session;

use App\Entity\ResponsableCompte;

use App\Entity\Employes;

use App\Entity\Agences;

use App\Entity\Administrateur;

use Doctrine\ORM\EntityManagerInterface;

class UserController extends AbstractController
{
    private $em;
    private $session;
    private $ResponsableCompteRepository;
    private $employes;
    private $adminEntity;
    private $agenceEntity;

    public function __construct(EntityManagerInterface $entity,SessionInterface $session){
        $this->em = $entity;
        $this->ResponsableCompteRepository = $this->em->getRepository(ResponsableCompte::class);
        $this->employes = $this->em->getRepository(Employes::class);
        $this->agenceEntity = $this->em->getRepository(Agences::class);
        $this->adminEntity = $this->em->getRepository(Administrateur::class);
        $this->session=$session;
    }

    
    public function handleUser(Request $req)
    {  

        switch($req->request->get("type")){
            case "responsable": 
                        //get the login
                        $login = $req->request->get("login");

                        //get the password
                        $password = $req->request->get("password");

                        $data = $this->ResponsableCompteRepository->findOneBy([
                            'login' => $login,
                            'password' => $password
                        ]);

                        $emp = new ResponsableCompte();

                        if($data==null){
                            return $this->redirectToRoute('index');
                        }else{
                                //get the  matricule
                                $matricule = $this->ResponsableCompteRepository->findOneBy([
                                    'login' => $login,
                                    'password' => $password
                                ])->getMatricule();

                                //get the id of the employe 
                                $id_employe = $this->ResponsableCompteRepository->findOneBy([
                                    'login' => $login,
                                    'password' => $password
                                ])->getIdEmploye();
                                
                                //set the complete name of the employe by  his ID
                                $nomComplet =$this->employes->findOneBy([
                                    'id' => $id_employe
                                ])->getNom() ." ".$this->employes->findOneBy([
                                    'id' => $id_employe
                                ])->getPrenom();


                                $id_agences =$this->agenceEntity->findOneBy([
                                    'id' =>  $this->employes->findOneBy([
                                        'id' => $id_employe
                                    ])->getIdAgence()
                                ])->getId();

                                $nom_agence = $this->agenceEntity->findOneBy([
                                    'id' =>  $this->employes->findOneBy([
                                        'id' => $id_employe
                                    ])->getIdAgence()
                                ])->getAgence();

                                $session = new Session(); 
                                $session->start();

                                //set the session for the respo 
                                $session->set("idEmploye",$id_employe);

                                //set the session for the name of the agence
                                $session->set("nomAgence",$nom_agence);
                                
                                //set the session for the id of the agence 
                                $session->set("idAgence",$id_agences);

                                //session for the matricule 
                                $session->set("matricule",$matricule);

                                //session for the name of the employee
                                $session->set("nomComplet",$nomComplet);

                                return $this->redirectToRoute("cniPage");
                        }
            break;

            case "administrateur": 
                 //get the login
                 $login = $req->request->get("login");

                 //get the password
                 $password = $req->request->get("password");

               $data = $this->adminEntity->findOneBy([
                   'login' => $login ,
                   'password' => $password
               ]);

               if($data==null){
                   return $this->redirectToRoute("index");
               }else{
                   $employe_administrateur = $this->employes->findOneBy([
                        'id' => $data = $this->adminEntity->findOneBy([
                            'login' => $login ,
                            'password' => $password
                        ])->getIdEmp()
                   ])->getPrenom();

                   var_dump($employe_administrateur);
                   die;
                    
               }
            break;

            case "caissiere": 
                echo "caissiere";
            break;
        }
        
    }

}

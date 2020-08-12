<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Entity\ResponsableCompte;

use Doctrine\ORM\EntityManagerInterface;

class UserController extends AbstractController
{
    private $em;
    private $session;
    private $ResponsableCompteRepository;

    public function __construct(EntityManagerInterface $entity,SessionInterface $session){
        $this->em = $entity;
        $this->ResponsableCompteRepository = $this->em->getRepository(ResponsableCompte::class);

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

                        $data['data'] = $this->ResponsableCompteRepository->findOneBy([
                            'login' => $login,
                            'password' => $password
                        ]);

                        $emp = new ResponsableCompte();

                        if($data==null){
                        return $this->redirectToRoute('index');
                        }else{
                            
                            var_dump($data['data']);
                         
                            die();
                        }
            break;

            case "administrateur": 
                echo "responsable";
            break;

            case "caissiere": 
                echo "caissiere";
            break;
        }
        
    }

}

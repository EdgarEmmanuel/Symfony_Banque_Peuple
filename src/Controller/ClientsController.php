<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;

use App\Entity\Clients;

use App\Entity\ClientSalarie;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Component\HttpFoundation\Session\Session;

use Doctrine\ORM\EntityManagerInterface;

class ClientsController extends AbstractController
{
    private $f_entity;
    private $client;
    private $client_salarie;
  
   
    public function __construct(EntityManagerInterface $entity){
        $this->f_entity = $entity;
        $this->client = $this->f_entity->getRepository(Clients::class);
        $this->client_salarie = $this->f_entity->getRepository(ClientSalarie::class);
        
    }

    public function insertFirstINClient($mat,$mail,$tel){
        //insert in the client
        $client = new Clients();

        $client->setTelephone($tel);

        $client->setEmail($mail);

        $client->setMatricule($mat);

        $this->f_entity->persist($client);
        $this->f_entity->flush();

        $id = $client->getId();

        return $client;
    }
   
    public function insertCSalarie(Request $request)
    {
        //insert in client salarie
        $CSalarie = new ClientSalarie();

        $CSalarie->setIdClient($this->insertFirstINClient($request->request->get("matricule"),$request->request->get("email"),$request->request->get("telephone")));

        $CSalarie->setCni($request->request->get("cni"));
        $CSalarie->setNom($request->request->get("nom"));
        $CSalarie->setPrenom($request->request->get("prenom"));
        $CSalarie->setProfession($request->request->get("profession"));
        $CSalarie->setNomEntreprise($request->request->get("nom_Entreprise"));
        $CSalarie->setAdresseEntreprise($request->request->get("adresseforCl"));

        //insertion
        $this->f_entity->persist($CSalarie);
        $this->f_entity->flush();


        $res = $CSalarie->getId();
        if( $res!=0){
            return $this->redirectToRoute("cniPage");
        }

    }
}

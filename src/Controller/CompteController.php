<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CompteController extends AbstractController
{
   
    public function verifyMatricule(Request $request)
    {
        if(strlen($request->request->get("matricule")) < 3){
            return $this->redirectToRoute("cniPage");
        }else{
            $mat = $request->request->get("matricule")[0].$request->request->get("matricule")[1].$request->request->get("matricule")[2];
                    if($mat!="BPS" && $mat!="BCI" && $mat!="BCM"){
                        //when it is different we return to the CNI page
                        return $this->redirectToRoute("cniPage");
                    }else{
                       switch($mat){
                           case "BPS": 
                           break;
                       }
                    }
        }
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PagesController extends AbstractController
{
    
    public function getPageCni()
    {
        return $this->render('admin/cni.html.twig');
    }

    public function getPageInsertCS(){
        //the page for insert client salarie

        return $this->render("clients/cSalarie.html.twig");
    }
}

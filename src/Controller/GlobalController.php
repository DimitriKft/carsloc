<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GlobalController extends AbstractController
{
    /**
     * @Route("/", name="acceuil")
     */
    public function index()
    {
        return $this->render('global/acceuil.html.twig');
    }
}

<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class GlobalController extends AbstractController
{
    /**
     * @Route("/", name="acceuil")
     */
    public function index()
    {
        return $this->render('global/acceuil.html.twig');
    }

     /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription(Request $request, EntityManagerInterface $entitymanager, UserPasswordEncoderInterface $encoder)
    {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(InscriptionType::class, $utilisateur);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $passwordCrypte = $encoder->encodePassword($utilisateur, $utilisateur->getPassword());
            $utilisateur->setPassword($passwordCrypte);
            $utilisateur->setRoles("ROLE_USER");
            $entitymanager->persist($utilisateur);
            $entitymanager->flush();
            $this->addFlash('success', "Vous étes correctement enregistré");
            return $this->redirectToRoute('acceuil');
        }
        return $this->render('global/inscription.html.twig', [
            "form" => $form->createView()
        ]);
    }
}

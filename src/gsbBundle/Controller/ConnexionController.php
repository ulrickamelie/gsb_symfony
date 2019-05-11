<?php

namespace gsbBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use gsbBundle\Entity\Visiteur;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ConnexionController extends Controller{
    public function connexionAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager()->getRepository('gsbBundle:Visiteur');
        //$visiteur = new VisiteurClass();
        $form = $this->createFormBuilder()
                ->add('login', TextType::class)
                ->add('motDePasse',PasswordType::class)
                ->add('Valider',SubmitType::class)
                ->getForm();
        
        $form->handleRequest($request);
     
        
        if($form->isSubmitted()){
            $session = $request->getSession();
        $session->get('maVariable');
            $data = $form->getData();
            $visiteur = $em->findOneBy(array('login'=>$data['login'],
                'mdp'=>$data['motDePasse']));
            if($visiteur != null){
                //$session->set('maVariable', 'amelie');
              $session->set('maVariable', $visiteur->getId());
              
                return $this->render('@gsb/result.html.twig');          
            }
        
        }
      
          return $this->render('@gsb/connexion.html.twig',
            array('form'=>$form->createView()));
    }
    
     
}

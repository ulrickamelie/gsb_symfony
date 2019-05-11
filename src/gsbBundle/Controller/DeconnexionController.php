<?php

namespace gsbBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DeconnexionController extends Controller{
    public function deconnexionAction()
    {
        //$session = $this->container->get('session');
        //$session->invalidate();
        //return $this->render('@gsb/connexion.html.twig');
        return $this->redirectToRoute('gsb_connexion');
    }
}

<?php

namespace gsbBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SaisieController extends Controller{
    public function saisieAction()
    {
        return $this->render('@gsb/saisie.html.twig');
    }
}

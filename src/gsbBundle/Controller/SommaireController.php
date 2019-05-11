<?php

namespace gsbBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SommaireController extends Controller{
    public function sommaireAction()
    {
        return $this->render('@gsb/sommaire.html.twig');
    }
}

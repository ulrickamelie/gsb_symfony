<?php

namespace gsbBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use gsbBundle\Entity\LigneFraisHorsForfait;
use gsbBundle\Entity\LigneFraisForfait;
use gsbBundle\Entity\FicheFrais;
use gsbBundle\Entity\Etat;
use gsbBundle\Entity\Visiteur;
use gsbBundle\Entity\FraisForfait;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use gsbBundle\Form\LigneFraisForfaitType;
use gsbBundle\Form\LigneFraisHorsForfaitType;
use gsbBundle\Form\FicheFraisType;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@gsb/Default/index.html.twig');
    }
    
    public function consulterAction(Request $request)
    {
        $lesfiches = $this->getDoctrine()->getRepository('gsbBundle:FicheFrais');
        $session = $request->getSession();
        $test = $session->get('maVariable');
        $repository = $this->getDoctrine()->getManager();
        $repository2 = $repository->getRepository("gsbBundle:FicheFrais")
                ->findBy(array('visiteur'=>$test));
        return $this->render('@gsb/vue.html.twig', array('fiches'=>$repository2));
    }
    
    public function consulter2Action(Request $request )      
    {  
        $session = $request->getSession();
        $test = $session->get('maVariable');
        $maValeur = $request->request->get("choix");
        $annee = substr($maValeur, 2);
        $mois = substr($maValeur, 0,1);
        $Id = substr($maValeur ,10,12);
       
        $repository = $this->getDoctrine()->getManager();
        
        $repository2 = $repository->getRepository("gsbBundle:FicheFrais")
                ->findBy(array('visiteur'=>$test,'mois' =>$mois,'annee'=>$annee, 'id'=>$Id));
        
        $lesFraisForfait= $this->getDoctrine()->getRepository('gsbBundle:LigneFraisForfait')
                ->findBy(array('idfichefrais'=>$Id));  
      
 
        $lesHForfait = $this->getDoctrine()->getRepository('gsbBundle:LigneFraisHorsForfait')
                ->findBy(array('idfichefrais'=>$Id));

        
        return $this->render('@gsb/consultation.html.twig',array('lesfiches'=>$repository2,'lesFraisForfait'=>$lesFraisForfait,'lesHForfait'=>$lesHForfait));
    }
    
    public function createFormLigneFraisForfaitAction(Request $request)
    {
        $Forfait = new LigneFraisForfait();
        $form1 = $this->createForm(\gsbBundle\Form\LigneFraisForfaitType::class, $Forfait);
     
        $repFiche = $this->getDoctrine()->getRepository('gsbBundle:FicheFrais');
        $date = new \DateTime();
        
        
        $fichefrais = new FicheFrais(); 
        $fraisforfait = $this->getDoctrine()->getRepository('gsbBundle:FicheFrais');
        
        $HForfait = new LigneFraisHorsForfait();
        $form = $this->createForm(\gsbBundle\Form\LigneFraisHorsForfaitType::class, $HForfait);
        
        $repEtat = $this->getDoctrine()->getRepository('gsbBundle:Etat');
        $repVisiteur= $this->getDoctrine()->getRepository('gsbBundle:Visiteur');
        $repFraisForfait = $this->getDoctrine()->getRepository('gsbBundle:FraisForfait');
        
        
        $form->handleRequest($request);
        $form1->handleRequest($request);
        
        $session = $request->getSession();
        $test = $session->get('maVariable');
        $IdVisiteur = $repVisiteur->findOneBy(array('id'=>$test));
        $em = $this->getDoctrine()->getManager();
        
        $ficheExistante = $repFiche->findOneBy(array('mois'=>$date->format('m'),
                                                    'annee'=>$date->format('Y'),
                                                    'visiteur'=>$IdVisiteur));
       
        $moisPrecedent = $date->format('m')-1;
        $ficheMoisPrecedent = $repFiche->findOneBy(array('mois'=>$moisPrecedent, 'annee'=>$date->format('Y'), 'visiteur'=>$IdVisiteur));
        
        if($form1->isSubmitted()){
            if($ficheExistante != null){
                if($ficheMoisPrecedent != null){
                $ficheMoisPrecedent->setEtat($repEtat->findOneById(1));
                $em->persist($ficheMoisPrecedent);
                $em->flush();
                return new Response('Fiche mois précédent clôturée');
                }
                else{
                    return new Response('Fiche Existante');
                }
                
            }else{
                if($ficheMoisPrecedent != null){
                $fichefrais->setMois($date->format('m'));
                $fichefrais->setAnnee($date->format('Y'));
                $fichefrais->setEtat($repEtat->findOneById(2));
                $Forfait->setIdfichefrais($fichefrais);
                $Forfait->setFraisforfait($repFraisForfait->findOneById(1));
                $fichefrais->setVisiteur($IdVisiteur);  
                $ficheMoisPrecedent->setEtat($repEtat->findOneById(1));
                $em->persist($ficheMoisPrecedent);
                $em->persist($Forfait);
                $em->persist($fichefrais);     
                $em->flush();
                return new Response('Forfait ajouté et fiche mois précédent clôturée');
                }else{
                    $fichefrais->setMois($date->format('m'));
                $fichefrais->setAnnee($date->format('Y'));
                $fichefrais->setEtat($repEtat->findOneById(2));
                $Forfait->setIdfichefrais($fichefrais);
                $Forfait->setFraisforfait($repFraisForfait->findOneById(1));
                $fichefrais->setVisiteur($IdVisiteur); 
                $em->persist($Forfait);
                $em->persist($fichefrais);     
                $em->flush();
                return new Response('Forfait ajouté');
                }
            }
        }
        else if($form->isSubmitted() && $ficheExistante != null) {
            $HForfait->setIdfichefrais($ficheExistante);
            $em->persist($HForfait);
            $em->flush();
            return new Response('Hors Forfait ajouté');
        }
        $formView2 = $form1->createView();
        $formView = $form->createView();
        return $this->render('@gsb/saisie.html.twig', array('form'=>$formView, 'form1'=>$formView2));
    }
    
    public function annulerFraisForfaitAction(LigneFraisForfait $Forfait)
    {
        $id= $Forfait->getIdfichefrais();
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($Forfait);
        $em->flush();
                
        return new Response('Ligne Frais Forfait annulée');
    }
    
    public function annulerFraisHorsForfaitAction(LigneFraisHorsForfait $HForfait)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($HForfait);
        $em->flush();
        
        return new Response('Ligne Frais Hors Forfait annulée');
    }
    
    public function annulerFicheAction(FicheFrais $fiche)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($fiche);
        $em->flush();
        
        return new Response('Fiche supprimé');
    }
    
    public function modifierFraisForfaitAction(Request $request, LigneFraisForfait $Forfait)
    {        
        $form = $this->createForm(\gsbBundle\Form\LigneFraisForfaitType::class, $Forfait);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return new Response('Ligne Frais Forfait modifié');
        }
        $formView = $form->createView();
        return $this->render('@gsb/formulaireForfait.html.twig',
                array('form'=>$formView));
        
    }
    
    public function modifierFraisHorsForfaitAction(Request $request, LigneFraisHorsForfait $HForfait)
    {        
        $form = $this->createForm(\gsbBundle\Form\LigneFraisHorsForfaitType::class, $HForfait);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return new Response('Ligne Frais Hors Forfait modifié');
        }
        $formView = $form->createView();
        return $this->render('@gsb/formulaireHorsForfait.html.twig',
                array('form'=>$formView));
        
    }
    
    public function formulaireFraisHorsForfaitAction(Request $request)
    {
        $FraisHorsForfait = new LigneFraisHorsForfait();
        $form = $this->createForm(\gsbBundle\Form\LigneFraisHorsForfaitType::class, $FraisHorsForfait);
        
                
        $form->handleRequest($request);
        
        $em = $this->getDoctrine()->getManager();
        if ($form->isSubmitted()) {          
           $em->persist($FraisHorsForfait);
           $em->flush();
           return new Response('Hors forfait ajouté !');
        }
        return $this->render('@gsb/formulaire.html.twig', array('form'=>$form->createView()));
    }
    
    public function formulaireFraisForfaitAction(Request $request)
    {
        $FraisForfait = new LigneFraisForfait();
        $form = $this->createForm(\gsbBundle\Form\LigneFraisForfaitType::class, $FraisForfait);
        
                
        $form->handleRequest($request);
        
        $em = $this->getDoctrine()->getManager();
        if ($form->isSubmitted()) {          
           $em->persist($FraisForfait);
           $em->flush();
           return new Response('Frais forfait ajouté !');
        }
        $formView = $form->createView();
        return $this->render('@gsb/formulaire.html.twig', array('form'=>$formView));
    }
    
    public function formulaireAction()
    {
        return $this->render('@gsb/formulaire.html.twig');
    }
}

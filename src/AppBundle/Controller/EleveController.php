<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Eleve;
use AppBundle\Form\EleveType;

class EleveController extends Controller
{
    
	
	/**
     * @Route("/eleve-creation", name="EleveCreation")
     */
	public function creationAction(Request $request){
		
	    $eleve = new Eleve();
	  
		$form = $this->get('form.factory')->createBuilder(new EleveType(), $eleve)->getForm();
		 
		$form->handleRequest($request);
	
	    $em = $this->getDoctrine()->getManager();
	    $listeDesNiveaux = $em->getRepository('AppBundle:Niveau')->findAll();
		
	    // validation du formulaire
	    if ($form->isValid()) {
	    	$maintenant = new \DateTime();
		    foreach($eleve->getChoix() as $index => $choix){
		    	$choix->setDateEnregistrement($maintenant)
		    	->setNumero($index + 1)
		    	->setEleve($eleve);
		    	
		    }
		    // crée un code de modification si pas déjà créé.
		    if(! $eleve->getCodeModification()){
		    	
		    	$code = $this->get('codemodif')->genCode();		    	
		    	$eleve->setCodeModification($code);
		    }
		    $em->persist($eleve);
		    $em->flush();
		
		    $request->getSession()->getFlashBag()->add('notice', 'eleve.enregistre');
		// place l'élève créé en session pour passer à l'étape des choix
		    $request->getSession()->set('eleve', $eleve);
		    return $this->redirect($this->generateUrl('ActiviteListe'));	
	    }
			 
	    
	    
	    return $this->render('AppBundle:Eleve:ajout.html.twig', array(
	      'form' => $form->createView(),
	    	'listeDesNiveaux' => $listeDesNiveaux	
	    ));
	}
		
	/**
	 * @Route("/eleve-modification/{eleve}/{codeModif}", requirements={"eleve" = "\d+", "codeModif" = "[a-z0-9]{20}" }, name="EleveModification")
	 */
	public function modificationAction(Request $request, Eleve $eleve, $codeModif){
				
		
		// verification du droit de modification : controle de l'id de l'élève et du code modification 
		if($eleve->getCodeModification() == $codeModif){		
			$form = $this->get('form.factory')->createBuilder(new EleveType(), $eleve)->getForm();
				
			$form->handleRequest($request);
			
			$em = $this->getDoctrine()->getManager();
			$listeDesNiveaux = $em->getRepository('AppBundle:Niveau')->findAll();
			
			return $this->render('AppBundle:Eleve:ajout.html.twig', array(
					'form' => $form->createView(),
					'listeDesNiveaux' => $listeDesNiveaux
			));
			
		}
		else{
			$request->getSession()->getFlashBag()->add('error', 'eleve.introuvable');
			$this->redirect($this->generateUrl('EleveCreation'));
		}
		 
	}
}

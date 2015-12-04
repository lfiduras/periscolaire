<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Activite;
use AppBundle\Form\ActiviteType;
use AppBundle\Entity\Niveau;

class ActiviteController extends Controller
{

	/**
     * @Route("/activite-liste", name="ActiviteListe")
     */
	public function listeAction(Request $request){
		$em = $this->getDoctrine()->getManager();
		
		$ClasseRepo = $em->getRepository('AppBundle:Niveau');
		$toutesLesClasses = $ClasseRepo->findAll();
		return $this->render('AppBundle:Activite:liste.html.twig', array(
			'toutesLesClasses' => $toutesLesClasses,
		));
	}
	
	/**
	 * ajoute une activité
	 * 
     * @Route("/activite-ajout/{niveau}", name="ActiviteAjouter")
     */
	public function ajouterAction(Request $request, Niveau $niveau){
		$activite = new Activite();
		
		$activite->setNiveau($niveau);
		$form = $this->get('form.factory')->createBuilder(new ActiviteType(), $activite)->getForm();
		
		
		$form->handleRequest($request);
				
		if ($form->isValid()) {
		
			$em = $this->getDoctrine()->getManager();
			$em->persist($activite);
			$em->flush();
		
			$request->getSession()->getFlashBag()->add('success', 'activite.enregistre');
			return $this->redirect($this->generateUrl('ActiviteListe'));
		}
		return $this->render('AppBundle:Activite:modifier.html.twig', array(
				'form' => $form->createView(),
		));
	}
	/**
	 * modifie une activité
	 * 	 
     * @Route("/activite-modifier/{id}", requirements={"id" = "\d+"}, name="ActiviteModifier")
     */
	public function modifierAction(Request $request, $id){
		$em = $this->getDoctrine()->getManager();
		
		$activite = $em->getRepository('AppBundle:Activite')->find($id);
		
		
		$form = $this->get('form.factory')->createBuilder(new ActiviteType(), $activite)->getForm();
		
		$form->handleRequest($request);
		
		
		if ($form->isValid()) {
		
			$em = $this->getDoctrine()->getManager();
			$em->persist($activite);
			$em->flush();
		
			$request->getSession()->getFlashBag()->add('success', 'activite.enregistre');
			return $this->redirect($this->generateUrl('ActiviteListe'));
		}
		return $this->render('AppBundle:Activite:modifier.html.twig', array(
				'form' => $form->createView(),
		));
		
	}
	/**
	 * supprime une activité et retourne sur la liste des activités
	 * 
	 * @Route("/activite-supprimer/{id}", requirements={"id" = "\d+"}, name="ActiviteSupprimer")
	 */
	public function supprimerAction(Request $request, $id){
		$em = $this->getDoctrine()->getManager();
		$activite = $em->getRepository('AppBundle:Activite')->find($id);
		if (!$activite) {
			// pas trouvé
			$request->getSession()->getFlashBag()->add('error', 'activite.introuvable');			
		}
		else{
			// trouvé
			$em->remove($activite);
			$em->flush();
			$request->getSession()->getFlashBag()->add('success', 'activite.supprime');
		}		
		return $this->redirect($this->generateUrl('ActiviteListe'));				
	}
	
	/**
	 * @Route("/activite-copier/{id}", requirements={"id" = "\d+"}, name="ActiviteCopier")
	 */
	public function copierAction(Request $request, $id){
		$em = $this->getDoctrine()->getManager();
		$activiteACopier = $em->getRepository('AppBundle:Activite')->find($id);
		$activite = $activiteACopier->getCopie();
		
		$form = $this->get('form.factory')->createBuilder(new ActiviteType(), $activite)->getForm();
		
		$form->handleRequest($request);
		
		
		if ($form->isValid()) {
		
			$em = $this->getDoctrine()->getManager();
			$em->persist($activite);
			$em->flush();
		
			$request->getSession()->getFlashBag()->add('success', 'activite.enregistre');
			return $this->redirect($this->generateUrl('ActiviteListe'));
		}
		return $this->render('AppBundle:Activite:modifier.html.twig', array(
				'form' => $form->createView(),
		));
		
	}
	
	
}
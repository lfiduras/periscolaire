<?php
								
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\Activite;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;

class ActiviteType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{		
		$builder
		->add('libelle',   			'text', array('label' => 'activite.libelle'))
		->add('jour',   			 'choice', array(
					'label' => 'activite.jour',
	    			'choices' =>
				        array(	1 => 'parametrage.jour.1',
				        		2 => 'parametrage.jour.2', 
				        		3 => 'parametrage.jour.3', 
				        		4 => 'parametrage.jour.4', 
				        		5 => 'parametrage.jour.5',
				        )				        	    			
		))
		->add('nbPlaces',   		'number', array('label' => 'activite.nbplacesdispo'))	
		->add('niveau',    			'entity', array(
					'class' 		=> 'AppBundle:Niveau',
					'choice_label' 	=> 'libelle',
					'label'			=> 'niveau.titre', 
					'query_builder' => function (\Doctrine\ORM\EntityRepository $er) {
						return 	 $er->createQueryBuilder('n')
									->where('n.actif = 1')
									->orderBy('n.numeroOrdre', 'ASC');
					},
				)
		)
		->add('save',      'submit', array('label' => 'parametrage.enregistrer'))
		;
	}
	
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
				'data_class' => 'AppBundle\Entity\Activite'
		));
	}
	

	public function getName()
	{
		return 'app_bundle_activite';
	}
}				
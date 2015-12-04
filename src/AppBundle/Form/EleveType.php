<?php
								
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EleveType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		
		
		
		$builder
		->add('nom',      			'text', array('label' => 'eleve.nom'))
		->add('prenom',     		'text', array('label' => 'eleve.prenom'))
		->add('dateNaissance',   	'date', array(
					'widget' 	=> 'single_text',
					'format'	=> 'dd/MM/yy',
					'html5' 	=> false,
					'attr'		=> array('class' => 'date'),
					'label' 	=> 'eleve.dateNaissance',
			))
		->add('email', 				'text', array('label' => 'eleve.email'))
		->add('transportScolaire', 	'checkbox', array(
					'required' 	=> false, 
					'label'		=> 'eleve.transportScolaire', 
			))
		->add('niveau',    			'entity', array(
					'class' 		=> 'AppBundle:Niveau',
					'choice_label' 	=> 'libelle',
					'label'			=> 'niveau.titre', 
					'placeholder'	=> 'niveau.choisissez',
					'query_builder' => function (\Doctrine\ORM\EntityRepository $er) {
						return 	 $er->createQueryBuilder('n')
									->where('n.actif = 1')
									->orderBy('n.numeroOrdre', 'ASC');
					},
				)
		)
		->add('choix',      'collection',  array(
	        'type'         => new ChoixType(),
	        'allow_add'    => true,
	        
      	))      
    	
		->add('save',      'submit', array('label' => 'parametrage.enregistrer'))
		;
	}
	
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
				'data_class' => 'AppBundle\Entity\Eleve'
		));
	}
	

	public function getName()
	{
		return 'app_bundle_eleve';
	}
}				
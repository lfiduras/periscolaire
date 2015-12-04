<?php
								
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\Activite;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;
use AppBundle\Entity\ActiviteRepository;

class ChoixType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{						
		$builder
		->add('numero', 'hidden')
		->add('activite', 'entity', array(
					'class' 		=> 'AppBundle:Activite',					
					'label'			=> ' ',
					'choice_label' => 'libelle',
					
				))
		
		;
	}
	
	
	
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
				'data_class' => 'AppBundle\Entity\Choix'
		));
	}
	

	public function getName()
	{
		return 'app_bundle_activite';
	}
}				
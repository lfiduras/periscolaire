<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContextInterface;

/**
 * Eleve
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\EleveRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Eleve
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     * @Assert\Length(min=2)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     * @Assert\Length(min=2)
     */
    private $prenom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateNaissance", type="date")
     * @Assert\DateTime()
     */
    private $dateNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\Email(
     *     message = "eleve.email",
     *     checkMX = true
     * )
     */
    private $email;


    /**
     * @var boolean
     *
     * @ORM\Column(name="transportScolaire", type="boolean")
     */
    private $transportScolaire;

    /**
     * @Assert\Choice({0, 1, 2})     
     * @ORM\Column(name="boursier", type="integer", options={"default" = 0}))
     */
    private $boursier = 0;
    
    /**
     * @var string
     *
     * @ORM\Column(name="codeModification", type="string", length=20, unique=true, nullable=true)
     */
    private $codeModification;

	/**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Niveau", inversedBy="eleves")
     * @ORM\JoinColumn(nullable=true)
     * 
     */
	private $niveau;
	
	
	/**
	 * @ORM\OneToMany(targetEntity="Choix", mappedBy="eleve" ,cascade={"persist"})	 
	 */
	private $choix;
	
	
	/**
	 * @Assert\Callback
	 */
	public function isChoixValid(ExecutionContextInterface $context)
	{
		// valide si les choix ne sont pas le même jour
		$aJours = array();
		foreach($this->choix as $c){
			$aJours[] = $c->getActivite()->getJour();
		}
		$aJours = array_unique($aJours);
		
		if( count($aJours) != count($this->choix)){
			$context
			->buildViolation('choix.joursidentiques') // message
			->atPath('choix')                                                   // attribut de l'objet qui est violé
			->addViolation() // ceci déclenche l'erreur, ne l'oubliez pas
			;
			
		}
		
	}

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Eleve
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Eleve
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return Eleve
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Eleve
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    

    /**
     * Set transportScolaire
     *
     * @param boolean $transportScolaire
     *
     * @return Eleve
     */
    public function setTransportScolaire($transportScolaire)
    {
        $this->transportScolaire = $transportScolaire;

        return $this;
    }

    /**
     * Get transportScolaire
     *
     * @return boolean
     */
    public function getTransportScolaire()
    {
        return $this->transportScolaire;
    }

    /**
     * Set codeModification
     *
     * @param string $codeModification
     *
     * @return Eleve
     */
    public function setCodeModification($codeModification)
    {
        $this->codeModification = $codeModification;

        return $this;
    }

    /**
     * Get codeModification
     *
     * @return string
     */
    public function getCodeModification()
    {
        return $this->codeModification;
    }
	
	/**
	 * Get niveau elève
	 * 
	 * @return Niveau
	 */
	public function getNiveau(){
		return $this->niveau;		
	}
	
	/**
	 * Set niveau elève
	 * 
	 * @return Eleve
	 */
	public function setNiveau(Niveau $niveau){
		$this->niveau = $niveau;
		return $this;
	}
	public function getChoix() {
		return $this->choix;
	}
	public function setChoix($choix) {
		$this->choix = $choix;
		return $this;
	}
	public function getBoursier() {
		return $this->boursier;
	}
	public function setBoursier($boursier) {
		$this->boursier = $boursier;
		return $this;
	}
		
	
	
	
}


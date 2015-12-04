<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Activite
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ActiviteRepository")
 */
class Activite
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
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbPlaces", type="integer")
     */
    private $nbPlaces;


	/**
     * @ORM\ManyToOne(targetEntity="Niveau" , inversedBy="activites")
     * @ORM\JoinColumn(nullable=true)
     */
	private $niveau;
	
	/**
     * @ORM\OneToOne(targetEntity="Activite")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
	private $activiteParente;
	/**
	 * @ORM\Column(name="jour", type="integer")
	 * @var int
	 */
	private $jour;
	
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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Activite
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set nbPlaces
     *
     * @param integer $nbPlaces
     *
     * @return Activite
     */
    public function setNbPlaces($nbPlaces)
    {
        $this->nbPlaces = $nbPlaces;

        return $this;
    }

    /**
     * Get nbPlaces
     *
     * @return integer
     */
    public function getNbPlaces()
    {
        return $this->nbPlaces;
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
	public function getJour() {
		return $this->jour;
	}
	public function setJour($jour) {
		$this->jour = $jour;
		return $this;
	}
	/**
	 * retourne une copie de l'activité, sans l'id
	 * @return Activite
	 */
	public function getCopie(){
		$activite = new Activite();
		$activite->setJour($this->getJour());
		$activite->setLibelle($this->getLibelle());
		$activite->setNbPlaces($this->getNbPlaces());
		$activite->setNiveau($this->getNiveau());
		return $activite;
	}
	/**
	 * @return Activite 
	 */
	public function getActiviteParente() {
		return $this->activiteParente;
	}
	
	public function setActiviteParente(Activite $activiteParente) {
		$this->activiteParente = $activiteParente;
		return $this;
	}
	
	
	
	
}


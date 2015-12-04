<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Niveau
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Niveau
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
     * @var boolean
     *
     * @ORM\Column(name="actif", type="boolean", options={"default":1})
     */
    private $actif;
	
	/**
     * @var integer
     *
     * @ORM\Column(name="numeroOrdre", type="integer")
     */
    private $numeroOrdre;
	
	
	/**
	 * @ORM\OneToMany(targetEntity="Activite", mappedBy="niveau")
	 * @ORM\OrderBy({"jour" = "ASC", "libelle" = "ASC"})
	 *
	 */
	private $activites;
	
	/**
	 * @ORM\OneToMany(targetEntity="Eleve", mappedBy="niveau")
	 *
	 */
	private $eleves;
	
	
	public function __construct(){
		$this->activites = new ArrayCollection();
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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Niveau
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
	
	public function getActif(){
		return $this->actif;
	}
	
	public function isActif(){
		return  $this->getActif();
	}
	
	public function setActif($actif){
		$this->actif = $actif;
	}
	
	public function getNumeroOrdre(){
		return $this->numeroOrdre;
	}
	public function getActivites() {
		return $this->activites;
	}
	public function setActivites($activites) {
		$this->activites = $activites;
		return $this;
	}
	
}


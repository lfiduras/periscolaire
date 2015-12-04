<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Choix
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ChoixRepository")
 */
class Choix
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateEnregistrement", type="datetime")
     */
    private $dateEnregistrement;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero", type="integer")
     */
    private $numero;

	/**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Eleve", cascade={"persist"}, inversedBy="choix")
     */
    private $eleve;
	
	/**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Activite", cascade={"persist"})
     */
    private $activite;

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
     * Set dateEnregistrement
     *
     * @param \DateTime $dateEnregistrement
     *
     * @return Choix
     */
    public function setDateEnregistrement($dateEnregistrement)
    {
        $this->dateEnregistrement = $dateEnregistrement;

        return $this;
    }

    /**
     * Get dateEnregistrement
     *
     * @return \DateTime
     */
    public function getDateEnregistrement()
    {
        return $this->dateEnregistrement;
    }

    /**
     * Set numero
     *
     * @param integer $numero
     *
     * @return Choix
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return integer
     */
    public function getNumero()
    {
        return $this->numero;
    }
	
	/**
	 *
	 * get Eleve
	 * @return Eleve
	 */
	public function getEleve(){
		return $this->eleve;
	}
	
	
	/**
	 *
	 * get Activité
	 * @return Activite
	 */
	public function getActivite(){
		return $this->activite;
	}
	
	
	/**
	 *
	 * Set Eleve
	 * @return Choix
	 */
	public function setEleve(Eleve $eleve){
		$this->eleve = $eleve;
		return $this;
	}
	
	/**
	 *
	 * Set Activite
	 * @return Choix
	 */
	public function setActivite(Activite $activite){
		$this->activite = $activite;
		return $this;
	}
}


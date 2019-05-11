<?php

namespace gsbBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LigneFraisHorsForfait
 *
 * @ORM\Table(name="LigneFraisHorsForfait")
 * @ORM\Entity(repositoryClass="gsbBundle\Repository\LigneFraisHorsForfaitRepository")
 */
class LigneFraisHorsForfait {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255, nullable=true)
     */
    private $libelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="montant", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $montant;
    
    /**
     * @ORM\ManyToOne(targetEntity="\gsbBundle\Entity\FicheFrais", cascade={"persist"})
     * @ORM\JoinColumn(name="idfichefrais", referencedColumnName="id")
     */
    private $idfichefrais;
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return LigneFraisHorsForfait
     */
    public function setLibelle($libelle) {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle() {
        return $this->libelle;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return LigneFraisHorsForfait
     */
    public function setDate($date) {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * Set montant
     *
     * @param string $montant
     *
     * @return LigneFraisHorsForfait
     */
    public function setMontant($montant) {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return string
     */
    public function getMontant() {
        return $this->montant;
    }

    

    /**
     * Set idfichefrais
     *
     * @param \gsbBundle\Entity\FicheFrais $idfichefrais
     *
     * @return LigneFraisHorsForfait
     */
    public function setIdfichefrais(\gsbBundle\Entity\FicheFrais $idfichefrais = null)
    {
        $this->idfichefrais = $idfichefrais;

        return $this;
    }

    /**
     * Get idfichefrais
     *
     * @return \gsbBundle\Entity\FicheFrais
     */
    public function getIdfichefrais()
    {
        return $this->idfichefrais;
    }
}

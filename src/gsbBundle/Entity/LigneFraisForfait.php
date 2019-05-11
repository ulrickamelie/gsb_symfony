<?php

namespace gsbBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LigneFraisForfait
 *
 * @ORM\Table(name="LigneFraisForfait")
 * @ORM\Entity(repositoryClass="gsbBundle\Repository\LigneFraisForfaitRepository")
 */
class LigneFraisForfait
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="repasRestaurant", type="integer")
     */
    private $repasRestaurant;

    /**
     * @var int
     *
     * @ORM\Column(name="nuiteeHotel", type="integer")
     */
    private $nuiteeHotel;

    /**
     * @var int
     *
     * @ORM\Column(name="fraisKilometrique", type="integer")
     */
    private $fraisKilometrique;

    /**
     * @var int
     *
     * @ORM\Column(name="forfaitEtape", type="integer")
     */
    private $forfaitEtape;
    
    /**
     * @ORM\OneToOne(targetEntity="\gsbBundle\Entity\FicheFrais", cascade={"persist"})
     * @ORM\JoinColumn(name="idfichefrais", referencedColumnName="id")
     */
    private $idfichefrais;
    
    /**
     * @ORM\ManyToOne(targetEntity="\gsbBundle\Entity\FraisForfait")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fraisforfait;
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set repasRestaurant
     *
     * @param integer $repasRestaurant
     *
     * @return LigneFraisForfait
     */
    public function setRepasRestaurant($repasRestaurant)
    {
        $this->repasRestaurant = $repasRestaurant;

        return $this;
    }

    /**
     * Get repasRestaurant
     *
     * @return int
     */
    public function getRepasRestaurant()
    {
        return $this->repasRestaurant;
    }

    /**
     * Set nuiteeHotel
     *
     * @param integer $nuiteeHotel
     *
     * @return LigneFraisForfait
     */
    public function setNuiteeHotel($nuiteeHotel)
    {
        $this->nuiteeHotel = $nuiteeHotel;

        return $this;
    }

    /**
     * Get nuiteeHotel
     *
     * @return int
     */
    public function getNuiteeHotel()
    {
        return $this->nuiteeHotel;
    }

    /**
     * Set fraisKilometrique
     *
     * @param integer $fraisKilometrique
     *
     * @return LigneFraisForfait
     */
    public function setFraisKilometrique($fraisKilometrique)
    {
        $this->fraisKilometrique = $fraisKilometrique;

        return $this;
    }

    /**
     * Get fraisKilometrique
     *
     * @return int
     */
    public function getFraisKilometrique()
    {
        return $this->fraisKilometrique;
    }

    /**
     * Set forfaitEtape
     *
     * @param integer $forfaitEtape
     *
     * @return LigneFraisForfait
     */
    public function setForfaitEtape($forfaitEtape)
    {
        $this->forfaitEtape = $forfaitEtape;

        return $this;
    }

    /**
     * Get forfaitEtape
     *
     * @return int
     */
    public function getForfaitEtape()
    {
        return $this->forfaitEtape;
    }

    /**
     * Set idfichefrais
     *
     * @param \gsbBundle\Entity\FicheFrais $idfichefrais
     *
     * @return LigneFraisForfait
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

    /**
     * Set fraisforfait
     *
     * @param \gsbBundle\Entity\FraisForfait $fraisforfait
     *
     * @return LigneFraisForfait
     */
    public function setFraisforfait(\gsbBundle\Entity\FraisForfait $fraisforfait)
    {
        $this->fraisforfait = $fraisforfait;

        return $this;
    }

    /**
     * Get fraisforfait
     *
     * @return \gsbBundle\Entity\FraisForfait
     */
    public function getFraisforfait()
    {
        return $this->fraisforfait;
    }
}

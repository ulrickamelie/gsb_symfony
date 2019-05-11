<?php

namespace gsbBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FraisForfait
 *
 * @ORM\Table(name="FraisForfait")
 * @ORM\Entity(repositoryClass="gsbBundle\Repository\FraisForfaitRepository")
 */
class FraisForfait
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
     * @var string
     *
     * @ORM\Column(name="montantRepas", type="decimal", precision=5, scale=2)
     */
    private $montantRepas;

    /**
     * @var string
     *
     * @ORM\Column(name="montantNuitee", type="decimal", precision=5, scale=2)
     */
    private $montantNuitee;

    /**
     * @var string
     *
     * @ORM\Column(name="montantFraisKilometrique", type="decimal", precision=5, scale=2)
     */
    private $montantFraisKilometrique;

    /**
     * @var string
     *
     * @ORM\Column(name="montantForfait", type="decimal", precision=5, scale=2)
     */
    private $montantForfait;


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
     * Set montantRepas
     *
     * @param string $montantRepas
     *
     * @return FraisForfait
     */
    public function setMontantRepas($montantRepas)
    {
        $this->montantRepas = $montantRepas;

        return $this;
    }

    /**
     * Get montantRepas
     *
     * @return string
     */
    public function getMontantRepas()
    {
        return $this->montantRepas;
    }

    /**
     * Set montantNuitee
     *
     * @param string $montantNuitee
     *
     * @return FraisForfait
     */
    public function setMontantNuitee($montantNuitee)
    {
        $this->montantNuitee = $montantNuitee;

        return $this;
    }

    /**
     * Get montantNuitee
     *
     * @return string
     */
    public function getMontantNuitee()
    {
        return $this->montantNuitee;
    }

    /**
     * Set montantFraisKilometrique
     *
     * @param string $montantFraisKilometrique
     *
     * @return FraisForfait
     */
    public function setMontantFraisKilometrique($montantFraisKilometrique)
    {
        $this->montantFraisKilometrique = $montantFraisKilometrique;

        return $this;
    }

    /**
     * Get montantFraisKilometrique
     *
     * @return string
     */
    public function getMontantFraisKilometrique()
    {
        return $this->montantFraisKilometrique;
    }

    /**
     * Set montantForfait
     *
     * @param string $montantForfait
     *
     * @return FraisForfait
     */
    public function setMontantForfait($montantForfait)
    {
        $this->montantForfait = $montantForfait;

        return $this;
    }

    /**
     * Get montantForfait
     *
     * @return string
     */
    public function getMontantForfait()
    {
        return $this->montantForfait;
    }
}


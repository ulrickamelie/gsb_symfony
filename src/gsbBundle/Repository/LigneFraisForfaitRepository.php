<?php

namespace gsbBundle\Repository;

/**
 * LigneFraisForfaitRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LigneFraisForfaitRepository extends \Doctrine\ORM\EntityRepository
{
    /*public function __construct(\Symfony\Bridge\Doctrine\RegistryInterface $registry) {
        parent::__construct($registry, \gsbBundle\Entity\LigneFraisForfait::class);
    }
    
    public function findFicheFrais($id)
    {
        $qb = $this->createQueryBuilder('lff')
                ->leftJoin('lff.date', 'ff')
                ->where('id=:id')
                ->setParameter(id, $id)
        ->getQuery()->getResult();
    }*/
}

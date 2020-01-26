<?php

namespace App\Repository;

use App\Entity\Country;
use App\Entity\State;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method State|null find($id, $lockMode = null, $lockVersion = null)
 * @method State|null findOneBy(array $criteria, array $orderBy = null)
 * @method State[]    findAll()
 * @method State[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, State::class);
    }

    /**
     * @param Country $country
     * @return string
     */
    public function statesByCountryDql(Country $country)
    {
        return $this->createQueryBuilder('s')
            ->select('s.id')
            ->where('s.country = ' . $country->getId())
            ->getDQL();
    }
}

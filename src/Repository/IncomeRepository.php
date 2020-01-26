<?php

namespace App\Repository;

use App\Entity\Income;
use App\Entity\State;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * @method Income|null find($id, $lockMode = null, $lockVersion = null)
 * @method Income|null findOneBy(array $criteria, array $orderBy = null)
 * @method Income[]    findAll()
 * @method Income[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IncomeRepository extends ServiceEntityRepository
{
    const METHODS = ['AVG', 'SUM', 'COUNT'];

    /**
     * @var CountyRepository
     */
    private $countyRepository;

    public function __construct(ManagerRegistry $registry, CountyRepository $countyRepository)
    {
        parent::__construct($registry, Income::class);
        $this->countyRepository = $countyRepository;
    }

    /**
     * @param State $state
     * @param string $sqlMethod
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function totalsByState(State $state, $sqlMethod = 'SUM')
    {
        if(!in_array($sqlMethod, self::METHODS)) {
            throw new Exception(
                'List of available methods are : "' . implode(', ', self::METHODS) . '"'
            );
        }
        $query = $this->createQueryBuilder('i');

        return $query->select($sqlMethod . '(i.amount)')
            ->where(
                $query->expr()->in('i.county', $this->countyRepository->statesByIdDql($state))
            )
            ->getQuery()
            ->getSingleScalarResult();
    }
}

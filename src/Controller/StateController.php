<?php

namespace App\Controller;

use App\Repository\CountyRepository;
use App\Repository\IncomeRepository;
use App\Repository\StateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class StateController
 *
 * @package App\Controller
 */
class StateController extends AbstractController
{
    /**
     * @param $id
     * @param StateRepository $stateRepository
     * @param CountyRepository $countyRepository
     * @param IncomeRepository $incomeRepository
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function index(
        $id,
        StateRepository $stateRepository,
        CountyRepository $countyRepository,
        IncomeRepository $incomeRepository
    ) {
        $state = $stateRepository->find($id);

        return $this->render('state/index.html.twig', [
            'state' => $state,
            'counties' => $state->getCounties(),
            'avg_tax_rate' => $countyRepository->averageTaxPerState($state),
            'avg_income' => $incomeRepository->totalsByState($state, 'AVG'),
            'total' => $incomeRepository->totalsByState($state, 'SUM'),
        ]);
    }
}

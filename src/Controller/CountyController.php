<?php

namespace App\Controller;

use App\Repository\CountryRepository;
use App\Repository\CountyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class CountyController
 *
 * @package App\Controller
 */
class CountyController extends AbstractController
{
    /**
     * @param $id
     * @param CountryRepository $countryRepository
     * @param CountyRepository $countyRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index($id, CountryRepository $countryRepository, CountyRepository $countyRepository)
    {
        $county = $countyRepository->find($id);

        return $this->render('county/index.html.twig', [
            'county' => $county
        ]);
    }
}

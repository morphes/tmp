<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\CountryRepository;

/**
 * Class IndexController
 *
 * @package App\Controller
 */
class IndexController extends AbstractController
{
    /**
     * @param CountryRepository $countryRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(
        CountryRepository $countryRepository)
    {
        return $this->render('root/index.html.twig', [
            'countries' => $countryRepository->findAll()
        ]);
    }
}

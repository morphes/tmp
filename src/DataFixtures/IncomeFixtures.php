<?php

namespace App\DataFixtures;

use App\Entity\Income;
use App\Repository\CountyRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Class IncomeFixtures
 *
 * @package App\DataFixtures
 */
class IncomeFixtures extends Fixture
{
    /**
     * @var CountyRepository
     */
    private $countyRepository;

    /**
     * IncomeFixtures constructor.
     *
     * @param CountyRepository $countyRepository
     */
    public function __construct(CountyRepository $countyRepository)
    {
        $this->countyRepository = $countyRepository;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $counties = $this->countyRepository->findAll();

        foreach ($counties as $county) {
            for ($count = 0; $count < rand(100, 100000); $count++) {
                $income = new Income();

                $income->setCounty($county);
                $income->setAmount(rand(10000, 1000000000) / 100);

                $manager->persist($income);
            }
        }

        $manager->flush();
    }
}

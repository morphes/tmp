<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Country;
use App\Entity\State;
use App\Entity\County;

/**
 * Class GeoFixture
 *
 * @package App\DataFixtures
 */
class GeoFixture extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach(array_keys(self::SOURCES) as $countryName) {
            $country = new Country();
            $country->setName($countryName);

            $manager->persist($country);

            foreach(array_keys(self::SOURCES[$countryName]) as $sourceState) {

                $state = new State();

                $state->setName($sourceState);
                $state->setCountry($country);

                $manager->persist($state);

                foreach(self::SOURCES[$countryName][$sourceState] as $sourceCounty) {
                    $county = new County();

                    $county->setName($sourceCounty);
                    $county->setState($state);
                    $county->setTaxRate(rand(500, 4000) / 100);

                    $manager->persist($county);
                }
            }
            $manager->flush();
        }
    }

    const SOURCES = [
        'Russia' => [
            'Moscow' => [
                'Domodedovo',
                'Vnukovo',
                'Tula',
                'Pulkovo',
                'Odintcovo',
                'Sheremetyevo',
            ],
            'Rostov' => [
                'Shahti',
                'Novocherkassk',
                'Doneck',
                'Bataysk',
                'Aksay',
                'Azov',
            ],
            'Petersburg' => [
                'Lenino',
                'Filkino',
                'Rumyancevo',
                'Pskovie',
            ],
            'Kazan' => [
                'Tatar',
                'Kentar',
                'Zelenodolsk',
                'Udino',
            ],
            'Krasnodar' => [
                'Sochi',
                'Kushevksya',
                'Starominskaya',
                'Kanelovskaya',
                'Anapa',
                'Gelendzhik',
            ]
        ],
        'USA' => [
            'Alabama' => [
                'Madison',
                'Decatur',
                'Hoover',
                'Dothan',
                'Gadsden',
                'Mobile',
            ],
            'Kansas' => [
                'Wichita',
                'Emporia',
                'Abilene',
                'Newton',
                'Olathe',
            ],
            'Missouri' => [
                'St. Joseph',
                'St. Charles',
                'St. Peters',
                'Columbia',
                'Springfield',
            ],
            'Texas' => [
                'Dallas',
                'Austin',
                'Fort Worth',
                'Arlington',
                'Plano',
                'Laredo',
            ],
            'Washington' => [
                'Seattle',
                'Tacoma',
                'Bellevue',
                'Everett',
                'Spokane Valley',
            ],
        ]
    ];
}

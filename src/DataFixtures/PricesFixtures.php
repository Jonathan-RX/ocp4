<?php

namespace App\DataFixtures;

use App\Entity\Price;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PricesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $prices = new Price();
        $prices->setRegular(16);
        $prices->setChild(8);
        $prices->setSenior(12);
        $prices->setDiscount(10);
        $prices->setFree(0);

        $manager->persist($prices);
        $manager->flush();
    }
}

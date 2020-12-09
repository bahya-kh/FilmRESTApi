<?php

namespace App\DataFixtures;

use App\Entity\Film;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
            $film = new Film();
            $film->setTitle('Titanic');
            $film->setCategory('Romantic');
            $film->setViewsNumber('10000');
            $film->setReleaseYear('1998');
            $manager->persist($film);

            $film1 = new Film();
            $film1->setTitle('Black Bird');
            $film1->setCategory('Action');
            $film1->setViewsNumber('7000');
            $film1->setReleaseYear('2020');
            $manager->persist($film1);

        $manager->flush();
    }
}

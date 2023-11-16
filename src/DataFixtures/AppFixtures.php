<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Actor;
use Symfony\Component\Validator\Constraints\DateTime;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        //$manager->flush();
        $actor = new Actor();
        $actor->setLastname('DOE');
        $actor->setFirstname('John');
        $actor->setDob(new DateTime());
        $actor->setCreateAt(new \DateTimeImmutable());
        $manager->persist($actor);
        $manager->flush();
    }

}

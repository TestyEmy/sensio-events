<?php

namespace App\DataFixtures;

use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProjectFixtures extends Fixture
{
    const SOIREE = 'soiree';
    public function load(ObjectManager $manager)
    {
        $project = (new Project())
            ->setName('Soirée')
            ->setSummary('Une soirée')
            ->setCreatedAt(new \DateTimeImmutable())
            ->setUpdatedAt(new \DateTimeImmutable())
        ;

        $this->addReference(self::SOIREE, $project);

        $manager->persist($project);
        $manager->flush();
    }
}
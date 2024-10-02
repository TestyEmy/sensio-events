<?php

namespace App\DataFixtures;

use App\Entity\Event;
use App\Entity\Organization;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EventFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [
            OrganizationFixtures::class,
            ProjectFixtures::class
        ];
    }

    public function load(ObjectManager $manager)
    {
        /** @var Organization $organization */
        $organization = $this->getReference(OrganizationFixtures::ATOO_NEXT);
        
        for ($i = 0; $i < 10; $i++) {
            $event = (new Event())
                ->setName('event_' . $i)
                ->setAccessible(true)
                ->setDescription('Un event')
                ->setStartAt(new \DateTimeImmutable())
                ->setEndAt(new \DateTimeImmutable('+1 month'))
                ->addOrganization($organization)
                ->setProject($this->getReference(ProjectFixtures::SOIREE))
                ->setPrerequisites('Prerequisites for Event ');
            ;

            $manager->persist($event);
        }

        $manager->flush();
    }
}
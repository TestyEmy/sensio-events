<?php

namespace App\DataFixtures;

use App\Entity\Organization;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OrganizationFixtures extends Fixture
{
    const ATOO_NEXT = 'atoo_next';
    public function load(ObjectManager $manager)
    {
        $organization = (new Organization())
            ->setName('AtooNext')
            ->setPresentation('LEs boss')
            ->setCreatedAt(new \DateTimeImmutable())
        ;
        
        $this->addReference(self::ATOO_NEXT, $organization);
        
        $manager->persist($organization);
        $manager->flush();
    }
}
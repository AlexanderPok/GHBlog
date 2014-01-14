<?php

namespace Gh\GuestbookBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Gh\BlogBundle\Document\Category;

class LoadCategoryData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $computers = new Category();
        $computers->setName('Computers');
        $phones = new Category();
        $phones->setName('Phones');
        $smarts = new Category();
        $smarts->setName('Smartphones');

        $manager->persist($computers);
        $manager->persist($phones);
        $manager->persist($smarts);
        $manager->flush();

        $this->addReference('computers', $computers);
        $this->addReference('phones', $phones);
        $this->addReference('smarts', $smarts);
    }

    public function getOrder()
    {
        return 1;
    }
}
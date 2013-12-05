<?php

namespace Gh\GuestbookBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Gh\GuestbookBundle\Entity\Message;

class LoadMessageData extends AbstractFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 15; $i++) {
            $message = new Message();
            $message->setName($i . 'name');
            $message->setEmail($i . 'email@email.com');
            $message->setMessage($i . ': Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc elementum sodales ante et ultrices.');
            $manager->persist($message);
        }
        $manager->flush();
    }
}
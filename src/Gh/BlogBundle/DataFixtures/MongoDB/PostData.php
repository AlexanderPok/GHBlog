<?php

namespace Gh\GuestbookBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Gh\BlogBundle\Document\Post;
use Gh\BlogBundle\Document\Tag;

class LoadPostData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $categories = array(
            $this->getReference('computers'),
            $this->getReference('phones'),
            $this->getReference('smarts')
        );
        $tags = array();
        $tagNames = array('wtf', 'science', 'phones', 'moto', 'ati');
        foreach ($tagNames as $tagName) {
//            $tag = new Tag();
//            $tag->setName($tagName);
            $tags[] = $tagName;
        }
        for ($i = 1; $i <= 15; $i++) {
            $post = new Post();
            $post->setTitle($i . ' some title');
            $post->setText($i . ': Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc elementum sodales ante et ultrices.');
            $post->setCategory($categories[rand(0,2)]);
            $tagsIds = array_rand($tags, rand(1,2));
            if (is_array($tagsIds)) {
                $tagsArr = array();
                foreach ($tagsIds as $tagId) {
                    $tagsArr[] = $tags[$tagId];
                }
                $post->setTags($tagsArr);
            } else {
                $post->setTags(array($tags[$tagsIds]));
            }
            
            $manager->persist($post);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
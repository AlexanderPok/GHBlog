<?php
namespace Gh\BlogBundle\Service;

use Doctrine\Common\Persistence\ObjectManager;
use Gh\BlogBundle\Document\Post;
use Gh\BlogBundle\Event\PostVisitEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class PostService
{
    protected $dm;
    protected $ed;


    public function __construct(ObjectManager $om, EventDispatcherInterface $ed)
    {
        $this->dm = $om;
        $this->ed = $ed;
    }


    public function postVisited(Post $post)
    {
        $event = new PostVisitEvent();
        $event->setPost($post);
        $this->ed->dispatch('gh.blog.listener.post_visit', $event);
    }
}
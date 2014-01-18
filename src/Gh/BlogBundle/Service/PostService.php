<?php
namespace Gh\BlogBundle\Service;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\MongoDB\Query\Builder;
use Gh\BlogBundle\Document\Post;
use Gh\BlogBundle\Event\PostVisitEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;

class PostService
{
    protected $dm;
    protected $ed;
    protected $validFilterParams = array(
        'category',
        'tags',
        'q'
    );

    /**
     * @param ObjectManager $om
     * @param EventDispatcherInterface $ed
     */
    public function __construct(ObjectManager $om, EventDispatcherInterface $ed)
    {
        $this->dm = $om;
        $this->ed = $ed;
    }

    /**
     * @param Post $post
     */
    public function postVisited(Post $post)
    {
        $event = new PostVisitEvent();
        $event->setPost($post);
        $this->ed->dispatch('gh.blog.listener.post_visit', $event);
    }

    /**
     * @param Builder $qb
     * @param array $params
     */
    public function applyFilters(Builder $qb, $params)
    {
        foreach ($params as $key => $value) {
            if (in_array($key, $this->validFilterParams)) {
                $qb->field($key)->equals($value);
            }
        }
    }
}
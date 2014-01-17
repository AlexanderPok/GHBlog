<?php

namespace Gh\BlogBundle\EventListener;

use Gh\BlogBundle\Event\PostVisitEvent;
use Gh\BlogBundle\Repository\PostRepository;

class PostVisitListener
{
    /**
     * @var PostRepository
     */
    protected $repository;

    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

    public function onPostVisit(PostVisitEvent $event)
    {
        $this->repository->increaseVisitsById($event->getPost()->getId());
    }
}
<?php

namespace Gh\BlogBundle\Event;

use Gh\BlogBundle\Document\Post;
use Symfony\Component\EventDispatcher\Event;

class PostVisitEvent extends Event
{
    protected $post;

    /**
     * @param Post $article
     */
    public function setPost(Post $post)
    {
        $this->post = $post;
    }

    /**
     * @return Post
     */
    public function getPost()
    {
        return $this->post;
    }
}
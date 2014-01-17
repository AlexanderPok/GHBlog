<?php

namespace Gh\BlogBundle\Controller;

use Gh\BlogBundle\Document\Category;
use Gh\BlogBundle\Document\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PostController extends Controller
{
    public function listAction()
    {
        $posts = $this->get('gh.blog.repository.post')->findAll();
        return $this->render('GhBlogBundle:Post:list.html.twig', array(
            'posts' => $posts,
        ));
    }

    public function recentPostsPartialAction()
    {
        $posts = $this->get('gh.blog.repository.post')->findRecent();
        return $this->render('GhBlogBundle:Post:recent-posts-partial.html.twig', array(
            'posts' => $posts,
        ));
    }

    public function MostViewedPostsPartialAction()
    {
        $posts = $this->get('gh.blog.repository.post')->findMostViewed();
        return $this->render('GhBlogBundle:Post:most-viewed-posts-partial.html.twig', array(
            'posts' => $posts,
        ));
    }

    public function TagCloudPartialAction()
    {
        $tags = $this->get('gh.blog.repository.post')->findTags();
        return $this->render('GhBlogBundle:Post:tag-cloud-partial.html.twig', array(
            'tags' => $tags,
        ));
    }

    public function showAction($slug)
    {
        $post = $this->get('gh.blog.repository.post')->findBySlug($slug);
        if (!$post) {
            throw $this->createNotFoundException('The post does not exist');
        }
        $this->getPostService()->postVisited($post);
        return $this->render('GhBlogBundle:Post:show.html.twig', array(
            'post' => $post,
        ));
    }

    /**
     * @return \Gh\BlogBundle\Service\PostService
     */
    private function getPostService()
    {
        return $this->get('gh.blog.post');
    }
}

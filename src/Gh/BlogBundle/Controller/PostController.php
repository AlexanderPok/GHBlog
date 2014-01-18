<?php

namespace Gh\BlogBundle\Controller;

use Gh\BlogBundle\Document\Category;
use Gh\BlogBundle\Document\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
{
    public function listAction(Request $request)
    {
        $template = 'GhBlogBundle:Post:list.html.twig';
        if ($request->isXmlHttpRequest()) {
            $template = 'GhBlogBundle:Post:list-partial.html.twig';
        }
        $qb = $this->get('gh.blog.repository.post')->getRecentQb();
        $paginator  = $this->get('knp_paginator');
        $this->getPostService()->applyFilters($qb, $request->query->all());
        $pagination = $paginator->paginate(
            $qb,
            $this->get('request')->query->get('page', 1),
            $this->container->getParameter('gh_blog.messages_per_page')
        );
        return $this->render($template, array(
            'pagination' => $pagination,
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

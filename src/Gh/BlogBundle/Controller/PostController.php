<?php

namespace Gh\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PostController extends Controller
{
    public function indexAction()
    {
        return $this->render('GhBlogBundle:Default:index.html.twig');
    }
}

<?php

namespace Gh\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    public function aboutAction()
    {
        return $this->render('GhBlogBundle:Index:about.html.twig');
    }
}

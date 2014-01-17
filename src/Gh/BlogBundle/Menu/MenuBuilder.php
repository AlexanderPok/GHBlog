<?php

namespace Gh\BlogBundle\Menu;

use Doctrine\ORM\EntityManager;
use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class MenuBuilder
{
    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu()
    {
        $menu = $this->factory->createItem('root', array(
            'navbar' => true,
        ));
        $menu->addChild('Blog', array('route' => 'gh_blog_home'));
        $menu->addChild('About me', array('route' => 'gh_blog_about'));
        $menu->addChild('Guestbook', array('route' => 'gh_guestbook_message'));
        return $menu;
    }
}
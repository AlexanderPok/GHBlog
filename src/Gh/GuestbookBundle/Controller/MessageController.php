<?php

namespace Gh\GuestbookBundle\Controller;

use Gh\GuestbookBundle\Form\Type\MessageType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Gh\GuestbookBundle\Document\Message;

class MessageController extends Controller
{
    public function indexAction(Request $request)
    {
        $template = 'GhGuestbookBundle:Message:index.html.twig';
        if ($request->isXmlHttpRequest()) {
            $template = 'GhGuestbookBundle:Message:list-partial.html.twig';
        }
        $dm = $this->get('doctrine_mongodb')->getManager();
        $messageQb = $dm->getRepository('GhGuestbookBundle:Message')->createQueryBuilder()
            ->sort('id', 'DESC');
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $messageQb,
            $this->get('request')->query->get('page', 1),
            $this->container->getParameter('gh_guestbook.messages_per_page')
        );
        $message = new Message();
        $createForm = $this->createCreateForm($message);
        $createForm->handleRequest($request);
        if ($createForm->isValid()) {
            $dm->persist($message);
            $dm->flush();
            return $this->redirect($this->generateUrl('gh_guestbook_message'));
        }
        return $this->render($template, array(
            'pagination' => $pagination,
            'createMessageForm' => $createForm->createView(),
        ));
    }

    private function createCreateForm(Message $entity)
    {
        $form = $this->createForm(new MessageType(), $entity, array(
            'action' => $this->generateUrl('gh_guestbook_message'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Do it!'));

        return $form;
    }

    public function showAction($id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $entity = $dm->getRepository('GhGuestbookBundle:Message')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Message entity.');
        }

        return $this->render('GhGuestbookBundle:Message:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

    public function deleteAction($id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $entity = $dm->getRepository('GhGuestbookBundle:Message')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Message entity.');
        }

        $dm->remove($entity);
        $dm->flush();

        return $this->redirect($this->generateUrl('gh_guestbook_message'));
    }

    public function lastMessagesPartialAction()
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $messages = $dm->getRepository('GhGuestbookBundle:Message')
            ->findLastMessages();
        return $this->render('GhGuestbookBundle:Message:last-messages-partial.html.twig', array(
            'messages' => $messages,
        ));
    }
}

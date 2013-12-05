<?php

namespace Gh\GuestbookBundle\Controller;

use Gh\GuestbookBundle\Form\Type\MessageType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Gh\GuestbookBundle\Entity\Message;

class MessageController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $messageQb = $em->getRepository('GhGuestbookBundle:Message')->createQueryBuilder('m')
            ->orderBy('m.id', 'DESC');
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
            $em->persist($message);
            $em->flush();
            return $this->redirect($this->generateUrl('gh_guestbook_message'));
        }
        return $this->render('GhGuestbookBundle:Message:index.html.twig', array(
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
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GhGuestbookBundle:Message')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Message entity.');
        }

        return $this->render('GhGuestbookBundle:Message:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('GhGuestbookBundle:Message')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Message entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('gh_guestbook_message'));
    }

}
<?php

namespace App\Controller;

use App\Entity\Message;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends AbstractController
{
    /**
     * @Route("/message", name="app_message")
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        $messages = $doctrine->getRepository(Message::class)->findAll();
        return $this->render('message/index.html.twig', [
            'messages' => $messages,
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AdminController extends AbstractController
{ 
    /**
     * @Route("/admin", name="admin")
     */
    public function index(Request $request, SessionInterface $session)
    {
        if( empty($session->get('username')) ){
            header('Location: login');exit;
        }
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
}

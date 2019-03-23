<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CustomUrlsController extends AbstractController
{
    /**
     * @Route("/custom/urls", name="custom_urls")
     */
    public function index()
    {
        return $this->render('custom_urls/index.html.twig', [
            'controller_name' => 'CustomUrlsController',
        ]);
    }
}

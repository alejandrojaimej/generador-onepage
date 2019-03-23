<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


use App\Entity\Users;
use App\Entity\UsersUrl;
use App\Entity\UsersContent;

class CustomUrlsController extends AbstractController
{
    /**
     * @Route("/{custom_url}", name="custom_urls", requirements={"custom_url"="^(?!.*(admin|login)$).*"})
     */
    public function index($custom_url, Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user_url = $entityManager->getRepository(UsersUrl::class)->findOneBy([
            'url' => $custom_url
        ]);
        
        if($user_url){//si la url está asignada a un usuario
            $header_text = '';
            $header_image = '';
            $section1 = '';
            $section2 = '';
            $section3 = '';


            //obtener el contenido
            $user_content = $entityManager->getRepository(UsersContent::class)->findOneBy([
                'user_id' => $user_url->getUserId()
            ]);

            if($user_content){
                $header_text = $user_content->getHeaderText();
                $header_image = $user_content->getHeaderImage();
                $section1 = $user_content->getSection1();
                $section2 = $user_content->getSection2();
                $section3 = $user_content->getSection3();
            }

        }else{
            throw $this->createNotFoundException();
        }
        
  
        return $this->render(
            'custom_urls/index.html.twig', [
            'controller_name' => 'CustomUrlsController',
            'header_text'=> $header_text,
            'header_image'=> $header_image,
            'section1'=> $section1,
            'section2'=> $section2,
            'section3'=> $section3
            ]
        );
    }
}

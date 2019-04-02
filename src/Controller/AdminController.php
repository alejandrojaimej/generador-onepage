<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\RequestContext;

use App\Entity\Users;
use App\Entity\UsersUrl;
use App\Entity\UsersContent;


class AdminController extends AbstractController
{ 
    /**
     * @Route("/admin", name="admin")
     */
    public function index(Request $request, SessionInterface $session)
    {
        //redirigir al login si no hay sesión iniciada
        if( empty($session->get('username')) || empty($session->get('userid')) ){
            header('Location: login');exit;
        }
        $userId = $session->get('userid');

        $entityManager = $this->getDoctrine()->getManager();


        /**
         * GUARDAR, ACTUALIZAR Y OBTENER LA URL DE DESTINO
         */
        $user_url = $entityManager->getRepository(UsersUrl::class)->findOneBy([
            'user_id' => $userId
        ]);
        //actualizar contenido si vienen datos post
        if(isset($_POST) && !empty($_POST)){
            //Limpiar la url introducida....que no me fio
            $url = filter_var($_POST['url'], FILTER_SANITIZE_URL);
            $url = str_replace('/', '', $url);
            if(filter_var('https://ejemplo.com/'.$url, FILTER_VALIDATE_URL)){
                if(!is_null($user_url)){ //actualizar users_url
                    $user_url->setUrl($url);
                    $entityManager->flush();
                }else{ //insertar users_url
                    $user_url = new UsersUrl();
                    $user_url->setUserId($userId);
                    $user_url->setUrl($url);
                    $entityManager->persist($user_url);
                    $entityManager->flush();
                }
                //obtener de nuevo los datos de la db después de actualizarlos
                $user_url = $entityManager->getRepository(UsersUrl::class)->findOneBy([
                    'user_id' => $userId
                ]);
            }
        }

        $url = '';
        if(!is_null($user_url)){
            $url = $user_url->getUrl();
        }


        /**
         * GUARDAR, ACTUALIZAR Y OBTENER LOS TEXTOS A MOSTRAR EN LA WEB
         */
        $user_content = $entityManager->getRepository(UsersContent::class)->findOneBy([
            'user_id' => $userId
        ]);
        //actualizar si post
        if(isset($_POST) && !empty($_POST)){
            if(!is_null($user_content)){ //actualizar users_content
                $user_content->setHeaderText($_POST['header']);
                $user_content->setSection1($_POST['text_section_1']);
                $user_content->setSection2($_POST['text_section_2']);
                $user_content->setSection3($_POST['text_section_3']);
                $entityManager->flush();
                $user_content->setHeaderText($_POST['header']);
            }else{
                $user_content = new UsersContent();
                $user_content->setUserId($userId);
                $user_content->setHeaderText($_POST['header']);
                $user_content->setSection1($_POST['text_section_1']);
                $user_content->setSection2($_POST['text_section_2']);
                $user_content->setSection3($_POST['text_section_3']);
                $entityManager->persist($user_content);
                $entityManager->flush();
            }
            $user_content = $entityManager->getRepository(UsersContent::class)->findOneBy([
                'user_id' => $userId
            ]);
        }

        /**
         * SUBIR IMAGEN DEL HEADER
         */
       // dump($_FILES);
        if(isset($_FILES['img_cabecera']) && !empty($_FILES['img_cabecera']) && $_FILES['img_cabecera']['size'] > 0){
            $image = $_FILES['img_cabecera'];
            //comprobar que las rutas de subida existen y tienen permisos
            $path = "../public/assets/images/user/$userId/";
            if (!is_dir($path)) {
                mkdir($path);
                chmod($path, 0777);
            }

            $tempFile = $image['tmp_name'];
            $targetFile =  $path. $image['name'];
            $imageUrl = "/assets/images/user/$userId/".$image['name'];
            $res = file_put_contents($targetFile, file_get_contents($tempFile));
            if($res !== false){
                chmod($targetFile, 0755);
                //guardar en la db
                if(!is_null($user_content)){ //actualizar users_url
                    $user_content->setHeaderImage($imageUrl);
                    $entityManager->flush();
                }else{
                    $user_content = new UsersContent();
                    $user_content->setUserId($userId);
                    $user_content->setHeaderImage($imageUrl);
                    $entityManager->flush();
                }
                $user_content = $entityManager->getRepository(UsersContent::class)->findOneBy([
                    'user_id' => $userId
                ]);
            }

        }


        //valores por defecto para la view
        $default_image = '/assets/images/default_image.svg';
        $header = '';
        $header_image = '';
        $section1 = '';
        $section2 = '';
        $section3 = '';
        if(!is_null($user_content)){
            $header = $user_content->getHeaderText();
            $header_image = $user_content->getHeaderImage();
            $section1 = $user_content->getSection1();
            $section2 = $user_content->getSection2();
            $section3 = $user_content->getSection3();
        }

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'default_image'=> $default_image,
            'url'=>$url,
            'header' => $header,
            'header_image' => $header_image,
            'section1' => $section1,
            'section2' => $section2,
            'section3' => $section3
        ]);
    }
}

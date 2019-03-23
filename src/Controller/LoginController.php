<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\Users;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function index(Request $request, SessionInterface $session)
    {
        dump($_POST);
        $email = '';
        $pass = '';
        if(isset($_POST) && !empty($_POST)){
            $email = $_POST['email'];
            $pass = $_POST['password'];

            $repository = $this->getDoctrine()->getRepository(Users::class);
            $user = $repository->findOneBy([
                'email' => $email,
                'password' => $pass,
            ]);
            $users = $repository->findAll();            
            if(!empty($users)){
                $session->set('username', $email);
                header('Location: /admin'); exit;
            }
        }
        $session->set('username', '');
        


        return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController',
            'email' => $email,
            'pass' => $pass
        ]);
    }
}

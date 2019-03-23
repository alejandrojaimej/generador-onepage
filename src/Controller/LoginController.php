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
                $session->set('userid', $user->getId());
                header('Location: /admin'); exit;
            }
        }
        //si no se envía el formulario cierro las posibles sesiones abiertas
        $session->set('username', '');
        $session->set('userid', '');
        


        return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController',
            'email' => $email,
            'pass' => $pass
        ]);
    }
}

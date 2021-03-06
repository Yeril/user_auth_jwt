<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\Authentication\LogoutHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class DefaultController extends AbstractController
{
    public function register(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $em = $this->getDoctrine()->getManager();

        $username = $request->request->get('_username');
        $password = $request->request->get('_password');

        $user = new User($username);
        $user->setPassword($encoder->encodePassword($user, $password));

        $em->persist($user);
        $em->flush();

        return new Response(sprintf('User %s successfully created' . PHP_EOL, $user->getUsername()));
    }

    public function api()
    {
        return new Response(sprintf('Logged in as %s' . PHP_EOL, $this->getUser()->getUsername()));
    }

//    public function logout(LogoutHandler $logoutHandler, Request $request, Response $response, TokenInterface $token)
//    {
//        $logoutHandler->logout($request, $response, $token);
//        return new Response(sprintf('Logout'));
//    }

}

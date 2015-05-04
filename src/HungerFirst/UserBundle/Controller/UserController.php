<?php

namespace HungerFirst\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function listAction()
    {
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();

        return $this->render('HFUserBundle:User:list.html.twig', array('users' => $users));
    }
    
    public function deleteAction($id)
    {
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserBy(array('id' => $id)); 
        if (!$user) {
            throw $this->createNotFoundException('Can not for user');
        }
        
        if (!$user->hasRole('ROLE_ADMIN') && !$user->hasRole('ROLE_SUPER_ADMIN')) {
            $userManager->deleteUser($user);
        }
        else {
            $this->addFlash('error', 'Can not delete an admin!');
        }

        return $this->redirectToRoute('hf_user_list');
    }
    
}
    
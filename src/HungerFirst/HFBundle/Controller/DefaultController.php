<?php

namespace HungerFirst\HFBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($page, $id, $firstName, $lastName, $address, $phoneNumber, $sortby)
    { 
        $securityContext = $this->container->get('security.context');
        if(!$securityContext->isGranted('IS_AUTHENTICATED_FULLY')){
            return $this->redirectToRoute('fos_user_security_login');
        }
        
        $query = array(
            'page' => $page,
            'id' => $id,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'address' => $address,
            'phoneNumber' => $phoneNumber,
            'sortby' => $sortby
            );
        
        return $this->render('HFBundle:Default:index.html.twig', array(
                'query' => $query,
            ));
    }
}

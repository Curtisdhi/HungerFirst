<?php

namespace HungerFirst\HFBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($page, $id, $firstName, $lastName, $address, $phoneNumber, $sortby)
    {
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

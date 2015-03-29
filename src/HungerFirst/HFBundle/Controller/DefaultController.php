<?php

namespace HungerFirst\HFBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('HFBundle:Default:index.html.twig');
    }
}

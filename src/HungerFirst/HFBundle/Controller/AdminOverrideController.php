<?php

namespace HungerFirst\HFBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use HungerFirst\HFBundle\Form\Model\AdminOverrideModel;
use HungerFirst\HFBundle\Form\Type\AdminOverrideType;

class AdminOverrideController extends Controller
{
    public function requireOverrideAction(Request $request, $route, $parameters)
    { 
        $adminOverride = new AdminOverrideModel();
        $adminOverride->setRoute($route)
                ->setParameters($parameters);

        $form = $this->createForm(new AdminOverrideType(), $adminOverride);
        $form->handleRequest($request);
        if ($form->isValid()) {
            return $this->forward('HFBundle:AdminOverride:override', array(
                'adminOverride' => $adminOverride,
            ));
        }
        return $this->render('HFBundle:AdminOverride:index.html.twig', array(
            'form' => $form->createView(),
            'model' => $adminOverride,
        ));
    }
    
    public function overrideAction($adminOverride) {
        //clear flash messages
        $this->get('session')->getFlashBag()->set('warning', array());
        
        $parameters = $adminOverride->getParameters();
        
        $canOverride = $this->get('admin_override_service')->canOverride($adminOverride->getKey());
        if ($canOverride) {
            $this->addFlash('success', 'Admin override successful!');
            $parameters['override'] = true;
        }
        //get controller from route
        $routes = $this->get('router')->getRouteCollection();
        $route = $routes->get($adminOverride->getRoute());
        
        return $this->forward($route->getDefault('_controller'), $parameters); 
        //$this->redirectToRoute($adminOverride->getRoute(), $parameters);
    }
    
}

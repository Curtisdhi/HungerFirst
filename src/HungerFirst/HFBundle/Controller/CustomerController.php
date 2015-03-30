<?php

namespace HungerFirst\HFBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use HungerFirst\HFBundle\Form\Type\CustomerType;
use HungerFirst\HFBundle\Entity\Customer;

class CustomerController extends Controller
{
    public function indexAction()
    {
        return $this->render('HFBundle:Customer:index.html.twig');
    }
    
    public function createAction(Request $request) {
        $securityContext = $this->container->get('security.context');
        if($securityContext->isGranted('IS_AUTHENTICATED_FULLY')){
            $customer = new Customer();
            $form = $this->createForm(new CustomerType(), $customer);
            $form->handleRequest($request);
            if ($form->isValid()) {
               $em = $this->getDoctrine()->getManager();
               $customer = $form->getData();

               $em->persist($customer);
               
               $em->flush();
               
               $this->get('session')->getFlashBag()->set('success', 'Successfully created new customer.');
               
               return $this->redirectToRoute('hf_homepage');
            }
            
            return $this->render('HFBundle:Customer:create.html.twig', array('form' => $form->createView()));
        }
        else {
            return $this->redirectToRoute('fos_user_security_login');
        }
    }
    
    public function editAction(Request $request, $id) {
        $securityContext = $this->container->get('security.context');
        if($securityContext->isGranted('IS_AUTHENTICATED_FULLY')){
            $em = $this->getDoctrine()->getManager();
            $customer = $em->find("HFBundle:Customer", $id);
            if (!$customer) {
                throw $this->createNotFoundException('This customer doesn\'t exist');
            }

            $form = $this->createForm(new CustomerType(), $customer);
            $form->handleRequest($request);
            if ($form->isValid()) {
               $em = $this->getDoctrine()->getManager();
               $customer = $form->getData();

               $em->persist($customer);
               
               $em->flush();
               
               $this->get('session')->getFlashBag()->set('success', 'Successfully edited customer');
               
               return $this->redirectToRoute('hf_homepage');
            }
            
            return $this->render('HFBundle:Customer:create.html.twig', array('form' => $form->createView()));
        }
        else {
            return $this->redirectToRoute('fos_user_security_login');
        }
    }
}

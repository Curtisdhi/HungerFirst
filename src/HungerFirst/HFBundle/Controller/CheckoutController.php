<?php

namespace HungerFirst\HFBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use HungerFirst\HFBundle\Entity\Checkout;

class CheckoutController extends Controller
{
    public function checkoutAction($id)
    { 
        $em = $this->getDoctrine()->getManager();
        $customer = $em->find("HFBundle:Customer", $id);
        if (!$customer) {
            throw $this->createNotFoundException('This customer doesn\'t exist');
        }
        
        $checkoutRepo = $em->getRepository('HFBundle:Checkout'); 
        $canCheckout = $checkoutRepo->canCheckout($customer, $this->container->getParameter('checkout_day_limit'));
        
        if ($canCheckout) {
            $checkout = new Checkout();

            $hasProbation = $this->get('probation_service')->hasProbation($customer);
            if ($hasProbation) {
               $this->denyAccessUnlessGranted('ROLE_ADMIN');
               $checkout->setAdminOverride(true);
            }

            $checkout->setCashier($this->getUser());
            $checkout->setCustomer($customer);

            $em->persist($checkout);
            $em->flush();
        }
        else {
            $this->addFlash('warning', 'Sorry, but this customer can not be checkout!');
        }
        return $this->redirectToRoute('hf_customer', array('id' => $customer->getId()));
    }
}

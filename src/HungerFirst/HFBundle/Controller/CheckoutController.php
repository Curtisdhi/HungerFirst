<?php

namespace HungerFirst\HFBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use HungerFirst\HFBundle\Entity\Checkout;

class CheckoutController extends Controller
{
    public function checkoutAction($id, $override=false)
    { 
        $em = $this->getDoctrine()->getManager();
        $customer = $em->find("HFBundle:Customer", $id);
        if (!$customer) {
            throw $this->createNotFoundException('This customer doesn\'t exist');
        }
        
        $checkoutRepo = $em->getRepository('HFBundle:Checkout'); 
        $canCheckout = $checkoutRepo->canCheckout($customer, $this->container->getParameter('checkout_day_limit'));

        $checkout = new Checkout();

        $hasProbation = $this->get('probation_service')->hasProbation($customer);

        if ($override) {
            $checkout->setAdminOverride(true);
        }
        else if ($hasProbation || !$canCheckout) {
            //require admin override
            $this->addFlash('warning', 'Sorry, but this customer can not be checkout without admin rights!');
            return $this->forward('HFBundle:AdminOverride:requireOverride', array(
               'route' => 'hf_checkout',
               'parameters' => array('id' => $id),
            ));
        }

        $checkout->setCashier($this->getUser());
        $checkout->setCustomer($customer);

        $em->persist($checkout);
        $em->flush();
        
        $this->addFlash('success', 'Successfully checkouted '. $customer->getName());
        
        return $this->redirectToRoute('hf_customer', array('id' => $customer->getId()));
    }
    
    
    public function listAction($page) {
        $em = $this->getDoctrine()->getManager();
        $maxCheckoutsOnPage = 20;
        
        $offset = ($page - 1) * $maxCheckoutsOnPage;

        $checkoutRepo = $em->getRepository('HFBundle:Checkout'); 
        
        
        $checkouts = $checkoutRepo->findByWithLimit($offset, $maxCheckoutsOnPage);

        $checkoutCount = $checkoutRepo->countAll();

        $pages = ceil($checkoutCount / $maxCheckoutsOnPage);
        
        return $this->render('HFBundle:Checkout:list.html.twig', 
            array('checkouts' => $checkouts,
                'page'  => $page,
                'pages' => $pages,
                'checkoutCount' => $checkoutCount,
                'maxCheckoutsOnPage' => $maxCheckoutsOnPage,
            ));
    }
}

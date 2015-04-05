<?php

namespace HungerFirst\HFBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use HungerFirst\HFBundle\Form\Type\CustomerType;
use HungerFirst\HFBundle\Form\Type\CustomerSearchType;
use HungerFirst\HFBundle\Form\Model\CustomerSearchModel;
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
    
    public function listAction(Request $request, $query) {
        $em = $this->getDoctrine()->getManager();
        $maxCustomersOnPage = 20;
        
        $offset = ($query['page'] - 1) * $maxCustomersOnPage;

        $customerRepo = $em->getRepository('HFBundle:Customer'); 
        
        
        $customers = $customerRepo->findByWithLimitAndSearch($offset, $maxCustomersOnPage, $query);

        $customerCount = $customerRepo->filterCount($query);   

        $pages = ceil($customerCount / $maxCustomersOnPage);
        
        return $this->render('HFBundle:Customer:list.html.twig', 
            array('customers' => $customers,
                'page'  => $query['page'],
                'pages' => $pages,
                'customersCount' => $customerCount,
                'maxCustomersOnPage' => $maxCustomersOnPage,
                'query' => $query,
            ));
    }
    
    public function searchBarAction(Request $request, $query = array()) {
        $form = $this->createForm(new CustomerSearchType(), new CustomerSearchModel($query)) ;
        $form->handleRequest($request);
      
        if ($form->isSubmitted()) {
            $search = $form->getData();
            //var_dump($search);
            return $this->redirectToRoute('hf_homepage', array(
                'id' => $search->getId(),
                'firstName' => $search->getFirstName(),
                'lastName' => $search->getLastName(),
                'address' => $search->getAddress(),
                'phoneNumber' => $search->getPhoneNumber(),
            ));
        }

        return $this->render('HFBundle:Customer:searchBar.html.twig', 
                array(
                    'form' => $form->createView())
                );
    }
    
}

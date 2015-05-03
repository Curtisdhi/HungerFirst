<?php

namespace HungerFirst\HFBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;
use HungerFirst\HFBundle\Form\Type\CustomerType;
use HungerFirst\HFBundle\Form\Type\CustomerSearchType;
use HungerFirst\HFBundle\Form\Model\CustomerSearchModel;
use HungerFirst\HFBundle\Entity\Customer;
use HungerFirst\HFBundle\Entity\Photo;

class CustomerController extends Controller
{
    public function indexAction()
    {
        return $this->render('HFBundle:Customer:index.html.twig');
    }
    
    public function viewAction($id) {
        $em = $this->getDoctrine()->getManager();
        $customer = $em->find("HFBundle:Customer", $id);
        if (!$customer) {
            throw $this->createNotFoundException('This customer doesn\'t exist');
        }
        $hasProbation = $this->hasProbation($customer);
        
        return $this->render('HFBundle:Customer:index.html.twig', array(
            'customer' => $customer,
            'hasProbation' => $hasProbation,
        ));
    }
    
    public function createAction(Request $request) {
        $securityContext = $this->container->get('security.context');
        $isAdmin = $securityContext->isGranted('ROLE_ADMIN');
        $customer = new Customer();

        $form = $this->createForm(new CustomerType($isAdmin), $customer);
        $form->handleRequest($request);
        if ($form->isValid()) {
           $em = $this->getDoctrine()->getManager();
           $customer = $form->getData();
           
            //pull file from webcam
            $photo = $this->getPhotoFromBase64($form['rawPhoto']->getData());

            $customer->setPhoto($photo);

           $em->persist($customer);

           $em->flush();

           $this->get('session')->getFlashBag()->set('success', 'Successfully created new customer.');

           return $this->redirectToRoute('hf_customer', array('id' => $customer->getId()));
        }

        return $this->render('HFBundle:Customer:create.html.twig', array('form' => $form->createView()));

    }
    
    public function editAction(Request $request, $id) {
        $securityContext = $this->container->get('security.context');
        $isAdmin = $securityContext->isGranted('ROLE_ADMIN');
        
        $em = $this->getDoctrine()->getManager();
        $customer = $em->find("HFBundle:Customer", $id);
        if (!$customer) {
            throw $this->createNotFoundException('This customer doesn\'t exist');
        }

        $form = $this->createForm(new CustomerType($isAdmin), $customer);
        $form->handleRequest($request);

        if ($form->isValid()) {
           $em = $this->getDoctrine()->getManager();
           $customer = $form->getData();
           
            //pull file from webcam
            $photo = $this->getPhotoFromBase64($form['rawPhoto']->getData());

            $customer->setPhoto($photo);

           $em->persist($customer);

           $em->flush();

           $this->get('session')->getFlashBag()->set('success', 'Successfully edited customer');

           return $this->redirectToRoute('hf_customer', array('id' => $customer->getId()));
        }

        return $this->render('HFBundle:Customer:create.html.twig', array('form' => $form->createView()));
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
                'form' => $form->createView(),
        ));
    }
    /**
     * Pulls file from webcam
     * 
     * @param string $base64
     * @return Photo
     */
    public function getPhotoFromBase64($base64) {
        $binary_data = base64_decode($base64);
        $photo = new Photo();
        
        $dir = $photo->getUploadRootDir();
        $name = uniqid() .'.jpg';
        $path = $dir .'/'. $name;
        
        if (!file_exists($dir)) {
            mkdir($dir,0750,true);
        }
        
        $tmp = fopen($path, 'x');
        fwrite($tmp,  $binary_data);
        fclose($tmp);
        
        $upFile = new File($path, $name);
                
        $photo->setFile($upFile);

        return $photo;
    }
    
    public function hasProbation($customer) {
        $date = new \DateTime();
        $delta = 0;
        if ($customer->getProbationEndDate()) {
            $delta = $customer->getProbationEndDate()->getTimestamp() - $date->getTimestamp();
        }
        return $delta > 0;
    }
}

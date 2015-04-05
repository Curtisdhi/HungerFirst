<?php

namespace HungerFirst\HFBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CustomerSearchType extends AbstractType {
    private $sortByOptions;
    
    public function __construct($versions = null, $sortByOptions = array()) {
        $this->versions = $versions;
        if (empty($sortByOptions)) {
            $sortByOptions = array(
                'id' => 'id',
                'firstName' => 'firstName',
                'lastName' => 'lastName',
                'phoneNumber' => 'phoneNumber');
        }
        $this->sortByOptions = $sortByOptions;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'integer', array(
            'required' => false,
            'attr' => array(
                'placeholder' => 'ID Number',
            ),
            'empty_data' => 0,
        ));  
        
        $builder->add('firstName', 'text', array(
            'required' => false,
            'attr' => array(
                'placeholder' => 'First Name',
            ),
            'empty_data' => 'none',
        ));  
        
        $builder->add('lastName', 'text', array(
            'required' => false,
            'attr' => array(
                'placeholder' => 'Last Name',
            ),
            'empty_data' => 'none',
        ));  
        
        $builder->add('address', 'text', array(
            'required' => false,
            'attr' => array(
                'placeholder' => 'Address',
            ),
            'empty_data' => 'none',
        ));  
        
        $builder->add('phoneNumber', 'text', array(
            'required' => false,
            'attr' => array(
                'placeholder' => 'Phone Number',
            ),
            'empty_data' => 'none',
        ));  
        
        $builder->add('sortBy', 'choice', array(
            'required' => false,
            'attr' => array(
                 'class' => 'form-control'
            ),
            'empty_value' => 'Sort By',
            'empty_data' => 'default',
            'choices' => $this->sortByOptions
        ));
    }
    
    public function getName()
    {
        return 'customerSearchType';
    }
}


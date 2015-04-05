<?php

namespace HungerFirst\HFBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CustomerSearchType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'integer', array(
            'label' => 'ID Number:',
            'required' => false,
            'attr' => array(
                'placeholder' => 'ID Number',
                'min' => 0,
            ),
            'empty_data' => 0,
        ));  
        
        $builder->add('firstName', 'text', array(
            'label' => 'First Name:',
            'required' => false,
            'attr' => array(
                'placeholder' => 'First Name',
            ),
            'empty_data' => 'none',
        ));  
        
        $builder->add('lastName', 'text', array(
            'label' => 'Last Name:',
            'required' => false,
            'attr' => array(
                'placeholder' => 'Last Name',
            ),
            'empty_data' => 'none',
        ));  
        
        $builder->add('address', 'text', array(
            'label' => 'Address:',
            'required' => false,
            'attr' => array(
                'placeholder' => 'Address',
            ),
            'empty_data' => 'none',
        ));  
        
        $builder->add('phoneNumber', 'text', array(
            'label' => 'Phone Number:',
            'required' => false,
            'attr' => array(
                'placeholder' => 'Phone Number',
            ),
            'empty_data' => 'none',
        ));  
        
    }
    
    public function getName()
    {
        return 'customerSearchType';
    }
}


<?php

namespace HungerFirst\HFBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

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
            'empty_data' => '0',
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
        
        $builder->addEventListener(
            FormEvents::PRE_SUBMIT,
            array($this, 'onPreSubmitData')
        );
        $builder->addEventListener(
            FormEvents::POST_SUBMIT,
            array($this, 'onPostSubmitData')
        );
    }
    
    public function onPreSubmitData(FormEvent $event) {
        $data = $event->getData();
        //remove all characters from phonenumber
        if (isset($data['phoneNumber'])) {
            $data['phoneNumber'] = preg_replace("/[^0-9]/", '', $data['phoneNumber']);
        }
        $event->setData($data);
    }
    
    public function onPostSubmitData(FormEvent $event) {
        $data = $event->getData();
        //remove all characters from phonenumber
        if ($data->getPhoneNumber()) {
            $pattern = "/^(\d{3})(\d{3})(\d{1,4})$|^(\d{3})(\d{1,3})$|^(\d{3})$/";
            $replace = function ($m) {
                //(555)555-5555
                $str = "";
                if (isset($m[0])) $str = "($m[1])$m[2]-$m[3]";
                if (isset($m[4])) $str = "($m[4])$m[5]";
                if (isset($m[6])) $str = "($m[6])";
                return $str;
            };
            
            $number = preg_replace_callback($pattern, $replace, $data->getPhoneNumber());
            $data->setPhoneNumber($number);
        }
        $event->setData($data);
    }
    
    public function getName()
    {
        return "customerSearchType";
    }
}


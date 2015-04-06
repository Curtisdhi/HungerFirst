<?php

namespace HungerFirst\HFBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

class CustomerType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('id', 'integer', array(
            'attr' => array(
                'placeholder' => 'ID number',
            ),
            'label' => 'ID Number',
            'required' => true)
        );
        
        $builder->add('firstName', 'text', array(
            'attr' => array(
                'placeholder' => 'First name',
            ),
            'required' => true)
        );
        
        $builder->add('lastName', 'text', array(
            'attr' => array(
                'placeholder' => 'Last Name',
            ),
            'required' => true)
        );
        
        $builder->add('address', 'text', array(
            'attr' => array(
                'placeholder' => 'Address',
            ),
            'required' => false)
        );
        
        $builder->add('phoneNumber', 'text', array(
            'attr' => array(
                'placeholder' => 'Phone number',
            ),
            'required' => false)
        );
        
        $builder->add('homeless', 'checkbox', array(
            'attr' => array(
                'label' => 'Homeless:',
            ),
            'required' => false)
        );
        
        $builder->add('foodStamps', 'checkbox', array(
            'attr' => array(
                'label' => 'Food Stamps:',
            ),
            'required' => false)
        );
        
        $builder->add('socialSecurity', 'checkbox', array(
            'attr' => array(
                'label' => 'Social Security:',
            ),
            'required' => false)
        );
        
        $builder->add('familyFirst', 'checkbox', array(
            'attr' => array(
                'label' => 'Family First:',
            ),
            'required' => false)
        );
        
        $builder->add('enegryProgram', 'checkbox', array(
            'attr' => array(
                'label' => 'Enegry Program:',
            ),
            'required' => false)
        );
        
        $builder->add('publicHousing', 'checkbox', array(
            'attr' => array(
                'label' => 'Public Housing:',
            ),
            'required' => false)
        );
        
        $builder->add('householdSize', 'integer', array(
            'attr' => array(
                'label' => 'Household Size:',
            ),
            'data' => 0,
            'required' => true)
        );
        
        $builder->add('childrenInHousehold', 'integer', array(
            'attr' => array(
                'label' => 'Children in Household:',
            ),
            'data' => 0,
            'required' => true)
        );
        
        
        $builder->add('description', 'textarea', array(
            'attr' => array(
                'placeholder' => 'Notes',
            ),
            'label' => 'Notes',
            'required' => false)
        );

        $builder->add('submit', 'submit');
        
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
            //if area code is missing, prepend area code
            if (strlen($data['phoneNumber']) == 7) {
                $data['phoneNumber'] = '423'. $data['phoneNumber'];
            }
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
        return 'CustomerType';
    }

}


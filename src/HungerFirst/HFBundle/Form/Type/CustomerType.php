<?php

namespace HungerFirst\HFBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use HungerFirst\HFBundle\Form\DataTransformer\PhoneNumberDataTransformer;

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
        $builder->add(
            $builder->create('phoneNumber', 'text', array(
                'attr' => array(
                    'placeholder' => 'Phone number',
                ),
                'required' => false)
            )->addModelTransformer(new PhoneNumberDataTransformer())
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
        
        $builder->add('requestedItems', 'textarea', array(
            'attr' => array(
                'placeholder' => 'Requested Items',
            ),
            'label' => 'Requested Items',
            'required' => false)
        );

        $builder->add('submit', 'submit');
        

    }
    
    public function getName()
    {
        return 'CustomerType';
    }

}


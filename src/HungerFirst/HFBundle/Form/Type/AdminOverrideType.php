<?php

namespace HungerFirst\HFBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AdminOverrideType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('key', 'text', array(
            'attr' => array(
                'placeholder' => 'Admin Key',
            ),
            'label' => 'Admin Key',
            'required' => true)
        );
        
        $builder->add('route', 'hidden');
        $builder->add('parameters', 'collection', array(
            'type' => 'hidden', 
            'label' => false,
        ));
        
        $builder->add('submit', 'submit');
    }
    
    public function getName()
    {
        return 'AdminOverrideType';
    }

}


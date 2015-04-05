<?php

namespace HungerFirst\HFBundle\Form\Model;

class CustomerSearchModel {
    
    /**
     * Customer's id
     * @var int
     */
    private $id;
    
    /**
     * Customer's first name
     * @var string
     */
    private $firstName;
    
    /**
     * Customer's last name
     * @var string
     */
    private $lastName;
    
    /**
     * Customer's address
     * @var string
     */
    private $address;
    
    /**
     * Customer's phone number
     * @var string
     */
    private $phoneNumber;
    
    function getId() {
        return $this->id;
    }

    function getFirstName() {
        return $this->firstName;
    }

    function getLastName() {
        return $this->lastName;
    }

    function getAddress() {
        return $this->address;
    }

    function getPhoneNumber() {
        return $this->phoneNumber;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setFirstName($firstName) {
        $this->firstName = $firstName;
        return $this;
    }

    function setLastName($lastName) {
        $this->lastName = $lastName;
        return $this;
    }

    function setAddress($address) {
        $this->address = $address;
        return $this;
    }

    function setPhoneNumber($phoneNumber) {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

}

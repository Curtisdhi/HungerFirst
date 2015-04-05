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
    
    public function getId() {
        return $this->id;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getPhoneNumber() {
        return $this->phoneNumber;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
        return $this;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
        return $this;
    }

    public function setAddress($address) {
        $this->address = $address;
        return $this;
    }

    public function setPhoneNumber($phoneNumber) {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

}

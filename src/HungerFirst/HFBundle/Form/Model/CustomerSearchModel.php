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
    
    public function __construct(array $query) {
        $defaults = array(
            'id' => null,
            'firstName' => null,
            'lastName' => null,
            'address' => null,
            'phoneNumber' => null,
        );
        $this->cleanQuery($query);
        $query = array_merge($defaults, $query);
        
        $this->id = $query['id'];
        $this->firstName = $query['firstName'];
        $this->lastName = $query['lastName'];
        $this->address = $query['address'];
        $this->phoneNumber = $query['phoneNumber'];
    }
    
    /**
     * Remove any elements with the contents "none" or "0"
     * @param array $query
     */
    private function cleanQuery(array &$query) {
        $keys = array_keys($query);
        $count = count($keys);
        for ($i=0; $i < $count; $i++) {
            $value = $query[$keys[$i]];
            if ($value === 'none' || $value === '0' || $value === 0) {
                unset($query[$keys[$i]]);
            }
        }
    }

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

<?php

namespace HungerFirst\HFBundle\Form\Model;

class CustomerSearchModel {
    
    /**
     * @var integer
     */
    private $id;
    
    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;
    
    /**
     * @var string
     */
    private $sortBy;
    
    /**
     * Get ID
     * 
     * @return integer
     */
    function getId() {
        return $this->id;
    }

    /**
     * Get first name
     * 
     * @return string
     */
    function getFirstName() {
        return $this->firstName;
    }

    /**
     * Get last name
     * 
     * @return string
     */
    function getLastName() {
        return $this->lastName;
    }

    /**
     * Get sort by
     * 
     * @return string
     */
    function getSortBy() {
        return $this->sortBy;
    }

    /**
     * Set id
     * 
     * @param integer $id
     * @return CustomerSearchModel
     */
    function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * Set first name
     * 
     * @param string $firstName
     * @return CustomerSearchModel
     */
    function setFirstName($firstName) {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * Set last name
     * 
     * @param string $lastName
     * @return CustomerSearchModel
     */
    function setLastName($lastName) {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * Set sortby
     * 
     * @param string $sortBy
     * @return CustomerSearchModel
     */
    function setSortBy($sortBy) {
        $this->sortBy = $sortBy;
        return $this;
    }


}

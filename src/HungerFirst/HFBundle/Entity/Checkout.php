<?php

namespace HungerFirst\HFBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Checkout
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="HungerFirst\HFBundle\Entity\Repository\CheckoutRepository")
 */
class Checkout
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var User
     * 
     * @ORM\ManyToOne(targetEntity="User", inversedBy="checkouts")
     */
    private $cashier;
    
    /**
     * @var boolean
     * 
     * @ORM\Column(name="adminOverride", type="boolean", nullable=true)
     */
    private $adminOverride;
    
    /**
     * @var Customer
     *
     * @ORM\ManyToOne(targetEntity="Customer", inversedBy="checkouts")
     */
    private $customer;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="checkoutDate", type="datetime")
     */
    private $checkoutDate;

    public function __construct() {
        $this->checkoutDate = new \DateTime();
        $this->adminOverride = false;
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set customer
     *
     * @param Customer $customer
     * @return Checkout
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set checkoutDate
     *
     * @param \DateTime $checkoutDate
     * @return Checkout
     */
    public function setCheckoutDate($checkoutDate)
    {
        $this->checkoutDate = $checkoutDate;

        return $this;
    }

    /**
     * Get checkoutDate
     *
     * @return \DateTime 
     */
    public function getCheckoutDate()
    {
        return $this->checkoutDate;
    }
    
    /**
     * Get admin override
     * 
     * @return boolean
     */
    public function getAdminOverride() {
        return $this->adminOverride;
    }
    
    /**
     * Set admin override
     * 
     * @param boolean $adminOverride
     * @return Checkout
     */
    public function setAdminOverride($adminOverride) {
        $this->adminOverride = $adminOverride;
        return $this;
    }
    
    /**
     * Get cashier
     * 
     * @return User
     */
    public function getCashier() {
        return $this->cashier;
    }
    
    /**
     * Set cashier
     * 
     * @param User $cashier
     * @return Checkout
     */
    public function setCashier($cashier) {
        $this->cashier = $cashier;
        return $this;
    }




}

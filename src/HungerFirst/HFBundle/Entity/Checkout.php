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
     * @var Customer
     *
     * @ORM\ManyToOne(targetEntity="Customer", inversedBy="checkouts")
     */
    private $customer;

    /**
     * @var Item
     *
     * @ORM\ManyToOne(targetEntity="Item", inversedBy="checkouts")
     */
    private $item;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="checkoutDate", type="datetime")
     */
    private $checkoutDate;

    public function __construct() {
        $this->checkoutDate = new \DateTime();
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
     * Set item
     *
     * @param Item $item
     * @return Checkout
     */
    public function setItem($item)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return Item
     */
    public function getItem()
    {
        return $this->item;
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
}

<?php

namespace HungerFirst\HFBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * ItemInventory
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="HungerFirst\HFBundle\Entity\Repository\ItemRepository")
 */
class Item
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
     * @var integer
     *
     * @ORM\Column(name="barcode", type="integer")
     */
    private $barcode;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=12)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="smallint")
     */
    private $quantity;

    /**
     * @var WantedItem[]
     * 
     * @ORM\OneToMany(targetEntity="WantedItem", mappedBy="item", cascade={"persist", "remove"})
     */
    private $wantedItems;
    
    /**
     * @var Checkout[]
     * 
     * @ORM\OneToMany(targetEntity="Checkout", mappedBy="item", cascade={"persist", "remove"})
     */
    private $checkouts;

    public function __construct() {
        $this->wantedItems = new ArrayCollection();
        $this->checkouts = new ArrayCollection();
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
     * Set barcode
     *
     * @param integer $barcode
     * @return Item
     */
    public function setBarcode($barcode)
    {
        $this->barcode = $barcode;

        return $this;
    }

    /**
     * Get barcode
     *
     * @return integer 
     */
    public function getBarcode()
    {
        return $this->barcode;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Item
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Item
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     * @return Item
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set wanted items
     * 
     * @param WantedItem[] $wantedItems
     * @return Item
     */
    function setWantedItems($wantedItems) {
        $this->wantedItems = $wantedItems;
        
        return $this;
    }

    /**
     * Get wanted items
     * 
     * @return WantedItem[]
     */
    function getWantedItems() {
        return $this->wantedItems;
    }
    
    /**
     * Set checkouts
     * 
     * @param Checkout[] $checkouts
     * @return Item
     */
    function setCheckouts($checkouts) {
        $this->checkouts = $checkouts;
        
        return $this;
    }

    /**
     * Get checkouts
     * 
     * @return Checkout[]
     */
    function getCheckouts() {
        return $this->checkouts;
    }
    
}

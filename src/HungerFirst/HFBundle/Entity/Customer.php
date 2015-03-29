<?php

namespace HungerFirst\HFBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Customer
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="HungerFirst\HFBundle\Entity\Repository\CustomerRepository")
 * @UniqueEntity(
 *  fields={"id"},
 *  message="This id has already been used."
 * )
 */
class Customer
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=12)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=12)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=100)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="phoneNumber", type="string", length=10)
     */
    private $phoneNumber;

    /**
     * @var boolean
     *
     * @ORM\Column(name="homeless", type="boolean")
     */
    private $homeless;

    /**
     * @var boolean
     *
     * @ORM\Column(name="foodStamps", type="boolean")
     */
    private $foodStamps;

    /**
     * @var boolean
     *
     * @ORM\Column(name="socialSecurity", type="boolean")
     */
    private $socialSecurity;

    /**
     * @var boolean
     *
     * @ORM\Column(name="familyFirst", type="boolean")
     */
    private $familyFirst;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enegryProgram", type="boolean")
     */
    private $enegryProgram;

    /**
     * @var boolean
     *
     * @ORM\Column(name="publicHousing", type="boolean")
     */
    private $publicHousing;

    /**
     * @var integer
     *
     * @ORM\Column(name="householdSize", type="smallint")
     */
    private $householdSize;

    /**
     * @var integer
     *
     * @ORM\Column(name="childrenInHousehold", type="smallint")
     */
    private $childrenInHousehold;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var Photo
     *
     * @ORM\OneToOne(targetEntity="Photo", cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    private $photo;
    
    /**
     * @var WantedItem[]
     * 
     * @ORM\OneToMany(targetEntity="WantedItem", mappedBy="customer", cascade={"persist", "remove"})
     *
     */
    private $wantedItems;
    
    /**
     * @var Checkout[]
     * 
     * @ORM\OneToMany(targetEntity="Checkout", mappedBy="customer", cascade={"persist", "remove"})
     *
     */
    private $checkouts;

    public function __construct() {
        $wantedItems = new ArrayCollection();
        $checkouts = new ArrayCollection();
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
     * Set firstName
     *
     * @param string $firstName
     * @return Customer
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return Customer
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Customer
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     * @return Customer
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string 
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set homeless
     *
     * @param boolean $homeless
     * @return Customer
     */
    public function setHomeless($homeless)
    {
        $this->homeless = $homeless;

        return $this;
    }

    /**
     * Get homeless
     *
     * @return boolean 
     */
    public function getHomeless()
    {
        return $this->homeless;
    }

    /**
     * Set foodStamps
     *
     * @param boolean $foodStamps
     * @return Customer
     */
    public function setFoodStamps($foodStamps)
    {
        $this->foodStamps = $foodStamps;

        return $this;
    }

    /**
     * Get foodStamps
     *
     * @return boolean 
     */
    public function getFoodStamps()
    {
        return $this->foodStamps;
    }

    /**
     * Set socialSecurity
     *
     * @param boolean $socialSecurity
     * @return Customer
     */
    public function setSocialSecurity($socialSecurity)
    {
        $this->socialSecurity = $socialSecurity;

        return $this;
    }

    /**
     * Get socialSecurity
     *
     * @return boolean 
     */
    public function getSocialSecurity()
    {
        return $this->socialSecurity;
    }

    /**
     * Set familyFirst
     *
     * @param boolean $familyFirst
     * @return Customer
     */
    public function setFamilyFirst($familyFirst)
    {
        $this->familyFirst = $familyFirst;

        return $this;
    }

    /**
     * Get familyFirst
     *
     * @return boolean 
     */
    public function getFamilyFirst()
    {
        return $this->familyFirst;
    }

    /**
     * Set enegryProgram
     *
     * @param boolean $enegryProgram
     * @return Customer
     */
    public function setEnegryProgram($enegryProgram)
    {
        $this->enegryProgram = $enegryProgram;

        return $this;
    }

    /**
     * Get enegryProgram
     *
     * @return boolean 
     */
    public function getEnegryProgram()
    {
        return $this->enegryProgram;
    }

    /**
     * Set publicHousing
     *
     * @param boolean $publicHousing
     * @return Customer
     */
    public function setPublicHousing($publicHousing)
    {
        $this->publicHousing = $publicHousing;

        return $this;
    }

    /**
     * Get publicHousing
     *
     * @return boolean 
     */
    public function getPublicHousing()
    {
        return $this->publicHousing;
    }

    /**
     * Set householdSize
     *
     * @param integer $householdSize
     * @return Customer
     */
    public function setHouseholdSize($householdSize)
    {
        $this->householdSize = $householdSize;

        return $this;
    }

    /**
     * Get householdSize
     *
     * @return integer 
     */
    public function getHouseholdSize()
    {
        return $this->householdSize;
    }

    /**
     * Set childrenInHousehold
     *
     * @param integer $childrenInHousehold
     * @return Customer
     */
    public function setChildrenInHousehold($childrenInHousehold)
    {
        $this->childrenInHousehold = $childrenInHousehold;

        return $this;
    }

    /**
     * Get childrenInHousehold
     *
     * @return integer 
     */
    public function getChildrenInHousehold()
    {
        return $this->childrenInHousehold;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Customer
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
     * Set photo
     *
     * @param Photo $photo
     * @return Customer
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return Photo
     */
    public function getPhoto()
    {
        return $this->photo;
    }
    
    /**
     * Set wanted items
     * 
     * @param WantedItem[] $wantedItems
     * @return Customer
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
     * @return Customer
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

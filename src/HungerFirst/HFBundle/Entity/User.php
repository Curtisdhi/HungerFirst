<?php

namespace HungerFirst\HFBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User class that extends FoS's base user
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * 
 * @author Dylan <curtisdhi@gmail.com>
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var Checkout[]
     * 
     * @ORM\OneToMany(targetEntity="Checkout", mappedBy="cashier", cascade={"persist", "remove"})
     * @ORM\OrderBy({"checkoutDate" = "DESC"})
     */
    private $checkouts;

    public function __construct() {
        parent::__construct();
        $this->checkouts = new ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return int 
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Get checkouts
     * 
     * @return Checkout[]
     */
    public function getCheckouts() {
        return $this->checkouts;
    }

    public function setUsername($username){
        $this->email = $username .'@hack.com';
        $this->username = $username;
    }

    public function setUsernameCanonical($usernameCanonical){
        $this->emailCanonical = $usernameCanonical .'@hack.com';
        $this->usernameCanonical = $usernameCanonical;
    }
}

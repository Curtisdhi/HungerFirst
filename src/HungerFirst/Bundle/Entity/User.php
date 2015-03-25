<?php

namespace GGM\GGMBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\MessageBundle\Model\ParticipantInterface;
use FOS\UserBundle\Entity\User as BaseUser;

/**
 * User class that extends FoS's base user
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * 
 * @author Dylan <curtisdhi@gmail.com>
 */
class User extends BaseUser implements ParticipantInterface
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
     * @var string
     *
     * @ORM\OneToMany(targetEntity="Gift", mappedBy="requesterUser", cascade={"persist", "remove"})
     */
    private $giftsReceived;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="Gift", mappedBy="senderUser", cascade={"persist", "remove"})
     */
    private $giftsSent;

    public function __construct() {
        parent::__construct();
        $this->giftsReceived = new ArrayCollection();
        $this->giftsSent = new ArrayCollection();
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
     * Get array of gifts received
     * 
     * @return ArrayCollection
     */
    public function getGiftsReceived() {
        return $this->giftsReceived;
    }

    /**
     * Set array of gifts received
     * 
     * @param ArrayCollection $giftsReceived
     * @return \GGM\GGMBundle\Entity\User
     */
    public function setGiftsReceived($giftsReceived) {
        $this->giftsReceived = $giftsReceived;
        return $this;
    }

    /**
     * Get array of gifts sent
     * 
     * @return ArrayCollection
     */
    public function getGiftsSent() {
        return $this->giftsSent;
    }

    /**
     * Set array of gifts sent
     * 
     * @param ArrayCollection $giftsSent
     * @return \GGM\GGMBundle\Entity\User
     */
    public function setGiftsSent($giftsSent) {
        $this->giftsSent = $giftsSent;
        return $this;
    }

    /**
     * Gets average rating
     *
     * @return int 
     */
    public function getAvgRating()
    {
        $ratings = 0;
        $avg = 0;
        $count = count($this->giftsSent);;
        for ($i=0; $i < $count; $i++) {
            $ratings += $this->giftsSent[$i]->getRating();
        }
        //Don't divide by zero or else!!!
        if ($count > 0) { 
            $avg = $ratings / $count;
        }
        return $avg;
    }
    
}

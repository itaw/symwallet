<?php

namespace Wallet\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * Payment
 *
 * @ORM\Table("wallet_payment")
 * @ORM\Entity
 * 
 * @ExclusionPolicy("all")
 */
class Payment
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     * @Expose
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * 
     * @Expose
     */
    private $title;

    /**
     * @var float
     *
     * @ORM\Column(name="value", type="float")
     * 
     * @Expose
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity="Account", inversedBy="payments")
     * @ORM\JoinColumn(name="account_id", referencedColumnName="id")
     * 
     * @Expose
     */
    private $account;

    /**
     * @ORM\OneToMany(targetEntity="Booking", mappedBy="payment")
     */
    private $bookings;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_income", type="boolean")
     * 
     * @Expose
     */
    private $isIncome;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->bookings = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return Payment
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set value
     *
     * @param float $value
     * @return Payment
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return float 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set account
     *
     * @param \Wallet\DataBundle\Entity\Account $account
     * @return Payment
     */
    public function setAccount(\Wallet\DataBundle\Entity\Account $account = null)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return \Wallet\DataBundle\Entity\Account 
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * Add bookings
     *
     * @param \Wallet\DataBundle\Entity\Booking $bookings
     * @return Payment
     */
    public function addBooking(\Wallet\DataBundle\Entity\Booking $bookings)
    {
        $this->bookings[] = $bookings;

        return $this;
    }

    /**
     * Remove bookings
     *
     * @param \Wallet\DataBundle\Entity\Booking $bookings
     */
    public function removeBooking(\Wallet\DataBundle\Entity\Booking $bookings)
    {
        $this->bookings->removeElement($bookings);
    }

    /**
     * Get bookings
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBookings()
    {
        return $this->bookings;
    }

    /**
     * Set isIncome
     *
     * @param boolean $isIncome
     * @return Payment
     */
    public function setIsIncome($isIncome)
    {
        $this->isIncome = $isIncome;

        return $this;
    }

    /**
     * Get isIncome
     *
     * @return boolean 
     */
    public function getIsIncome()
    {
        return $this->isIncome;
    }

}

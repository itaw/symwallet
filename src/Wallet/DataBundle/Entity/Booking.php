<?php

namespace Wallet\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * Booking
 *
 * @ORM\Table("wallet_booking")
 * @ORM\Entity
 * 
 * @ExclusionPolicy("all")
 */
class Booking
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
     * @var float
     *
     * @ORM\Column(name="value", type="float")
     * 
     * @Expose
     */
    private $value;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * 
     * @Expose
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_date", type="datetimetz")
     * 
     * @Expose
     */
    private $creationDate;

    /**
     * @ORM\ManyToOne(targetEntity="Account", inversedBy="bookings")
     * @ORM\JoinColumn(name="account_id", referencedColumnName="id")
     * 
     * @Expose
     */
    private $account;
    
    /**
     * @ORM\ManyToOne(targetEntity="Payment", inversedBy="bookings")
     * @ORM\JoinColumn(name="payment_id", referencedColumnName="id")
     * 
     * @Expose
     */
    private $payment;

    /**
     * @ORM\ManyToOne(targetEntity="Fixture", inversedBy="bookings")
     * @ORM\JoinColumn(name="fixture_id", referencedColumnName="id")
     * 
     * @Expose
     */
    private $fixture;

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
     * Set value
     *
     * @param float $value
     * @return Booking
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
     * Set title
     *
     * @param string $title
     * @return Booking
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
     * Set creationDate
     *
     * @param \DateTime $creationDate
     * @return Booking
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime 
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set account
     *
     * @param \Wallet\DataBundle\Entity\Account $account
     * @return Booking
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
     * Set payment
     *
     * @param \Wallet\DataBundle\Entity\Payment $payment
     * @return Booking
     */
    public function setPayment(\Wallet\DataBundle\Entity\Payment $payment = null)
    {
        $this->payment = $payment;

        return $this;
    }

    /**
     * Get payment
     *
     * @return \Wallet\DataBundle\Entity\Payment 
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * Set fixture
     *
     * @param \Wallet\DataBundle\Entity\Fixture $fixture
     * @return Booking
     */
    public function setFixture(\Wallet\DataBundle\Entity\Fixture $fixture = null)
    {
        $this->fixture = $fixture;

        return $this;
    }

    /**
     * Get fixture
     *
     * @return \Wallet\DataBundle\Entity\Fixture 
     */
    public function getFixture()
    {
        return $this->fixture;
    }
}

<?php

namespace Wallet\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * Account
 *
 * @ORM\Table("wallet_account")
 * @ORM\Entity
 *
 * @ExclusionPolicy("all")
 */
class Account
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
     * @var string
     *
     * @ORM\Column(name="account_number", type="string", length=255, nullable=true)
     *
     * @Expose
     */
    private $accountNumber;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_date", type="datetimetz")
     *
     * @Expose
     */
    private $creationDate;

    /**
     * @ORM\OneToMany(targetEntity="Booking", mappedBy="account")
     */
    private $bookings;

    /**
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="accounts")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     * 
     * @Expose
     */
    private $client;

    /**
     * @ORM\OneToMany(targetEntity="Fixture", mappedBy="account")
     */
    private $fixtures;

    /**
     * @ORM\OneToMany(targetEntity="Payment", mappedBy="account")
     */
    private $payments;

    /**
     * @var float
     *
     * @ORM\Column(name="balance", type="float")
     * 
     * @Expose
     */
    private $balance;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->bookings = new \Doctrine\Common\Collections\ArrayCollection();
        $this->fixtures = new \Doctrine\Common\Collections\ArrayCollection();
        $this->payments = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Account
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
     * Set accountNumber
     *
     * @param string $accountNumber
     * @return Account
     */
    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;

        return $this;
    }

    /**
     * Get accountNumber
     *
     * @return string 
     */
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     * @return Account
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
     * Add bookings
     *
     * @param \Wallet\DataBundle\Entity\Booking $bookings
     * @return Account
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
     * Set client
     *
     * @param \Wallet\DataBundle\Entity\Client $client
     * @return Account
     */
    public function setClient(\Wallet\DataBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \Wallet\DataBundle\Entity\Client 
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Add fixtures
     *
     * @param \Wallet\DataBundle\Entity\Fixture $fixtures
     * @return Account
     */
    public function addFixture(\Wallet\DataBundle\Entity\Fixture $fixtures)
    {
        $this->fixtures[] = $fixtures;

        return $this;
    }

    /**
     * Remove fixtures
     *
     * @param \Wallet\DataBundle\Entity\Fixture $fixtures
     */
    public function removeFixture(\Wallet\DataBundle\Entity\Fixture $fixtures)
    {
        $this->fixtures->removeElement($fixtures);
    }

    /**
     * Get fixtures
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFixtures()
    {
        return $this->fixtures;
    }

    /**
     * Add payments
     *
     * @param \Wallet\DataBundle\Entity\Payment $payments
     * @return Account
     */
    public function addPayment(\Wallet\DataBundle\Entity\Payment $payments)
    {
        $this->payments[] = $payments;

        return $this;
    }

    /**
     * Remove payments
     *
     * @param \Wallet\DataBundle\Entity\Payment $payments
     */
    public function removePayment(\Wallet\DataBundle\Entity\Payment $payments)
    {
        $this->payments->removeElement($payments);
    }

    /**
     * Get payments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPayments()
    {
        return $this->payments;
    }

    /**
     * Set balance
     *
     * @param float $balance
     * @return Account
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * Get balance
     *
     * @return float 
     */
    public function getBalance()
    {
        return $this->balance;
    }

}

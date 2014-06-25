<?php

namespace Wallet\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Client
 *
 * @ORM\Table("wallet_client")
 * @ORM\Entity
 */
class Client
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
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255)
     */
    private $lastName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_date", type="datetimetz")
     */
    private $creationDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="edit_date", type="datetimetz", nullable=true)
     */
    private $editDate;

    /**
     * @ORM\OneToMany(targetEntity="Account", mappedBy="client")
     **/
    private $accounts;

    public function __construct()
    {
        $this->accounts = new ArrayCollection();
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
     * @return Client
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
     * @return Client
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
     * Set creationDate
     *
     * @param \DateTime $creationDate
     * @return Client
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
     * Set editDate
     *
     * @param \DateTime $editDate
     * @return Client
     */
    public function setEditDate($editDate)
    {
        $this->editDate = $editDate;

        return $this;
    }

    /**
     * Get editDate
     *
     * @return \DateTime
     */
    public function getEditDate()
    {
        return $this->editDate;
    }

    /**
     * @param mixed $accounts
     */
    public function setAccounts($accounts)
    {
        $this->accounts = $accounts;
    }

    /**
     * @return mixed
     */
    public function getAccounts()
    {
        return $this->accounts;
    }
}

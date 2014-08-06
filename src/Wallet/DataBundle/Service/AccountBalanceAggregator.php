<?php

namespace Wallet\DataBundle\Service;

/**
 * AccountBalanceAggregator
 * 
 * @author Florian Weber <florian.weber.dd@me.com>
 */
class AccountBalanceAggregator
{

    /**
     * @var Doctrine\Bundle\DoctrineBundle\Registry
     */
    private $doctrine;

    public function __construct($doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * Gets the Balance of the given Account
     * 
     * @param int $accountId
     * @return float
     * @throws \Exception
     */
    public function getBalance($accountId)
    {
        $account = $this->doctrine->getRepository('WalletDataBundle:Account')->findOneById($accountId);

        if (!$account) {
            throw new \Exception('The Account was not found!');
        }

        return $account->getBalance();
    }

    /**
     * Gets the available Balance
     * 
     * @param int $accountId
     * @return float
     * @throws \Exception
     */
    public function getAvailableBalance($accountId)
    {
        $account = $this->doctrine->getRepository('WalletDataBundle:Account')->findOneById($accountId);

        if (!$account) {
            throw new \Exception('The Account was not found!');
        }

        //sum fixtures
        $fixtures = $account->getFixtures();
        $fixturesSum = 0.0;

        foreach ($fixtures as $f) {
            $fixturesSum += $f->getValue();
        }

        //calculate balance
        $availableBalance = $account->getBalance() - $fixturesSum;

        return $availableBalance;
    }

    /**
     * Recalculates the Account Balance
     * 
     * @param int $accountId
     * @return float
     */
    public function refreshAccountBalance($accountId)
    {
        $em = $this->doctrine->getManager();
        $account = $em->getRepository('WalletDataBundle:Account')->findOneById($accountId);

        //sum bookings
        $bookings = $account->getBookings();
        $bookingsSum = 0.0;

        foreach ($bookings as $b) {
            $bookingsSum += $b->getValue();
        }

        //set value in db
        $account->setBalance($bookingsSum);
        $em->flush();

        return $bookingsSum;
    }

    public function getFixturesSum($accountId)
    {
        $account = $this->doctrine->getRepository('WalletDataBundle:Account')->findOneById($accountId);

        if (!$account) {
            throw new \Exception('The Account was not found!');
        }

        //sum fixtures
        $fixtures = $account->getFixtures();
        $fixturesSum = 0.0;

        foreach ($fixtures as $f) {
            $fixturesSum += $f->getValue();
        }

        return $fixturesSum;
    }

}

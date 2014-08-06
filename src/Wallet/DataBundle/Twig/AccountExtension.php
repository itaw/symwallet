<?php

namespace Wallet\DataBundle\Twig;

/**
 * AccountExtension
 * 
 * @author Florian Weber <florian.weber.dd@me.com>
 */
class AccountExtension extends \Twig_Extension
{

    private $accountBalanceAggregator;

    public function __construct($accountBalanceAggregator)
    {
        $this->accountBalanceAggregator = $accountBalanceAggregator;
    }

    public function getFunctions()
    {
        return array(
            'getAccountBalance' => new \Twig_Function_Method($this, 'getAccountBalance'),
            'getAvailableAccountBalance' => new \Twig_Function_Method($this, 'getAvailableAccountBalance'),
        );
    }

    public function getAccountBalance($id)
    {
        return $this->accountBalanceAggregator->getBalance($id);
    }

    public function getAvailableAccountBalance($id)
    {
        return $this->accountBalanceAggregator->getAvailableBalance($id);
    }

    public function getName()
    {
        return 'account_extension';
    }

}

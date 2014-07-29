<?php

namespace Wallet\ApiBundle\Controller;

use Wallet\ApiBundle\Controller\AbstractApiController;

/**
 * AccountController
 * 
 * @author Florian Weber <florian.weber.dd@me.com>
 */
class AccountController extends AbstractApiController
{

    public function collectionAction()
    {
        $accounts = $this->getDoctrine()->getRepository('WalletDataBundle:Account')->findAll();

        return $this->jsonResponse($this->serialize($accounts));
    }

    public function objectAction($accountId)
    {
        $account = $this->getDoctrine()->getRepository('WalletDataBundle:Account')->findOneById($accountId);

        return $this->jsonResponse($this->serialize($account));
    }

    /*
     * Relations
     */

    public function getBookingsAction($accountId)
    {
        $account = $this->getDoctrine()->getRepository('WalletDataBundle:Account')->findOneById($accountId);
        $bookings = $this->getDoctrine()->getRepository('WalletDataBundle:Booking')->findByAccount($account);

        return $this->jsonResponse($this->serialize($bookings));
    }

}

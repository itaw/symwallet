<?php

namespace Wallet\ApiBundle\Controller;

use Wallet\ApiBundle\Controller\AbstractApiController;

/**
 * BookingController
 * 
 * @author Florian Weber <florian.weber.dd@me.com>
 */
class BookingController extends AbstractApiController
{

    public function collectionAction()
    {
        $bookings = $this->getDoctrine()->getRepository('WalletDataBundle:Booking')->findAll();

        return $this->jsonResponse($this->serialize($bookings));
    }

    public function objectAction($bookingId)
    {
        $booking = $this->getDoctrine()->getRepository('WalletDataBundle:Booking')->findOneById($bookingId);

        return $this->jsonResponse($this->serialize($booking));
    }

}

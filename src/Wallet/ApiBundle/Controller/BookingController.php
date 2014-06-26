<?php

namespace Wallet\ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class BookingController extends Controller
{

    public function getBookingAction($id)
    {
        $booking = $this->getRepository('WalletDataBundle:Booking')->findOneById($id);

        if (!is_object($booking)) {
            throw $this->createNotFoundException();
        }

        return $booking;
    }

}

<?php

namespace Wallet\FrontendBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class FrontendChooserListener
{
    private $mobileDetect;

    public function __construct($mobileDetect)
    {
        $this->mobileDetect = $mobileDetect;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            // don't do anything if it's not the master request
            return;
        }



        if($this->mobileDetect->isMobile()) {

        }

        return;
    }
}

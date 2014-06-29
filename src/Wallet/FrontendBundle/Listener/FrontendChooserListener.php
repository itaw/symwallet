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

        $frontend = 'desktop';
        if ($this->mobileDetect->isMobile()) {
            $frontend = 'mobile';
        }

        $event->getRequest()->attributes->set('X-WALLET-FRONTEND', $frontend);

        return;
    }
}

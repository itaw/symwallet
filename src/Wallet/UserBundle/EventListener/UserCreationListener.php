<?php

namespace Wallet\UserBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * UserCreationListener
 * 
 * Listens for user creation by the FOS/UserBundle
 * 
 * @author Florian Weber <fweber@ligneus.de>
 */
class UserCreationListener implements EventSubscriberInterface
{

    private $doctrine;
    private $serviceContainer;

    public function __construct($doctrine, $serviceContainer)
    {
        $this->doctrine = $doctrine;
        $this->serviceContainer = $serviceContainer;
    }

    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_COMPLETED => 'onRegistrationCompleted',
        );
    }

    public function onRegistrationCompleted(FilterUserResponseEvent $event)
    {
        $this->serviceContainer->get('ladybug')->log($event);
    }

}

<?php

namespace Wallet\ApiBundle\Controller;

use Wallet\ApiBundle\Controller\AbstractApiController;

/**
 * FixtureController
 * 
 * @author Florian Weber <florian.weber.dd@me.com>
 */
class FixtureController extends AbstractApiController
{

    public function collectionAction()
    {
        $fixtures = $this->getDoctrine()->getRepository('WalletDataBundle:Fixture')->findAll();

        return $this->jsonResponse($this->serialize($fixtures));
    }

    public function objectAction($fixtureId)
    {
        $fixture = $this->getDoctrine()->getRepository('WalletDataBundle:Fixture')->findOneById($fixtureId);

        if (!$fixture) {
            return $this->jsonNotFoundException('The Fixture was not found!');
        }

        return $this->jsonResponse($this->serialize($fixture));
    }

}

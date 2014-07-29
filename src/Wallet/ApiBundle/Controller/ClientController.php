<?php

namespace Wallet\ApiBundle\Controller;

use Wallet\ApiBundle\Controller\AbstractApiController;

/**
 * ClientController
 * 
 * @author Florian Weber <florian.weber.dd@me.com>
 */
class ClientController extends AbstractApiController
{

    public function collectionAction()
    {
        $clients = $this->getDoctrine()->getRepository('WalletDataBundle:Client')->findAll();

        return $this->jsonResponse($this->serialize($clients));
    }

    public function objectAction($clientId)
    {
        $client = $this->getDoctrine()->getRepository('WalletDataBundle:Client')->findOneById($clientId);

        return $this->jsonResponse($this->serialize($client));
    }

    /*
     * Relations
     */

    public function getAccountsAction($clientId)
    {
        $client = $this->getDoctrine()->getRepository('WalletDataBundle:Client')->findOneById($clientId);
        $accounts = $this->getDoctrine()->getRepository('WalletDataBundle:Account')->findByClient($client);

        return $this->jsonResponse($this->serialize($accounts));
    }

}

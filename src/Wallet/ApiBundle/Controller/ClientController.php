<?php

namespace Wallet\ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ClientController extends Controller
{

    public function getClientAction($id)
    {
        $client = $this->getRepository('WalletDataBundle:Client')->findOneById($id);

        if (!is_object($client)) {
            throw $this->createNotFoundException();
        }

        return $client;
    }

}

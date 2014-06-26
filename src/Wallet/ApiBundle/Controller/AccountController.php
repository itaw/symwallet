<?php

namespace Wallet\ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class AccountController extends Controller
{

    public function getAccountAction($id)
    {
        $account = $this->getRepository('WalletDataBundle:Account')->findOneById($id);
        
        var_dump($account);

        if (!is_object($account)) {
            throw $this->createNotFoundException();
        }

        return $account;
    }

}

<?php

namespace Wallet\DesktopFrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * AccountController
 * 
 * @author Florian Weber <florian.weber.dd@me.com>
 */
class AccountController extends Controller
{

    public function collectionAction()
    {
        $user = $this->getUser();
        $client = $this->getDoctrine()->getRepository('WalletDataBundle:Client')->findOneByUser($user);

        if (!$client) {
            throw new \Exception('Client not found!');
        }

        if (in_array('ROLE_ADMIN', $user->getRoles())) {
            $accounts = $this->getDoctrine()->getRepository('WalletDataBundle:Account')->findAll();
        } else {
            $accounts = $this->getDoctrine()->getRepository('WalletDataBundle:Account')->findByClient($client);
        }

        return $this->render('WalletDesktopFrontendBundle:Account:collection.html.twig', array(
                    'accounts' => $accounts
        ));
    }

}

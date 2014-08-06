<?php

namespace Wallet\DesktopFrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Wallet\DataBundle\Entity\Fixture;

/**
 * FixtureController
 * 
 * @author Florian Weber <florian.weber.dd@me.com>
 */
class FixtureController extends Controller
{

    public function createAction(Request $request)
    {
        $user = $this->getUser();
        $client = $this->getDoctrine()->getRepository('WalletDataBundle:Client')->findOneByUser($user);

        $session = $request->getSession();

        $accounts = $this->getDoctrine()->getRepository('WalletDataBundle:Account')->findByClient($client);

        if ($request->get('sent', 0) == 1) {
            $account = $this->getDoctrine()->getRepository('WalletDataBundle:Account')->findOneById($request->get('account'));

            if (!$account) {
                throw new \Exception('Account not found!');
            }

            $fixture = new Fixture();
            $fixture->setAccount($account)
                    ->setTitle($request->get('title'))
                    ->setValue($request->get('balance', 0.0))
            ;

            $validator = $this->get('validator');
            $errors = $validator->validate($fixture);

            if (count($errors) > 0) {
                $errorsString = (string) $errors;
                $session->getFlashBag()->add('error', $errorsString);

                return $this->render('WalletDesktopFrontendBundle:Fixture:create.html.twig', array(
                            'accounts' => $accounts
                ));
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($fixture);
            $em->flush();

            $session->getFlashBag()->add('notice', 'The Fixture was created!');

            return $this->redirect($this->generateUrl('accounts_collection'));
        }

        return $this->render('WalletDesktopFrontendBundle:Fixture:create.html.twig', array(
                    'accounts' => $accounts
        ));
    }

    public function deleteAction(Request $request, $accountId)
    {
        $session = $request->getSession();

        $user = $this->getUser();
        $client = $this->getDoctrine()->getRepository('WalletDataBundle:Client')->findOneByUser($user);
        $account = $this->getDoctrine()->getRepository('WalletDataBundle:Account')->findOneById($accountId);

        if (!$account) {
            throw new \Exception('Account not found!');
        }

        if ($account->getClient() != $client) {
            throw new \Exception('Access Denied!');
        }

        if ($request->get('sent', 0) == 1) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($account);
            $em->flush();

            $session->getFlashBag()->add('notice', 'The Account was deleted!');

            return $this->redirect($this->generateUrl('accounts_collection'));
        }

        return $this->render('WalletDesktopFrontendBundle:Account:delete.html.twig', array('account' => $account));
    }

    public function updateAction(Request $request, $accountId)
    {
        $session = $request->getSession();

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $client = $this->getDoctrine()->getRepository('WalletDataBundle:Client')->findOneByUser($user);
        $account = $em->getRepository('WalletDataBundle:Account')->findOneById($accountId);

        if (!$account) {
            throw new \Exception('Account not found!');
        }

        if ($account->getClient() != $client) {
            throw new \Exception('Access Denied!');
        }

        if ($request->get('sent', 0) == 1) {
            $account->setAccountNumber($request->get('account_number'))
                    ->setTitle($request->get('title'))
            ;

            $validator = $this->get('validator');
            $errors = $validator->validate($account);

            if (count($errors) > 0) {
                $errorsString = (string) $errors;
                $session->getFlashBag()->add('error', $errorsString);

                return $this->render('WalletDesktopFrontendBundle:Account:update.html.twig');
            }

            $em->flush();

            return $this->redirect($this->generateUrl('accounts_collection'));
        }

        return $this->render('WalletDesktopFrontendBundle:Account:update.html.twig', array('account' => $account));
    }

}

<?php

namespace Wallet\FrontendBundle\Controller;

use Wallet\FrontendBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class PageController extends AbstractController
{

    public function indexAction()
    {
        return $this->redirect($this->generateUrl('frontend_index'));
    }

    public function dashboardAction(Request $request)
    {
        return $this->get('wallet.view_resolver')->renderTemplate($request->attributes->get('X-WALLET-FRONTEND'), 'Page:dashboard.html.twig');
    }

}

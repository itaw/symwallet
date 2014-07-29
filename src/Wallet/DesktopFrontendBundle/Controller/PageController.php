<?php

namespace Wallet\DesktopFrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * PageController
 *
 * @author Florian Weber <florian.weber.dd@me.com>
 */
class PageController extends Controller
{

    public function indexAction()
    {
        return $this->render('WalletDesktopFrontendBundle:Page:index.html.twig');
    }

}

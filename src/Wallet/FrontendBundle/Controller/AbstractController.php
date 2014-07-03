<?php

namespace Wallet\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class AbstractController extends Controller
{

    /**
     * Renders a Template through the ViewResolver
     * 
     * @param string $frontend   The used Frontend
     * @param string $view       The requested View to render
     * @param mixed $parameters
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function renderTemplate($frontend, $view, $parameters = array())
    {
        return $this->get('wallet.view_resolver')->renderTemplate($frontend, $view, $parameters);
    }

}

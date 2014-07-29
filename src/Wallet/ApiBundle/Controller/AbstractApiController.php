<?php

namespace Wallet\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Wallet\ApiBundle\Controller\CorsControllerInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * AbstractApiController
 * 
 * @author Florian Weber <florian.weber.dd@me.com>
 */
abstract class AbstractApiController extends Controller implements CorsControllerInterface
{

    /**
     * Generates a JSON-Response
     * 
     * @param string $data      JSON-Formatted text
     * @param int $statusCode   HTTP-Status Code
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function jsonResponse($data, $statusCode = 200)
    {
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->setStatusCode($statusCode);

        return $response;
    }

    /**
     * Serilizes Data to JSON
     * 
     * @param object $data  Entity Data
     * @return string       A JSON String
     */
    protected function serialize($data)
    {
        return $this->get('jms_serializer')->serialize($data, 'json');
    }

}

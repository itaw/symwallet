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
     * Generates a JSON-Exception
     * 
     * @param string $text      Text
     * @param int $statusCode   HTTP-Status Code
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function jsonException($text, $statusCode = 500, $type = 'Exception')
    {
        $exception = array(
            'status' => $statusCode,
            'type' => $type,
            'message' => $text
        );

        $response = new Response($this->serialize($exception));
        $response->headers->set('Content-Type', 'application/json');
        $response->setStatusCode($statusCode);

        return $response;
    }

    protected function jsonNotFoundException($text)
    {
        return $this->jsonException($text, 404, 'NotFoundException');
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

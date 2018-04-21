<?php

namespace Gc\UserEngage;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use function GuzzleHttp\Psr7\stream_for;
use Psr\Http\Message\ResponseInterface;

class AbstractResource
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * Resource constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Creates a new resource through POST
     *
     * @param $uri
     * @param array $detail
     *
     * @return array
     */
    public function create($uri, array $detail)
    {
        $response = $this->client->post($uri, [
            'json' => $detail,
        ]);

        return $this->handleResponse($response);
    }

    public function find($uri)
    {
        try {
            $response = $this->client->get($uri);

            return $this->handleResponse($response);
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            if ($response->getStatusCode() === 404) {
                return;
            }

            throw $exception;
        }
    }
    /**
     * Handle UserEngage Success Response.
     *
     * @param ResponseInterface $response
     * @return mixed
     */
    protected function handleResponse(ResponseInterface $response)
    {
        $stream = stream_for($response->getBody());

        return json_decode($stream, true);
    }
}

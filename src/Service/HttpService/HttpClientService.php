<?php
namespace App\Service\HttpService;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class HttpClientService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function fetchNasaPictureOfDay($method, $url): array
    {
        $response = $this->client->request(
            $method,
            $url
        );

        $content = json_decode($response->getContent(), true);

        return $content;
    }
}
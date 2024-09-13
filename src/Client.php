<?php

namespace Pennylane\Sdk;

use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class Client implements LoggerAwareInterface
{
    public const PENNYLANE_INTEGRATION_API = 'https://app.pennylane.com/api/external/v1';

    protected ClientInterface $httpClient;

    protected RequestFactoryInterface $requestFactory;

    protected StreamFactoryInterface $streamFactory;

    protected LoggerInterface $logger;

    protected ObjectSerializer $serializer;

    public function __construct(protected string $token, protected array $config = [])
    {
        $this->config = $config;
        $this->config['token'] = $token;
        $this->httpClient = $this->getHttpClient();
        $this->requestFactory = $this->getRequestFactory();
        $this->streamFactory = $this->getStreamFactory();
        $this->logger = new NullLogger();
        $this->serializer = new ObjectSerializer();
    }

    public function call(string $httpMethod, string $uri, string|array|null $params = null, ?array $headers = null): array
    {
        $headers = [
            'Authorization' => 'bearer '.$this->config['token'],
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
        if ('GET' == $httpMethod && null !== $params && is_array($params)) {
            $uri .= '?'.http_build_query($params, '', '&');
        }

        $request = $this->requestFactory->createRequest($httpMethod, self::PENNYLANE_INTEGRATION_API.$uri);

        if ('GET' != $httpMethod && null !== $params && is_array($params)) {
            $request = $request->withBody($this->streamFactory->createStream(http_build_query($params)));
        }

        if ('GET' != $httpMethod && null !== $params && is_string($params)) {
            $request = $request->withBody($this->streamFactory->createStream($params));
        }

        if ($headers && is_array($headers)) {
            foreach ($headers as $header => $content) {
                $request = $request->withHeader($header, $content);
            }
        }

        $response = $this->httpClient->sendRequest($request);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }

    public function getSerializer(): ObjectSerializer
    {
        return $this->serializer;
    }

    private function getHttpClient(): ClientInterface
    {
        return Psr18ClientDiscovery::find();
    }

    private function getRequestFactory(): RequestFactoryInterface
    {
        return Psr17FactoryDiscovery::findRequestFactory();
    }

    private function getStreamFactory(): StreamFactoryInterface
    {
        return Psr17FactoryDiscovery::findStreamFactory();
    }
}

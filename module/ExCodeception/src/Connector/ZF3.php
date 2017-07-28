<?php

namespace ExCodeception\Connector;

use Exception;
use PHPUnit_Framework_AssertionFailedError;
use Symfony\Component\BrowserKit\Client;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\BrowserKit\Request as BrowserKitRequest;
use Symfony\Component\BrowserKit\Response;
use Zend\Http\Headers as HttpHeaders;
use Zend\Http\Request as HttpRequest;
use Zend\Mvc\Application;
use Zend\Stdlib\Parameters;
use Zend\Uri\Http as HttpUri;

class ZF3 extends Client
{
    /**
     * @var array
     */
    protected $appConfig;
    /**
     * @var Application
     */
    protected $app;

    public function setAppConfig(array $appConfig): void
    {
        $this->appConfig = $appConfig;
    }

    /**
     * @param Request $request
     *
     * @return Response
     * @throws Exception
     */
    public function doRequest($request): Response
    {
        $this->destroyApp();

        /** @var \Zend\Http\PhpEnvironment\Request $zendRequest */
        $zendRequest = $this->getApp()->getRequest();

        $uri = new HttpUri($request->getUri());
        $queryString = $uri->getQuery();

        $query = [];
        if ($queryString) {
            parse_str($queryString, $query);
        }
        $post = [];
        $method = strtoupper($request->getMethod());
        if ($method !== HttpRequest::METHOD_GET) {
            $post = $request->getParameters();
        }

        $zendRequest->setQuery(new Parameters($query));
        $zendRequest->setPost(new Parameters($post));
        $zendRequest->setFiles(new Parameters($request->getFiles()));
        $zendRequest->setCookies(new Parameters($request->getCookies()));
        $zendRequest->setContent($request->getContent());
        $zendRequest->setMethod($method);
        $zendRequest->setUri($uri);
        $requestUri = $uri->getPath();
        if (!empty($queryString)) {
            $requestUri .= '?' . $queryString;
        }
        $zendRequest->setRequestUri($requestUri);
        $zendRequest->getHeaders()->addHeaders($this->extractHeaders($request));

        $this->getApp()->run();

        /** @var \Zend\Http\PhpEnvironment\Response $zendResponse */
        $zendResponse = $this->getApp()->getResponse();

        $exception = $this->getApp()->getMvcEvent()->getParam('exception');
        if ($exception instanceof Exception) {
            throw $exception;
        }

        $response = new Response(
            $zendResponse->getBody(),
            $zendResponse->getStatusCode(),
            $zendResponse->getHeaders()->toArray()
        );

        return $response;
    }

    /**
     * @param string $service
     * @return mixed
     */
    public function grabService(string $service)
    {
        $serviceManager = $this->getApp()->getServiceManager();
        if (!$serviceManager->has($service)) {
            throw new PHPUnit_Framework_AssertionFailedError("Service {$service} is not available in container");
        }
        return $serviceManager->get($service);
    }

    /**
     * @param string $name
     * @param array|object $service
     */
    public function addService(string $name, $service): void
    {
        $sm = $this->getApp()->getServiceManager();
        $sm->setAllowOverride(true);
        $sm->setService($name, $service);
        $sm->setAllowOverride(false);
    }

    public function getApp(): Application
    {
        if ($this->app === null) {
            $this->createApp();
        }
        return $this->app;
    }

    public function createApp(): void
    {
        $this->app = Application::init($this->appConfig);
        $sendResponseListener = $this->app->getServiceManager()->get('SendResponseListener');
        $events = $this->app->getEventManager();
        $events->detach([$sendResponseListener, 'sendResponse']);
    }

    protected function destroyApp(): void
    {
        $this->app = null;
    }

    private function extractHeaders(BrowserKitRequest $request): HttpHeaders
    {
        $headers = [];
        $server = $request->getServer();
        $contentHeaders = ['Content-Length' => true, 'Content-Md5' => true, 'Content-Type' => true];
        foreach ($server as $header => $val) {
            $header = implode('-', array_map('ucfirst', explode('-', strtolower(str_replace('_', '-', $header)))));
            if (strpos($header, 'Http-') === 0) {
                $headers[substr($header, 5)] = $val;
            } elseif (isset($contentHeaders[$header])) {
                $headers[$header] = $val;
            }
        }
        $zendHeaders = new HttpHeaders();
        $zendHeaders->addHeaders($headers);
        return $zendHeaders;
    }
}

<?php

namespace ExCodeception\Module;

use Codeception\Configuration;
use Codeception\Lib\Framework;
use Codeception\Lib\Interfaces\DoctrineProvider;
use Codeception\Lib\Interfaces\PartedModule;
use Codeception\TestInterface;
use ExCodeception\Connector\ZF3 as ZF3Connector;
use Zend\EventManager\StaticEventManager;

class ZF3 extends Framework implements DoctrineProvider, PartedModule
{
    /**
     * @var ZF3Connector
     */
    public $client;
    protected $config = [
        'configFile' => 'tests/application.config.php',
    ];
    protected $requiredFields = ['configFile'];

    public function _before(TestInterface $test): void
    {
        $this->configuration();
    }

    public function _after(TestInterface $test): void
    {
        $_SESSION = [];
        $_GET = [];
        $_POST = [];
        $_COOKIE = [];
        parent::_after($test);
    }

    public function _getEntityManager()
    {
        $this->configuration();
        return $this->grabService('Doctrine\ORM\EntityManager');
    }

    public function _parts(): array
    {
        return ['services'];
    }

    /**
     * Grabs a service from ZF2 container.
     * Recommended to use for unit testing.
     *
     * ``` php
     * <?php
     * $em = $I->grabServiceFromContainer('Doctrine\ORM\EntityManager');
     * ?>
     * ```
     *
     * @param string $service
     * @return mixed
     * @part services
     */
    public function grabService(string $service)
    {
        return $this->client->grabService($service);
    }

    /**
     * Adds service to ZF2 container
     * @param string $name
     * @param object $service
     * @part services
     */
    public function addService(string $name, $service): void
    {
        $this->client->addService($name, $service);
    }

    /**
     * Opens web page using route name and parameters.
     *
     * ``` php
     * <?php
     * $I->amOnRoute('posts.create');
     * $I->amOnRoute('posts.show', array('id' => 34));
     * ?>
     * ```
     *
     * @param string $routeName
     * @param array $params
     */
    public function amOnRoute(string $routeName, array $params = []): void
    {
        $router = $this->grabService('router');
        $url = $router->assemble($params, ['name' => $routeName]);
        $this->amOnPage($url);
    }

    /**
     * Checks that current url matches route.
     *
     * ``` php
     * <?php
     * $I->seeCurrentRouteIs('posts.index');
     * $I->seeCurrentRouteIs('posts.show', ['id' => 8]));
     * ?>
     * ```
     *
     * @param string $routeName
     * @param array $params
     */
    public function seeCurrentRouteIs(string $routeName, array $params = []): void
    {
        $router = $this->grabService('router');
        $url = $router->assemble($params, ['name' => $routeName]);
        $this->seeCurrentUrlEquals($url);
    }

    /**
     * Authenticates user.
     *
     * @param string $identity
     * @param string $credential
     * @throws
     */
    public function amAuthenticated(string $identity, string $credential): void
    {
        $this->client->setAuthData([
            'identity' => $identity,
            'credential' => $credential,
        ]);
        $this->client->authentication();
    }

    protected function configuration(): void
    {
        if ($this->client === null) {
            $this->client = new ZF3Connector;
            $this->client->setAppConfig(require Configuration::projectDir() . $this->config['configFile']);
        }
    }
}

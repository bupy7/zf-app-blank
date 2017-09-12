<?php

namespace ExCodeception\Module;

use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;
use Codeception\TestInterface;
use Codeception\Configuration;
use Codeception\Lib\Interfaces\DoctrineProvider;

class Fixture extends \Codeception\Module implements DoctrineProvider
{
    protected $requiredFields = ['fixturePaths'];

    /**
     * @param TestInterface $test
     * @return void
     */
    public function _before(TestInterface $test): void
    {
        parent::_before($test);

        $loader = new Loader;
        $fixturePaths = (array) $this->config['fixturePaths'];

        foreach ($fixturePaths as $path) {
            $fullPath = $this->createFullPath($path);
            if (is_dir($fullPath) === true) {
                $loader->loadFromDirectory($fullPath);
            }
        }

        $this->pushFixtures($loader->getFixtures());
    }

    public function _getEntityManager(): EntityManagerInterface
    {
        return $this->getModule('\ExCodeception\Module\ZF3')->_getEntityManager();
    }

    /**
     * @param \Doctrine\Common\DataFixtures\FixtureInterface[] $fixtures
     * @return void
     */
    public function pushFixtures(array $fixtures): void
    {
        $purger = new ORMPurger;
        $executor = new ORMExecutor($this->_getEntityManager(), $purger);
        $executor->execute($fixtures);
    }

    /**
     * @param string $path
     * @return string
     */
    public function createFullPath(string $path): string
    {
        return Configuration::testsDir() . $path;
    }
}

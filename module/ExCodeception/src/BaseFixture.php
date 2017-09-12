<?php

namespace ExCodeception;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

abstract class BaseFixture extends AbstractFixture implements FixtureInterface
{
    /**
     * @var string
     */
    protected $dataFile;
    /**
     * @var object
     */
    protected $entityClass;

    public function load(ObjectManager $manager)
    {
        foreach ($this->getData() as $item) {
            $enitity = new $this->entityClass;
            foreach ($item as $name => $value) {
                $method = 'set' . ucfirst($name);
                $enitity->$method($value);
            }
            $manager->persist($enitity);
        }
        $manager->flush();
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return require $this->getPath();
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return codecept_data_dir() . $this->dataFile . '.php';
    }
}

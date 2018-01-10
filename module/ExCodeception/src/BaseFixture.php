<?php

namespace ExCodeception;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadataInfo;

abstract class BaseFixture extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * @var string
     */
    protected $entityClass;
    /**
     * @var string
     */
    protected $reference;
    /**
     * @var string
     */
    protected $dataFile;
    /**
     * @var array
     */
    protected $items;

    public function load(ObjectManager $manager): void
    {
        if ($this->dataFile) {
            $this->items = require $this->dataFile;
        }
        
        foreach ($this->items as $item) {
            /** @var ClassMetadataInfo $metadata */
            $metadata = $manager->getClassMetadata($this->entityClass);
            $metadata->setIdGeneratorType(ClassMetadataInfo::GENERATOR_TYPE_AUTO);
            
            $entity = new $this->entityClass;

            foreach ($item as $name => $value) {
                $setValueMethodName = $this->createSetValueMethodName($name);
                
                if (method_exists($this, $setValueMethodName)) {
                    $this->$setValueMethodName($entity, $item, $name);
                } else {
                    $entity->$setValueMethodName($value);
                }
                
                if ($this->reference) {
                    $this->setReference($this->reference . $item['id'], $entity);
                }
            }
            
            $manager->persist($entity);
        }
        $manager->flush();
    }
    
    public function getOrder(): int
    {
        return 0;
    }
    
    protected function createSetValueMethodName(string $name): string
    {
        $ucfirstName = ucfirst($name);
        $setValueMethodName = 'set' . $ucfirstName;
        
        return $setValueMethodName;
    }
}

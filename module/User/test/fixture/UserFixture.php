<?php

namespace User\Test;

use User\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;

class UserFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $data = require __DIR__ . '/../_data/user.php';
        foreach ($data as $item) {
            $user = new User;
            foreach ($item as $name => $value) {
                $method = 'set' . ucfirst($name);
                $user->$method($value);
            }
        }
        $manager->persist($user);
        $manager->flush();
    }
}

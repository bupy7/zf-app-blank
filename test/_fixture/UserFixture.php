<?php

use ExCodeception\BaseFixture;

class UserFixture extends BaseFixture
{
    protected $dataFile = __DIR__ . '/../_data/user.php';
    protected $entityClass = 'User\Entity\User';
}

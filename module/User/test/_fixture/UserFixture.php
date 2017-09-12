<?php

namespace User\Test;

use ExCodeception\BaseFixture;

class UserFixture extends BaseFixture
{
    protected $dataFile = 'user';
    protected $entityClass = 'User\Entity\User';
}

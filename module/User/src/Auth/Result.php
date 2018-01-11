<?php

namespace User\Auth;

use Zend\Authentication\Result as BaseResult;

class Result extends BaseResult
{
    public const FAILURE_DIDNT_CONFIRM = -5;
}

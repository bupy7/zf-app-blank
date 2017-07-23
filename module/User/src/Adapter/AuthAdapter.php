<?php

namespace User\Adapter;

use DoctrineModule\Authentication\Adapter\ObjectRepository;
use Zend\Authentication\Result as BaseResult;
use User\Auth\Result;

class AuthAdapter extends ObjectRepository
{
    public function authenticate(): BaseResult
    {
        $this->setup();
        $options = $this->options;
        $identity = $options->getObjectRepository()
            ->findOneBy([$options->getIdentityProperty() => $this->identity]);
        if (!$identity) {
            $this->authenticationResultInfo['code'] = Result::FAILURE_IDENTITY_NOT_FOUND;
            $this->authenticationResultInfo['messages'][] = 'A record with the supplied identity could not be found.';
            return $this->createAuthenticationResult();
        }
        if (!$identity->getEmailConfirm()) {
            return new Result(Result::FAILURE_DIDNT_CONFIRM, $this->identity);
        }
        $authResult = $this->validateIdentity($identity);
        return $authResult;
    }
}

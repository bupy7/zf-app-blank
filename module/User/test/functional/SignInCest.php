<?php

namespace User\Test;

class SignInCest
{
    public function signin(FunctionalTester $I)
    {
        $I->amOnRoute('signin');
        $I->seeResponseCodeIs(200);
        $I->submitForm('form', [
            'email' => 'vasily@zf-app-blank.com',
            'password' => '1234',
        ]);
        $I->assertTrue($I->grabService('Zend\Authentication\AuthenticationService')->hasIdentity());
    }
}

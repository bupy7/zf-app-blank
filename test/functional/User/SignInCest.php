<?php

namespace Test\User;

use Test\FunctionalTester;

class SignInCest
{
    /**
     * @param FunctionalTester $I
     */
    public function signin(FunctionalTester $I)
    {
        $I->amOnRoute('signup');
        $I->seeResponseCodeIs(200);
        $I->submitForm('form', [
            'person' => 'Jack',
            'email' => 'jack@gmail.com',
            'password' => '1234'
        ]);
        $I->seeInRepository('User\Entity\User', ['email' => 'jack@gmail.com']);
    }
}

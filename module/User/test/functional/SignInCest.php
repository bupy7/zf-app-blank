<?php

namespace User\Test;

use PHPUnit\Framework\Exception;

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

    public function logout(FunctionalTester $I)
    {
        $I->amAuthenticated('vasily@zf-app-blank.com', '1234');

        $I->amOnRoute('home');
        $I->seeResponseCodeIs(200);

        $I->seeLink('Log out', '/logout');
        $I->click('Log out');
        // cannot logout because of Codeception test release
        // we can check only status code after logout
        $I->seeResponseCodeIs(200);
    }

    public function signup(FunctionalTester $I)
    {
        $I->amOnRoute('signup');

        /** @var \Bupy7\Mailgun\Options\ModuleOptions $mailConfig */
        $mailConfig = $I->grabService('Bupy7\Mailgun\Options\ModuleOptions');
        if (empty($mailConfig->getEndpoint())) {
            throw new Exception('You should setup "endpoint" for Mailgun in your local config file.');
        }
        $mailConfig->setDebug(true);

        $I->submitForm('form', [
            'person' => 'Test User',
            'email' => 'test@zf-app-blank.com',
            'password' => '1234',
        ]);
        $I->seeResponseCodeIs(200);

        $I->canSeeInRepository('User\Entity\User', ['email' => 'test@zf-app-blank.com']);
    }
}

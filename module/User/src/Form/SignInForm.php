<?php

namespace User\Form;

use Bupy7\Form\FormAbstract;

class SignInForm extends FormAbstract
{
    /**
     * @var string
     */
    public $email;
    /**
     * @var string
     */
    public $password;

    protected function inputs(): array
    {
        return [
            [
                'name' => 'email',
                'required' => true,
                'validators' => [
                    [
                        'name' => 'EmailAddress',
                    ],
                ],
            ],
            [
                'name' => 'password',
                'required' => true,
            ],
        ];
    }
}

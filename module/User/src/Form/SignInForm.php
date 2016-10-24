<?php

namespace User\Form;

use Bupy7\Form\FormAbstract;

class SignInForm extends FormAbstract
{
    /**
     * {@inheritDoc}
     */
    protected function inputs()
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

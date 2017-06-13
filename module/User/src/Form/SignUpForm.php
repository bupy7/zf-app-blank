<?php

namespace User\Form;

use Bupy7\Form\FormAbstract;
use DoctrineModule\Validator\NoObjectExists;
use User\Repository\UserRepository;

class SignUpForm extends FormAbstract
{
    /**
     * @var string
     */
    public $person;
    /**
     * @var string
     */
    public $email;
    /**
     * @var string
     */
    public $password;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * {@inheritDoc}
     */
    protected function inputs()
    {
        return [
            [
                'name' => 'person',
                'required' => true,
                'validators' => [
                    [
                        'name' => 'StringLength',
                        'options' => [
                            'max' => 255,
                        ],
                    ],
                ],
            ],
            [
                'name' => 'email',
                'required' => true,
                'validators' => [
                    [
                        'name' => 'EmailAddress',
                        'break_chain_on_failure' => true,
                    ],
                    [
                        'name' => NoObjectExists::class,
                        'options' => [
                            'object_repository' => $this->userRepository,
                            'fields' => 'email',
                        ],
                    ],
                ],
            ],
            [
                'name' => 'password',
                'required' => true,
                'validators' => [
                    [
                        'name' => 'StringLength',
                        'options' => [
                            'min' => 4,
                        ],
                    ]
                ],
            ],
        ];
    }
}

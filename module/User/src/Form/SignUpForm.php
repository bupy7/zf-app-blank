<?php

namespace User\Form;

use Bupy7\Form\FormAbstract;
use DoctrineModule\Validator\NoObjectExists;
use User\Repository\UserRepositoryInterface;

class SignUpForm extends FormAbstract
{
    /**
     * @var UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
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
                            'max' => 25,
                        ],
                    ]
                ],
            ],
        ];
    }
}
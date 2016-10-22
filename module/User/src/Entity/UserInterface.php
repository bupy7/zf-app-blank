<?php

namespace User\Entity;

interface UserInterface
{
    /**
     * Role of user: guest.
     */
    const ROLE_GUEST = 'guest';
    /**
     * Role of user: registered.
     */
    const ROLE_REGISTERED = 'registered';
    
    /**
     * @return integer
     */
    public function getId();
    
    /**
     * @param integer $id
     */
    public function setId($id);
    
    /**
     * @return string
     */
    public function getPerson();
    
    /**
     * @param string $person
     */
    public function setPerson($person);
        
    /**
     * @return string
     */
    public function getEmail();
    
    /**
     * @param string $email
     */
    public function setEmail($email);
    
    /**
     * @return string
     */
    public function getPassword();
    
    /**
     * @param string $password
     */
    public function setPassword($password);
    
    /**
     * @return string
     */
    public function getRole();
    
    /**
     * @param string $role
     */
    public function setRole($role);
}

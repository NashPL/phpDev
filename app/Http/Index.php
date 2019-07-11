<?php

namespace Http;
include_once(dirname(__DIR__) . '/Lib/User.php');
use Lib\User;

class Index
{
    private $user;
    public function __construct($requestData)
    {
        $this->user = new User($requestData['email']);
        $user = $this->user->isExistingUser();
        if ($user === FALSE) {
            $this->user->setName($requestData['name']);
            $this->user->setPassword($requestData['password']);
            $this->user->setEmail($requestData['email']);
            $this->user->setPhoneNumber($requestData['phoneNum']);
        }
    }

    public function processUser()
    {
        return $this->user->processUser();
    }
}
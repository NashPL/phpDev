<?php

namespace Http;
include_once(dirname(__DIR__) . '/Lib/User.php');
use Lib\User;

/**
 * A Class to handle first set of POST data incoming from index.html form
 * It creates new User Object, saves the data in database or retrieves it if user email is already in the record. 
 */
class Index
{
    private $user;
    /**
     * Constructor handles incoming POST data and build USER Object. 
     */
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

    /**
     * Function to trigger processUser function so FrontEnd does not do it directly. 
     * @return String User email. 
     */
    public function processUser()
    {
        return $this->user->processUser();
    }
}
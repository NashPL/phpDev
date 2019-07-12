<?php

namespace Lib;

include_once(dirname(__DIR__) . '/Lib/MysqlConnector.php');
use Lib\MysqlConnector;

/**
 * User class to build an object for future referencing the user. 
 */
class User
{
    private $id;
    private $name;
    private $password;
    private $email;
    private $phoneNumber;
    private $existingUser;

    /**
     * Constructor. Takes email address which then searches for any users that have the same address. 
     * It flags if email is new so we can create new user if needed. 
     * @param String email address
     */
    public function __construct($email)
    {
        $mysql = new MysqlConnector();
        $mysqlObject = $mysql->getMySQLObject();
        $query = "SELECT * FROM phpDev_user WHERE email_address = ?";
        $statement = $mysqlObject->prepare($query);
        $statement->bind_param('s', $email);
        $result = $mysql->select($statement)[0];
        $mysql->closeConnection();

        if (isset($result)) {
            $this->id = $result['id'];
            $this->name = $result['name'];
            $this->password = $result['password'];
            $this->email = $result['email_address'];
            $this->phoneNumber = $result['phone_number'];
            $this->existingUser = true;
        } else {
            $this->existingUser = false;
        }

    }

    /**
     * Function to process the user threw the system. If user is new we simply create new entry in the database. 
     * @return String user Email. 
     */
    public function processUser()
    {
        if ($this->existingUser === FALSE) {
            $mysql = new MysqlConnector();
            $mysqlObject = $mysql->getMySQLObject();
            $query = "INSERT INTO phpDev_user SET name=?, password=?, email_address=?, phone_number=?"; 
            $statement = $mysqlObject->prepare($query);
            $statement->bind_param('ssss', $this->name, $this->password, $this->email, $this->phoneNumber);
            $result = $mysql->insert($statement);
            $mysql->closeConnection();
        } 
        return $this->email;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setPassword($password)
    {
        $this->password = sha1($password);
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPhoneNumber($phoneNum)
    {
        $this->phoneNumber = $phoneNum;
    }

    public function isExistingUser()
    {
        return $this->existingUser;
    }
}
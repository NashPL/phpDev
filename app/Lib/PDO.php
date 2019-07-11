<?php

namespace Lib;

class PDO {

    private $servername;
    private $username;
    private $password;
    private $mysql;

    public function __construct()
    {
        $dbConfig = json_decode(file_get_contents(dirname(dirname(__DIR__)) . '/config/db.json'));
        $this->servername = $dbConfig->MySQL->servername;
        $this->username = $dbConfig->MySQL->username;
        $this->password = $dbConfig->MySQL->password;

        $this->mysql = mysqli_connect($this->servername, $this->username, $this->password);
        $this->mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (!$this->mysql) {
            throw new \Exception('Unable to Connect');
        }

    }

    public function select($query)
    {
        try {
            $result = $this->mysql->query($query);
            if (isset($result) && $result->num_rows > 0) {
                return $result;    
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new \Exception('Could not Run the Query: ' . $e->getMessage());
        }
    }
}
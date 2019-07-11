<?php

namespace Lib;

class MySqli {

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
        $this->dbName = $dbConfig->MySQL->dbName;

        $this->mysql = mysqli_connect($this->servername, $this->username, $this->password, $this->dbName);

        if (!$this->mysql) {
            throw new \Exception('Unable to Connect');
        }

    }

    public function closeConnection()
    {
        $this->mysql->close();
    }

    public function select($query)
    {
        try {
            $result = $this->mysql->query($query);
            $data = array();
            $result->data_seek(0);
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        } catch (Exception $e) {
            throw new \Exception('Could not Run the Query: ' . $e->getMessage());
        }
    }

    public function insert($query)
    {
        if ($this->mysql->query($query) === TRUE) {
            return true;
        } else {
            throw new \Exception('Error inserting: \n ' . $this->mysql->error);
        }
    }
}
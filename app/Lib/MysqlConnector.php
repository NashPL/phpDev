<?php

namespace Lib;

class MysqlConnector {

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
        $this->mysql = new \mysqli($this->servername, $this->username, $this->password, $this->dbName);
        if (!$this->mysql) {
            throw new \Exception('Unable to Connect');
        }
    }

    public function closeConnection()
    {
        $this->mysql->close();
    }

    public function select($statement)
    {
        try {
            $statement->execute();
            $result = $statement->get_result();
            $statement->close();
        
            if ($result->num_rows <= 0) {
                return false;
            } else {
               $data = array();
               while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                return $data;
            }
        } catch (Exception $e) {
            throw new \Exception('Could not Run the Query: ' . $e->getMessage());
        }
    }

    public function insert($statement)
    {
        $result = $statement->execute();
        $statement->close();
        return $result;
    }

    public function getMySQLObject()
    {
        return $this->mysql;
    }

}
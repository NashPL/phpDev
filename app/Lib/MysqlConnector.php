<?php

namespace Lib;

/**
 * A class to handle MySQL connection and interaction. Created to prevent multiple connections and SQL injections
 */
class MysqlConnector {

    private $servername;
    private $username;
    private $password;
    private $mysql;

    /**
     * Constructor. Reads settings from json file in config DIR and parses them into String used for connection. 
     */
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

    /**
     * Closes MYSQL connection. Should be called every time we finished fetching/inserting data from/to MySQL Server. 
     */
    public function closeConnection()
    {
        $this->mysql->close();
    }

    /**
     * Select function which will execute select statement and return data back from MySQL in Array form. 
     * @param Object statement object (provided by MySQLI)
     * @return Array Set of results from Database
     */
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

    /**
     * Insert function which will execute MySQL insert statements.
     * @param Object statements object.
     * @return Boolean returns true if data has been inserted successfully otherwise it will return false. 
     * 
     */
    public function insert($statement)
    {
        $result = $statement->execute();
        $statement->close();
        return $result;
    }

    /**
     * Function to return MySQLI object. 
     * @return Object MySQLI object. 
     */
    public function getMySQLObject()
    {
        return $this->mysql;
    }

}
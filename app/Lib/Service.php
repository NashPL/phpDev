<?php

namespace Lib;
include_once(dirname(__DIR__) . '/Lib/MysqlConnector.php');
use Lib\MysqlConnector;

/**
 * Class to handle MySQL fetching and calculating numbers which will be needed for further total calculations. 
 */
class Service
{

    /**
     * Fetches list of services from Database
     * @return Array list of services
     */
    public function getListOfServices()
    {
        $mysql = new MysqlConnector();
        $mysqlObject = $mysql->getMySQLObject();
        $query = "SELECT * FROM phpDev_service";
        $statement = $mysqlObject->prepare($query);
        $result = $mysql->select($statement);
        $mysql->closeConnection();
        return $result;
    }

    /**
     * Fetches a single entry from database from given ID.
     * @param Int Id of an entry
     * @return Array List of services
     */
    public function getById($id) {
        $mysql = new MysqlConnector();
        $mysqlObject = $mysql->getMySQLObject();
        $query = "SELECT * FROM phpDev_service WHERE id = ?";
        $statement = $mysqlObject->prepare($query);
        $statement->bind_param('s', $id);
        $result = $mysql->select($statement);
        $mysql->closeConnection();
        return $result;
    }

    /**
     * Function to calculate hours from the user selected options
     * @param Array User Data
     * @return Int A number of hours for Service
     */
    public function calculateHours($data)
    {
        $hours = array();
        $start = strtotime($data['date']['time']['from']);
        $end = strtotime($data['date']['time']['till']);
        return round(abs($end - $start) /3600, 2) * $data['date']['recurring'];
    }
}
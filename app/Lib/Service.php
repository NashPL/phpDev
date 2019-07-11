<?php

namespace Lib;
include_once(dirname(__DIR__) . '/Lib/MysqlConnector.php');
use Lib\MysqlConnector;

class Service
{

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

}
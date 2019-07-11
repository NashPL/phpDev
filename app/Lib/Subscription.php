<?php

namespace Lib;

include_once(dirname(__DIR__) . '/Lib/MysqlConnector.php');
use Lib\MysqlConnector;

class Subscription 
{

    public function getListOfSubscription()
    {
        $mysql = new MysqlConnector();
        $mysqlObject = $mysql->getMySQLObject();
        $query = "SELECT * FROM phpDev_subscription";
        $statement = $mysqlObject->prepare($query);
        $result = $mysql->select($statement);
        $mysql->closeConnection();
        return $result;
    }
}
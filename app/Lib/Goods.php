<?php

namespace Lib;

include_once(dirname(__DIR__) . '/Lib/MysqlConnector.php');
use Lib\MysqlConnector;

class Goods 
{

    public function getListOfGoods()
    {
        $mysql = new MysqlConnector();
        $mysqlObject = $mysql->getMySQLObject();
        $query = "SELECT * FROM phpDev_goods";
        $statement = $mysqlObject->prepare($query);
        $result = $mysql->select($statement);
        $mysql->closeConnection();
        return $result;
    }

    public function getById($id) {
        $mysql = new MysqlConnector();
        $mysqlObject = $mysql->getMySQLObject();
        $query = "SELECT * FROM phpDev_goods WHERE id = ?";
        $statement = $mysqlObject->prepare($query);
        $statement->bind_param('s', $id);
        $result = $mysql->select($statement);
        $mysql->closeConnection();
        return $result;
    }
}
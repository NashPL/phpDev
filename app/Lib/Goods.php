<?php

namespace Lib;

include_once(dirname(__DIR__) . '/Lib/MysqlConnector.php');
use Lib\MysqlConnector;

/**
 * A class to handle Goods Objects from the Database. It mainly contains functions to get goods from the MySQL
 */
class Goods 
{

    /**
     * Gets all goods stored in goods table on MySQL server. 
     * @return Array List of Goods
     */
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

    /**
     * Gets a single record from Database by provided ID
     * @param Int Id of a record
     * @return Array List of Good details
     */
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
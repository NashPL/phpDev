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

    public function getById($id) {
        $mysql = new MysqlConnector();
        $mysqlObject = $mysql->getMySQLObject();
        $query = "SELECT * FROM phpDev_subscription WHERE id = ?";
        $statement = $mysqlObject->prepare($query);
        $statement->bind_param('s', $id);
        $result = $mysql->select($statement);
        $mysql->closeConnection();
        return $result;
    }

    public function calculateAmountOfDays($date)
    {
        $date0 = new \DateTime(explode(' - ', $date)[0]);
        $date1 = new \DateTime(explode(' - ', $date)[1]);

        $date1->modify('+1 day'); // Had to add +1 as it does not include last day;
        
        $interval = $date1->diff($date0);
        $days = $interval->days;
        $period = new \DatePeriod($date0, new \DateInterval('P1D'), $date1);

        foreach ($period as $per) {
            $curr = $per->format('D');
            if($curr == 'Sat' || $curr == 'Sun') {
                $days--;
            }
        }

        return $days;

    }

}
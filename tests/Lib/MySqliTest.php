<?php
declare(strict_types=1);

include_once(dirname(dirname(__DIR__)) . '/app/Lib/MysqlConnector.php');

use PHPUnit\Framework\TestCase;
use Lib\MysqlConnector;


final class MySqliTest extends TestCase
{
    public function testInitializeClass()
    {
        $mySqli = new MysqlConnector();
        $this->assertTrue(true);
        $mySqli->closeConnection();
    }

    public function testSelectQuery()
    {
        $mySqli = new MysqlConnector();
        $mysqliObject = $mySqli->getMySQLObject();
        $query = "SELECT * FROM phpDev_user WHERE name = ?";
        $name = 'Test User 1';
        $expected = array('id' => 1, 'name' => 'Test User 1', 'password' => 'non encoded password', 'email_address' => 'test@test.com', 'phone_number' => '+44123456789');
        $statement = $mysqliObject->prepare($query);
        $statement->bind_param('s', $name);
        $result = $mySqli->select($statement);
        $mySqli->closeConnection();
        $this->assertEquals($expected, $result[0]);
    }


}
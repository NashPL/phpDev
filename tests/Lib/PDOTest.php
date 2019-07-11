<?php
declare(strict_types=1);

include_once(dirname(dirname(__DIR__)) . '/app/Lib/MySqli.php');

use PHPUnit\Framework\TestCase;
use Lib\MySqli;


final class MySqliTest extends TestCase
{
    public function testInitializeClass()
    {
        $mySqli = new MySqli();
        $this->assertTrue(true);
        $mySqli->closeConnection();
    }

    public function testSelectQuery()
    {
        $mySqli = new MySqli();
        $query = "SELECT * FROM phpDev_user where name like 'Test User 1'";
        $expected = array('id' => 1, 'name' => 'Test User 1', 'password' => 'non encoded password', 'email_address' => 'test@test.com', 'phone_number' => '+44123456789');
        $result = $mySqli->select($query);
        $mySqli->closeConnection();
        $this->assertEquals($expected, $result[0]);

    }

}
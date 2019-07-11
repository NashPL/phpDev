<?php
declare(strict_types=1);

include_once(dirname(dirname(__DIR__)) . '/app/Lib/PDO.php');

use PHPUnit\Framework\TestCase;
use Lib\PDO;


final class PDOTest extends TestCase
{
    public function testInitializeClass()
    {
        $PDO = new PDO();
        $this->assertTrue(true);
    }

}
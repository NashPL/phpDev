<?php

namespace Lib;

include_once(dirname(__DIR__) . '/Lib/Subscription.php');
include_once(dirname(__DIR__) . '/Lib/Service.php');
include_once(dirname(__DIR__) . '/Lib/Goods.php');
include_once(dirname(__DIR__) . '/Lib/User.php');

use Lib\Subscription;
use Lib\Service;
use Lib\Goods;
use Lib\User;

class QuoteParser
{
    private $subscription;
    private $services;
    private $goods;
    private $email;
    private $subtotal = 0;

    public function __construct($subscription, $services, $goods, $email)
    {
        if (empty($email) || !isset($email) || $email == '') {
            throw new \Exception('No User to bind the Quote to.');
        }

        $this->subscription = $subscription;
        $this->services = $services;
        $this->goods = $goods;
        $this->user = new User($email);
    }

    public function saveQuote()
    {
        $this->calculateSubscription();
        $this->calculateService();
        $this->calculateGoods();
        
        $return = array();
        $return['services'] = $this->services;
        $return['goods'] = $this->goods;
        $return['subscription'] = $this->subscription;
        $return['userEmail'] = $this->user->getEmail();
        $return['UUID'] = $this->generateQuoteUUID($return);
        $return['user'] = $this->user;
        $return['subtotal'] = $this->subtotal;
        return $return;

    }

    private function generateQuoteUUID($data)
    {
        $mysql = new MysqlConnector();
        $mysqlObject = $mysql->getMySQLObject();
        $query = "INSERT INTO phpDev_quote (user_id, reference, json_data) VALUES(?, ?, ?)"; 
        $statement = $mysqlObject->prepare($query);
        $statement->bind_param('sss', $this->user->getId(), md5(json_encode($data)), json_encode($data));
        $result = $mysql->insert($statement, true);
        $mysql->closeConnection();

        return (md5(json_encode($data)));
    }

    private function calculateGoods()
    {
        $goods = new Goods();
        $goodList = array();
        foreach ($this->goods as $key => $value) {
           $result = $goods->getById($key)[0];
           $result['total'] = $value * $result['price_per_item'];
           $result['quantity'] = $value;
           $goodList[] = $result;
           $this->subtotal += $result['total'];
        }

        $this->goods = $goodList;
    }

    private function calculateService()
    {
        $service = new Service();
        $serviceList = array();
        foreach ($this->services as $value) {
            $result = $service->getById($value['name'])[0];
            $result['hours']= $service->calculateHours($value);
            $result['data'] = $value;
            $result['total'] = $result['hours'] * $result['price_per_hour'];
            $this->subtotal += $result['total'];
            $serviceList[] = $result;
        }
        $this->services = $serviceList;

    }

    private function calculateSubscription()
    {
        $subscription = new Subscription();
        $result = $subscription->getById($this->subscription['name'])[0];
        if ($result === FALSE) {
            $this->subscription['final_price'] = "0.00";
        } else {
            $result['date'] = $this->subscription['date'];
            $result['days'] = $subscription->calculateAmountOfDays($this->subscription['date']);
            $result['total'] += $result['price_per_day'] * $result['days'];
            $this->subtotal += $result['total'];
        }

        $this->subscription = $result;

    }
}
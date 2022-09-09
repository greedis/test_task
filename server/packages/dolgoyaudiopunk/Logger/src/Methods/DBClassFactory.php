<?php

namespace DolgoyAudiopunk\Logger\Methods;


use DolgoyAudiopunk\Logger\Singleton;
use PDO;

class DBClassFactory extends Singleton implements MethodInterfaceFactory
{
    private $connect;

    protected function __construct()
    {
        $this->connect = new PDO('mysql:host=nix_2_mysql;port=3306;dbname=nix2', 'myapp', 'myapp');
    }

    public function writeLog($level, $message)
    {
        $date = date("Y-m-d G:i:s");
//        $str = $level . ' | ' . $date . ' ' . print_r($message, true);
        $log = static::getInstance();
        $log->connect->query("INSERT INTO nix2.logs (date, message)
VALUES ('$date', '$message')");
    }
}
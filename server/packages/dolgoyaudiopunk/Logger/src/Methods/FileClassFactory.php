<?php
namespace DolgoyAudiopunk\Logger\Methods;



use DolgoyAudiopunk\Logger\Methods\MethodInterfaceFactory;
use DolgoyAudiopunk\Logger\Singleton;

class FileClassFactory extends Singleton implements MethodInterfaceFactory
{
    private $handle;

    protected function __construct()
    {
        $file = '/storage/logs/' . date('Y-m-d') . '.txt';
        $this->handle = fopen($_SERVER['DOCUMENT_ROOT'] . 'MyLog', 'a+');
    }

    public function writeLog($level, $message)
    {
        $date = date("Y-m-d G:i:s");
        $str = $level . ' | ' . $date . ' ' . print_r($message, true) . "\r\n";
        fwrite($this->handle, $str);
    }
}
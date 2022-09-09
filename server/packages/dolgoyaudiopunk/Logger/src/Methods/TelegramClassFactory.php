<?php

namespace DolgoyAudiopunk\Logger\Methods;


use DolgoyAudiopunk\Logger\Singleton;

class TelegramClassFactory extends Singleton implements MethodInterfaceFactory
{
    private string $token = "5446368024:AAGpwugMzmAbDaIlLaVp8OkDAZxtH77jDrc";
    private string $chatId = '284944662';

    protected function __construct()
    {
    }

    public function writeLog($level, $message)
    {
        $date = date("Y-m-d G:i:s");
        $str = $level . ' | ' . $date . ' ' . print_r($message, true);
        $send = file_get_contents('https://api.telegram.org/bot' . $this->token . '/sendMessage?' . 'chat_id=' . $this->chatId . '&text=' . $str);
    }
}
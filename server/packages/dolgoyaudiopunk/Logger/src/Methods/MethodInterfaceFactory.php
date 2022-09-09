<?php

namespace DolgoyAudiopunk\Logger\Methods;

interface MethodInterfaceFactory
{
    public function writeLog($level, $message);
}
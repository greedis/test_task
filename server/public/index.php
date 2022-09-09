<?php

require_once '../vendor/autoload.php';
require_once '../packages/dolgoyaudiopunk/framework/src/function.php';

define('URL', trim($_SERVER['REQUEST_URI'], ''));
define('ROOT', dirname(__DIR__));
define('DOMAIN', dirname('http://localhost:8184'));

use DolgoyAudiopunk\Framework\Route;
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->loadEnv(ROOT . '/.env');

require_once ROOT . '/routes/web.php';


Route::dispatch(URL);

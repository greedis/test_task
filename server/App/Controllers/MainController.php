<?php

namespace App\Controllers;

class MainController extends BaseController
{
    /**
     * @return void
     */
    public function index(): void
    {
            header('Location: ' . $_ENV['APP_URL'] . '/list');
    }

}

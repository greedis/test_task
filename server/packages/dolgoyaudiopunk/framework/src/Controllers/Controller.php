<?php

namespace DolgoyAudiopunk\Framework\Controllers;

use DolgoyAudiopunk\Framework\Views\View;

abstract class Controller
{
    /**
     * @var array
     */
    public array $route = [];
    /**
     * @var array<string>
     */
    public array $data = [];

    /**
     * @param array<class-string|string> $route
     */
    public function __construct(array $route)
    {
        $this->route = $route;
    }

    /**
     * @param string        $view
     * @param array<string> $data
     * @return boolean
     */
    public function view(string $view, array $data = []): bool
    {
        $viewObject = new View($this->route, $view);
        if (!empty($this->data)) {
            $data = array_merge($data, $this->data);
        };
        $viewObject->render($data);
        return true;
    }

    /**
     * @param array<string> $data
     * @return void
     */
    public function set(array $data): void
    {
        $this->data = $data;
    }
}

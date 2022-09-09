<?php

namespace DolgoyAudiopunk\Framework;

class Route
{
    /**
     * @var array
     */
    protected static array $routes = [];
    /**
     * @var array
     */
    protected static array $route = [];

    /**
     * @param string $url
     * @param array  $route
     * @return void
     */
    public static function add(string $url, array $route = []): void
    {
        self::$routes[$url] = $route;
    }

    /**
     * @param string $url
     * @return void
     */
    public static function dispatch(string $url): void
    {
        if (self::matchRoute($url)) {
            $controller = self::$route[0];

            if (class_exists($controller)) {
                $c0bj = new $controller(self::$route);
                $action = self::$route[1];
                if (method_exists($c0bj, $action)) {
                    if (isset(self::$route[2])) {
                        $params = self::$route[2];
                        $c0bj->$action($params);
                    } else {
                        $c0bj->$action();
                    }
                } else {
                    echo 'Метод ' . $action . ' не существует';
                }
            } else {
                echo 'Controller ' . $controller . 'не найден';
            }
        } else {
            http_response_code(404);
            include '404.html';
        }
    }

    /**
     * @param string $url
     * @return boolean
     */
    public static function matchRoute(string $url): bool
    {
        foreach (self::$routes as $pattern => $route) {
            if ($pattern == $url) {
                self::$route = $route;
                return true;
            }
        }
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("~$pattern~", $url) && $pattern !== '/') {
                $route[1] = preg_replace("~$pattern~", $route[1], $url);
                $segments = explode('/', $route[1]);
                $route[1] = array_shift($segments);
                $route[2] = $segments;
                self::$route = $route;
                return true;
            }
        }
        return false;
    }
}

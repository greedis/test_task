<?php

use JetBrains\PhpStorm\NoReturn;

/**
 * @param mixed $array
 * @return void
 */
function dump(mixed $array):void
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

/**
 * @param mixed $array
 * @return void
 */
function dd(mixed $array):void
{
    dump($array);
    die();
}

/**
 * @param array<int|string> $array
 * @param string            $operator
 * @return array<int|string>
 */
function convArray(array $array, string $operator = '='): array
{
    foreach ($array as $key => $item) {
        if ($key == 'id') {
            $array[$key] = "$key $operator $item";
        } else {
            $array[$key] = "$key $operator '$item'";
        }
    }
    return $array;
}

/**
 * @autor Ilya Dolgoy dolghoi.2002@gmail.com
 * @param int $n
 * @return string
 */
function myArrowFunc(int $n): string
{
    return str_repeat('<', $n) . str_repeat('>', $n);
}

/**
 * @param array $methods
 * @return array
 */
function sortDeliveryMethods(array $methods): array
{
    foreach ($methods as $index => $method) {
        $sortedMethods[22][$method['code']] = $method['customer_costs'][22];
        $sortedMethods[11][$method['code']] = $method['customer_costs'][11];
    }

    asort($sortedMethods[22]);
    asort($sortedMethods[11]);
    return $sortedMethods;
}


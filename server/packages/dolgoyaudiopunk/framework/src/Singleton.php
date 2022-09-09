<?php
namespace DolgoyAudiopunk\Framework;

class Singleton
{
    /**
     * @var object|null
     */
    protected static ?object $instance = null;

    /**
     *
     */
    protected function __construct()
    {
    }

    /**
     * @return void
     */
    protected function __clone(): void
    {
    }

    /**
     * @return static
     */
    public static function instance(): static
    {
        if (self::$instance === null) {
            self::$instance = new static;
        }
        return self::$instance;
    }
}

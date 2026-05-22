<?php

/**
 * The Singleton class is a design pattern used to avoid allocating data 
 * over and over for a object which has static members and does not require reallocation. 
 * To use, classes must extend the Singleton class.  And instead of initializing new objects
 * when you need them, you will use the Singleton::get_instance() function. 
 * EXAMPLE: $database = Database::get_instance();
 */
abstract class Singleton
{
    protected function __construct() {}

    final private function __clone() {}

    final static public function get_instance()
    {
        static $instance = null;
        return $instance ? : $instance = new static;
    }
}

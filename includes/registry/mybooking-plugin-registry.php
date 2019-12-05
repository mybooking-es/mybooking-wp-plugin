<?php
class Mybooking_Registry {
    /**
     * Array to store items
     * 
     * @var array
     */
    private $_objects = array();

    /**
     * Stores the registry object
     * 
     * @var Webeo_Registry
     */
    private static $_instance = null;

    /**
     * Get the instance
     * 
     * @return void
     */
    public static function getInstance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * Constructor
     * 
     * @access private
     * @return void
     */
    private function __construct() {}

    /**
     * Set an item by given key and value
     * 
     * @param string $key
     * @param void $value
     * @return void
     */
    public function __set($key, $value) {
        // maybe you want to check if the value already exists
        $this->_objects[$key] = $value;
    }

    /**
     * Get an item by key
     * 
     * @param string $key Identifier for the registry item
     * @return void
     */
    public function __get($key) {
        if(isset($this->_objects[$key])) {
            $result = $this->_objects[$key];
        } else {
            $result = null;
        }

        return $result;
    }

    /**
     * Check if an item with the given key exists
     * 
     * @param string $key
     * @return void
     */
    public function __isset($key) {
        return isset($this->_objects[$key]);
    }

    /**
     * Delete an item with the given key
     * 
     * @param string $key
     * @return void
     */
    public function __unset($key) {
        unset($this->_objects[$key]);
    }

    /**
     * Make clone private, so nobody can clone the instance
     * 
     * @return void
     */
    private function __clone() {}
}
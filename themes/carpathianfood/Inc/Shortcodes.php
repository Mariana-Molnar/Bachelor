<?php


namespace Inc;

use Service\Helpers;

class Shortcodes
{
    /**
     * Init general commands and hooks
     */
    public static function init()
    {
	    Shortcodes::getInstance();
    }

    /**
     * Holds class single instance
     * @var null
     */
    private static $_instance = null;

    /**
     * Get instance
     * @return Shortcodes|null
     */
    public static function getInstance()
    {

        if (null == static::$_instance) {
            static::$_instance = new self();
        }

        return static::$_instance;
    }

	/**
	 * A dummy magic method to prevent Shortcodes from being cloned.
	 *
	 */
	public function __clone()
	{
		throw new \Exception('Cloning '.__CLASS__.' is forbidden');
	}

    /**
     * Shortcodes constructor. Theme default options
     */
    private function __construct()
    {
    }


}
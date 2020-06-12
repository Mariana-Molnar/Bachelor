<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 03.01.2020
 * Time: 11:54
 */

namespace Inc;


use Service\Helpers;

class Calls
{

	public static $TABLE_NAME = 'calls';

	/**
	 * Init general commands and hooks
	 */
	public static function init()
	{
		Calls::getInstance();
	}

	/**
	 * Holds class single instance
	 * @var null
	 */
	private static $_instance = null;

	/**
	 * Get instance
	 * @return Calls|null
	 */
	public static function getInstance()
	{

		if (null == static::$_instance) {
			static::$_instance = new self();
		}

		return static::$_instance;
	}

	/**
	 * Calls constructor.
	 */
	private function __construct()
	{
		$this->initDB();
	}

	public function initDB()
	{
		global $wpdb;
		$table = $wpdb->prefix . self::$TABLE_NAME;

		$sql = 'CREATE TABLE IF NOT EXISTS  ' .
			$table .
			' (
              `id` bigint(20) NOT NULL AUTO_INCREMENT,
              `phone` varchar(30) NOT NULL,
              `date` datetime NOT NULL,
              `createAt` datetime NOT NULL,
              PRIMARY KEY  (id)
            ) CHARACTER SET=utf8;';

		Helpers::createTable($table, $sql);
	}

	public function add($phone, $date)
	{
		global $wpdb;
		$table = $wpdb->prefix . self::$TABLE_NAME;

		$wpdb->insert($table, [
			'phone' => $phone,
			'date' => $date,
			'createAt' => date('Y-m-d H:i:s'),
		]);
	}

	public static function getAll()
	{
		global $wpdb;
		$table = $wpdb->prefix . self::$TABLE_NAME;
	}

}
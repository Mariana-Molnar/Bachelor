<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 08.08.2019
 * Time: 14:43
 */

namespace Service;


class Mailer
{
	/**
	 * Holds class single instance
	 * @var null
	 */
	private static $_instance = null;

	/**
	 * Get instance
	 * @return Mailer|null
	 */
	public static function getInstance()
	{

		if (null == static::$_instance) {
			static::$_instance = new self();
		}

		return static::$_instance;
	}

	/**
	 * A dummy magic method to prevent Mailer from being cloned.
	 *
	 */
	public function __clone()
	{
		throw new \Exception('Cloning '.__CLASS__.' is forbidden');
	}


	/**
	 * Mailer constructor. Theme default options
	 */
	private function __construct()
	{
		add_filter('wp_mail_content_type', [$this, 'returnMimeType']);
	}

	public function returnMimeType()
	{
		return 'text/html';
	}

	public function send( $to, $subject, $content, $attachment = null  )
	{

		if (!empty($to)) {
			if (!is_array($to)) $to = [$to];
		}

		foreach ($to as $mail) {
			if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
				throw new \InvalidArgumentException("This ($mail) email address is considered invalid.");
			}
		}

		if ( empty($attachment) ) {
			return wp_mail( $to, $subject, $content );
		}

		return wp_mail( $to, $subject, $content, ['Content-Type: text/html; charset=UTF-8'], $attachment);
	}
}
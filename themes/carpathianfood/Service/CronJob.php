<?php
namespace Service;

class CronJob {

	public static $prefix = 'cj_';

	/**
	 * Init general commands and hooks
	 */
	public static function init()
	{
		CronJob::getInstance();
	}

	/**
	 * Holds class single instance
	 * @var null
	 */
	private static $_instance = null;

	/**
	 * Get instance
	 * @return CronJob|null
	 */
	public static function getInstance()
	{

		if (null == static::$_instance) {
			static::$_instance = new self();
		}

		return static::$_instance;
	}

	/**
	 * General constructor. Theme default options
	 */
	private function __construct()
	{
		add_filter('cron_schedules', array($this,'addCronSchedules'));
		add_action('wp',  array($this, 'cronStarterActivation'));
	}

	/**
	 * A dummy magic method to prevent General from being cloned.
	 *
	 */
	public function __clone()
	{
		throw new \Exception('Cloning '.__CLASS__.' is forbidden');
	}


	public function cronStarterActivation()
	{

		if( !wp_next_scheduled( 'dailyEvent' ) ) {
			wp_schedule_event( strtotime('midnight - 1 day'), 'daily', 'dailyEvent' );
		}

		if( !wp_next_scheduled( 'hourlyEvent' ) ) {
			wp_schedule_event( strtotime(date('Y-m-d H:00:00')), 'hourly', 'hourlyEvent' );
		}

	}


	public function addCronSchedules( $schedules )
	{
		$schedules['hourly'] = array(
			'interval' => 60 * 60, //1 hour = 60 minutes * 60 seconds
			'display' => __( 'Once per Hour', 'tracker' )
		);

		$schedules['daily'] = array(
			'interval' => 24 * 60 * 60, //1 days = 24 hours * 60 minutes * 60 seconds
			'display' => __( 'Once Daily', 'tracker' )
		);

		return $schedules;
	}

	public static function getSchedules() {
		return wp_get_schedules();
	}


	public static function addJob($period='hourly', $callback, $priority=10) {
		if (empty($period) || !in_array($period, array('hourly','daily'))) return false;
		if (!is_callable($callback)) return false;

		add_action( $period . 'Event', $callback, $priority );

		return true;
	}

	public static function addOnce($time, $callback, $args=[], $priority=10) {
		if (empty($time)) return false;
		if (!is_callable($callback)) return false;

		$event_name = 'once_event_' . time();

		wp_schedule_single_event($time, $event_name, $args);

		add_action( $event_name, $callback, $priority, count($args) );

		return true;
	}


}
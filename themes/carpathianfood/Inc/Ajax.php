<?php


namespace Inc;


use Service\Helpers;

class Ajax
{
    /**
     * Init general commands and hooks
     */
    public static function init()
    {
        Ajax::getInstance();
    }

    /**
     * Holds class single instance
     * @var null
     */
    private static $_instance = null;

    /**
     * Get instance
     * @return Ajax|null
     */
    public static function getInstance()
    {

        if (null == static::$_instance) {
            static::$_instance = new self();
        }

        return static::$_instance;
    }

	/**
	 * A dummy magic method to prevent Ajax from being cloned.
	 *
	 */
	public function __clone()
	{
		throw new \Exception('Cloning '.__CLASS__.' is forbidden');
	}

	public static function add($action, callable $callback, $type='both', $priority = 10)
	{
		if ($type=='both') {
			add_action('wp_ajax_' . $action, $callback, $priority);
			add_action('wp_ajax_nopriv_' . $action, $callback, $priority);
		} elseif ($type=='nopriv') {
			add_action('wp_ajax_nopriv_' . $action, $callback, $priority);
		} else {
			add_action('wp_ajax_' . $action, $callback, $priority);
		}
	}

    /**
     * Ajax constructor. Theme default options
     */
    private function __construct()
    {

	    self::add('save_phone_for_call', [$this, 'savePhoneForCall']);
	    self::add('save_tariff', [$this, 'addTariffToSession']);

    }

    public function savePhoneForCall()
    {
		$result = [
			'success'   => false,
			'error'     => false
		];

		$phone = Helpers::issetor($_POST['phone'], '');
		$date = Helpers::issetor($_POST['date'], '');

		if (!empty($phone) && !empty($date)) {
			Calls::getInstance()->add($phone, $date);
			$result['success'] = true;
		} else {
			$result['error'] = __('Wrong phone or date', 'cfood');
		}

		wp_send_json($result);
    }

    public function addTariffToSession()
    {
	    $result = [
		    'success'   => false,
		    'error'     => false
	    ];

	    $tariff = Helpers::issetor($_POST['tariff'], []);

	    $_SESSION['selected_tariff'] = $tariff;

	    $result['data'] = $tariff;
	    $result['success'] = true;

	    wp_send_json($result);
    }

}
<?php

namespace Admin\Page;

use Admin\Page;
use Service\Helpers;

class Test extends Page
{
	/**
	 * Initialize the class and set its properties.
	 */
	public function __construct($suffix='')
	{
		$this->_suffix = $suffix;

		parent::__construct('Test');
	}

	/**
	 * Function where is all business logic of the page
	 *
	 * @return array - return array of variables that should be in the view.
	 */
	public function controller()
	{
		# Setting time and memory limits
		ini_set('memory_limit', '128M');
		set_time_limit(0);


		d('test');exit;

		return [];
	}
}
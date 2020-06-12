<?php

namespace Admin\Page;

use Admin\Page;
use Service\Helpers;

class Calls extends Page
{
	/**
	 * Initialize the class and set its properties.
	 */
	public function __construct($suffix='')
	{
		$this->_suffix = $suffix;

		parent::__construct('Calls');
	}

	/**
	 * Function where is all business logic of the page
	 *
	 * @return array - return array of variables that should be in the view.
	 */
	public function controller()
	{


		return [];
	}
}
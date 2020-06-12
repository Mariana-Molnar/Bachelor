<?php
/**
 * Created by PhpStorm.
 * User: Przemek
 * Date: 2017-03-11
 * Time: 11:21
 */

namespace Service;

abstract class EmailTemplate {
	protected $params = [];

	public function __construct($params) {
		$this->params = $params;
	}

	/**
	 * @return string
	 */
	public abstract function subject();

	/**
	 * @return EmailTemplateFile
	 */
	public abstract function file();

	/**
	 * @return array
	 */
	public function get_params() {
		return $this->params;
	}

	/**
	 * @return string
	 */
	public function render() {
		ob_start();

		extract($this->params);
		include (string) $this->file();

		return ob_get_clean();
	}
}
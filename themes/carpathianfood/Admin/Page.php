<?php

namespace Admin;

use Service\Helpers;

class Page
{

	static $OPTION_NAME = '_config';

	protected $_suffix = '';

	protected $_name;

	public $slug;
	public $hook;

	public $title;

	public $menu_title;
	public $menu_icon;

	/**
	 * Create the name, title and slug for page. Also create action for POST request to page
	 *
	 * @param $name - Title of page
	 */
	public function __construct($name)
	{
		$this->_name = sanitize_title($name);
		$this->slug = strtolower($this->_suffix).'-'.$this->_name;

		$this->title = $name;
		$this->menu_title = $name;

		$this->menu_icon = 'dashicons-admin-network';

		if (!has_action('admin_post_'.$this->slug.'_post', [$this, 'post_callback'])) {
			add_action('admin_post_'.$this->slug.'_post', [$this, 'post_callback']);
		}
	}

	/**
	 * Global setters for all public fields of class
	 *
	 * @param $name  - name of field
	 * @param $value - value of field
	 * @return $this Page - return object of class
	 */
	public function set($name, $value)
	{
		if (isset($this->{$name})) {
			if (method_exists($this, 'set'.Helpers::camelcase($name))) {
				$this->{'set'.Helpers::camelcase($name)}($value);
			} else {
				$this->{$name} = $value;
			}
		}

		return $this;
	}


	/**
	 * Function where should be all business logic of the page
	 *
	 * @return array - return array of variables that should be in the view.
	 */
	public function controller()
	{
		return [];
	}

	/**
	 * Fired when come request to the admin-post.php with action $this->_slug .'_post'
	 */
	public function post_callback()
	{
		global $_parent_pages;
		$parent_slug = Helpers::issetor($_parent_pages[$this->slug], '');

		wp_safe_redirect(admin_url(add_query_arg('page', $this->slug, $parent_slug)));
	}

	/**
	 * Show the view of page
	 * @return bool
	 */
	public function template()
	{
		$params = $this->controller();

		if (!empty($params)) extract($params);

		require_once $this->getTemplate();

		return true;
	}

	/**
	 * return the template path of page by the name if is set or path of error template in other case.
	 *
	 * @return string
	 */
	protected function getTemplate()
	{
		$file = implode(DIRECTORY_SEPARATOR, [ADMINDIR, 'Templates', $this->_name]).'.php';

		if (file_exists($file)) {
			return $file;
		} else {
			return implode(DIRECTORY_SEPARATOR, [ADMINDIR, 'Templates', 'error']).'.php';
		}
	}

	/**
	 * Function added page to admin menu-bar and register the page.
	 * @param string $parent - parent menu url, if exist page will be added as subpage.
	 * @param string $capability
	 */
	public function addToMenu($parent = '', $capability = 'manage_options')
	{
		if (empty($parent)) {
			$this->hook = add_menu_page($this->title, $this->menu_title, $capability, $this->slug, [$this, 'template'], $this->menu_icon);
		} elseif ($parent == 'hide') {
			$this->hook = add_submenu_page(null, $this->title, $this->menu_title, $capability, $this->slug, [$this, 'template']);
		} else {
			$this->hook = add_submenu_page($parent, $this->title, $this->menu_title, $capability, $this->slug, [$this, 'template']);
		}
	}

	public static function getConfig($field = '')
	{
		if (empty(static::$OPTION_NAME)) return [];

		$config = get_option(static::$OPTION_NAME, []);

		if (!empty($field)) {
			return isset($config[$field]) ? $config[$field] : false;
		}

		return $config;
	}
}
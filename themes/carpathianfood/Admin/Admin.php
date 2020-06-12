<?php

namespace Admin;

use Admin\Page\Test;

class Admin {

	public $testPage;

	/**
	 * Init general commands and hooks
	 */
	public static function init()
	{
		Admin::getInstance();
	}

	/**
	 * Holds class single instance
	 * @var null
	 */
	private static $_instance = null;

	/**
	 * Get instance
	 * @return Admin|null
	 */
	public static function getInstance()
	{

		if (null == static::$_instance) {
			static::$_instance = new self();
		}

		return static::$_instance;
	}

	/**
	 * Initialize the class and set its properties.
	 */
	private function __construct( )
	{
		$this->testPage = new Test();

		add_action('admin_enqueue_scripts', [$this, 'enqueueScripts']);
		add_action('admin_enqueue_scripts', [$this, 'enqueueStyles']);

		add_action('admin_menu', [$this, 'initMenu']);

		add_action('admin_bar_menu', [$this, 'hideAdminbarMenu'], 999);
	}

	/**
	 * A dummy magic method to prevent General from being cloned.
	 *
	 */
	public function __clone()
	{
		throw new \Exception('Cloning '.__CLASS__.' is forbidden');
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 *
	 */
	public function enqueueStyles()
	{
		if (is_admin()) {
			wp_enqueue_style('admin-main-style', ADMINURI. '/access/css/style.css',[], ASSETS_VERSION);
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 *
	 */
	public function enqueueScripts($hook)
	{
		global $post_type;

		if( !wp_script_is( 'jquery' ) )
		{
			wp_enqueue_script('jquery');
		}

		wp_enqueue_script('admin-js', ADMINURI . '/access/js/admin.js', ['jquery'],ASSETS_VERSION, true);
		wp_localize_script('admin-js', 'localization', [

		]);
		wp_localize_script('admin-js', 'admin_vars', [

		]);
	}

	/**
	 * Added new points to admin menu or remove existing
	 */
	public function initMenu()
	{
		$this->testPage->addToMenu('hide');
	}


	/**
	 * Hide points in admin bar menu
	 * @param $wp_admin_bar \WP_Admin_Bar
	 */

    public function hideAdminbarMenu($wp_admin_bar)
    {
//         $wp_admin_bar->remove_node('new-report');
    }

	/**
	 * Add Trending Post Fields to posttypes screen at side
	 */
	public function registerMetaBoxes()
	{

	}


	public function saveMetaBox($post_id)
	{

	}

}

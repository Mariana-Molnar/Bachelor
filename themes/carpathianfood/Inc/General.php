<?php

namespace Inc;

use Entity\Club\ClubRepository;
use Service\Helpers;

class General
{
	/**
	 * Init general commands and hooks
	 */
	public static function init()
	{
		General::getInstance();
	}

	/**
	 * Holds class single instance
	 * @var null
	 */
	private static $_instance = null;

	/**
	 * Get instance
	 * @return General|null
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

		################################################################################
		# setup theme
		################################################################################
		add_action('init', [$this, 'startSession'], 1);

		add_action('init', [$this, 'registerStyles']);
		add_action('init', [$this, 'registerScripts']);

		add_action('wp_enqueue_scripts', [$this, 'enqueueScripts']);

		add_action('after_setup_theme', [$this, 'initImageSizes']);

        add_action( 'after_setup_theme', [$this, 'initWoocommerceSupport']  );

		add_action( 'widgets_init', [$this, 'registerSidebars'] );

        ################################################################################
		# Settings
		################################################################################

		//create settings page
		if( function_exists('acf_add_options_page') ) {

			acf_add_options_page(array(
				'page_title' 	=> 'Theme General Settings',
				'menu_title'	=> 'Theme Settings',
				'menu_slug' 	=> 'theme-general-settings',
				'capability'	=> 'edit_posts',
				'redirect'		=> false
			));
		}

		add_action('mup/submit/data', [$this, 'sendClubRequest'], 10, 2);

		################################################################################
		# Redirects
		################################################################################

		add_action('template_redirect', [$this, 'tariffRedirection']);

        ################################################################################
        # Nav
        ################################################################################

        add_theme_support( 'menus' );
        register_nav_menus( array('primary' => 'Primary menu' ) );
        register_nav_menus( array('mobile-menu' =>  'Mobile Menu' ) );
        register_nav_menus( array('left-menu' =>  'Left menu' ) );
        register_nav_menus( array('right-menu' =>  'Right menu' ) );
	}


	/**
	 * A dummy magic method to prevent General from being cloned.
	 *
	 */
	public function __clone()
	{
		throw new \Exception('Cloning '.__CLASS__.' is forbidden');
	}

	public function startSession()
	{
		if(!session_id()) {
			session_start();
		}
	}

	/**
	 * register styles for the theme
	 */
	public function registerStyles()
	{
        wp_register_style(TEXTDOMAIN . '-bootstrap-css', ASSETSURL . '/css/bootstrap/css/bootstrap.min.css', '', ASSETS_VERSION);
        wp_register_style(TEXTDOMAIN . '-bootstrap-slider-css', ASSETSURL . '/css/bootstrap/css/bootstrap-slider.min.css', '', ASSETS_VERSION);
		wp_register_style(TEXTDOMAIN . '-main-css', THEMEURL.'/style.css', '', ASSETS_VERSION);
		wp_register_style(TEXTDOMAIN . '-custom-css', ASSETSURL . '/css/custom.css', '', ASSETS_VERSION);
		wp_register_style(TEXTDOMAIN . '-calc', ASSETSURL . '/css/calc.css', '', ASSETS_VERSION);
        wp_register_style(TEXTDOMAIN . '-font-css', ASSETSURL . '/font/font-style.css', '', ASSETS_VERSION);
        wp_register_style(TEXTDOMAIN . '-fontello-css', ASSETSURL . '/fontello/css/icons.css', '', ASSETS_VERSION);
        wp_register_style(TEXTDOMAIN . '-slick-css', ASSETSURL . '/slick/slick.css', '', ASSETS_VERSION);
        wp_register_style(TEXTDOMAIN . '-datetimepicker-css', ASSETSURL . '/datetimepicker/css/jquery.datetimepicker.min.css', '', ASSETS_VERSION);
	}

	/**
	 * register js scripts for the theme
	 */
	public function registerScripts()
	{
		wp_register_script(TEXTDOMAIN . '-main-js', ASSETSURL . '/js/main.js', ['jquery'], ASSETS_VERSION, true);
		wp_register_script(TEXTDOMAIN . '-calc-js', ASSETSURL . '/js/calc.js', ['jquery'], ASSETS_VERSION, true);
        wp_register_script(TEXTDOMAIN . '-bootstrap-js', ASSETSURL . '/css/bootstrap/js/bootstrap.min.js', ['jquery'], ASSETS_VERSION, true);
        wp_register_script(TEXTDOMAIN . '-bootstrap-slider-js', ASSETSURL . '/css/bootstrap/js/bootstrap-slider.min.js', ['jquery'], ASSETS_VERSION, true);
        wp_register_script(TEXTDOMAIN . '-slick-js', ASSETSURL . '/slick/slick.min.js', ['jquery'], ASSETS_VERSION, true);
        wp_register_script(TEXTDOMAIN . '-datetimepicker-js', ASSETSURL .'/datetimepicker/js/jquery.datetimepicker.full.min.js', ['jquery'], ASSETS_VERSION, true);
	}


	/**
	 *  enqueue all styles and scripts
	 */
	public function enqueueScripts()
	{
        wp_enqueue_style(TEXTDOMAIN . '-bootstrap-css');
        wp_enqueue_style(TEXTDOMAIN . '-bootstrap-slider-css');
		wp_enqueue_style(TEXTDOMAIN . '-main-css');
		wp_enqueue_style(TEXTDOMAIN . '-custom-css');
		wp_enqueue_style(TEXTDOMAIN . '-calc');
        wp_enqueue_style(TEXTDOMAIN . '-font-css');
        wp_enqueue_style(TEXTDOMAIN . '-fontello-css');
        wp_enqueue_style(TEXTDOMAIN . '-slick-css');
        wp_enqueue_style(TEXTDOMAIN . '-datetimepicker-css');


        wp_enqueue_script(TEXTDOMAIN . '-bootstrap-js');
        wp_enqueue_script(TEXTDOMAIN . '-bootstrap-slider-js');
        wp_enqueue_script(TEXTDOMAIN . '-slick-js');
		wp_enqueue_script(TEXTDOMAIN . '-main-js');
		wp_enqueue_script(TEXTDOMAIN . '-calc-js');
        wp_enqueue_script(TEXTDOMAIN . '-datetimepicker-js');
		wp_localize_script(TEXTDOMAIN . '-main-js', 'variables', [
			'ajaxurl'      => admin_url('admin-ajax.php'),
			'locale'       => get_locale(),
			'post_id'      => get_the_ID(),
			'template_uri' => get_stylesheet_directory_uri()
		]);
		wp_localize_script(TEXTDOMAIN . '-main-js', 'languages', [
			'Error'      => __('Error', 'cfood'),
		]);

	}


	public function registerSidebars() {
		$sidebars = apply_filters('cfood/register/sidebars', [
			[
				'name'          => __( 'Footer1', 'cfood' ),
				'id'            => 'footer-1',
				'description'   => __( 'Add widgets here to appear in your footer.', 'cfood' ),
				'before_widget' => '<section id="%1$s" class="footer-widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<div class="footer-list-title"><span class="icon-energy"></span><h4>',
				'after_title'   => '</h4></div>',
			],
			[
				'name'          => __( 'Footer2', 'cfood' ),
				'id'            => 'footer-2',
				'description'   => __( 'Add widgets here to appear in your footer.', 'cfood' ),
				'before_widget' => '<section id="%1$s" class="footer-widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<div class="footer-list-title"> <span class="icon-gas"></span><h4>',
				'after_title'   => '</h4></div>',
			],
			[
				'name'          => __( 'Footer3', 'cfood' ),
				'id'            => 'footer-3',
				'description'   => __( 'Add widgets here to appear in your footer.', 'cfood' ),
				'before_widget' => '<section id="%1$s" class="footer-widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<div class="footer-list-title"><span class="icon-service"></span><h4>',
				'after_title'   => '</h4></div>',
			],
			[
				'name'          => __( 'Footer4', 'cfood' ),
				'id'            => 'footer-4',
				'description'   => __( 'Add widgets here to appear in your footer.', 'cfood' ),
				'before_widget' => '<section id="%1$s" class="footer-widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<div class="footer-list-title"> <span class="icon-pig"></span><h4>',
				'after_title'   => '</h4></div>',
			]
		]);

		if (!empty($sidebars)) {
			foreach ($sidebars as $sidebar) {
				register_sidebar($sidebar);
			}
		}
	}

    /**
     *  add theme support
     */

	public function initImageSizes()
    {
        add_theme_support('post-thumbnails');
        add_theme_support( 'custom-logo', array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ) );
    }

    function initWoocommerceSupport() {
        add_theme_support( 'woocommerce' );
    }

    public function tariffRedirection()
    {
		if (is_page() &&
			(strpos(get_page_template(),'views/tmp-tarif.php') !== false || strpos(get_page_template(),'views/tmp-contract-form.php') !== false)  &&
			(!array_key_exists('last_club_id', $_SESSION) || empty($_SESSION['last_club_id'])) )
		{
			wp_redirect(home_url());
		}
    }

    public function sendClubRequest($data, $response)
    {
		if ($response && array_key_exists('last_club_id', $_SESSION) && !empty($_SESSION['last_club_id'])) {
			$club = ClubRepository::find($_SESSION['last_club_id']);
			if (!empty($club) && $club->exist() && $club->affiliate_link !== '') {
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $club->affiliate_link);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HEADER, false);
				curl_exec($ch);
				curl_close($ch);
			}

		}
    }
}
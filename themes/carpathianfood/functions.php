<?php

use Admin\Admin;
use Entity\Place;
use Inc\Ajax;
use Inc\Calls;
use Inc\General;
use Inc\ConsoleCommands;
use Inc\Shortcodes;
use Service\CronJob;
use Service\TaxonomyCreator;
use Service\PostTypeCreator;
use Entity\Event;

################################################################################
# Constants
################################################################################

define('THEMEURL', get_stylesheet_directory_uri());
define('THEMEDIR', __DIR__);

define('TEXTDOMAIN', 'cfood');

define('ASSETSURL', THEMEURL . '/assets');
define('ASSETSDIR', THEMEDIR . '/assets');

define('INCDIR', THEMEDIR . DIRECTORY_SEPARATOR . 'Inc');
define('VENDORDIR', THEMEDIR . DIRECTORY_SEPARATOR . 'vendor');

define('ADMINDIR', THEMEDIR . DIRECTORY_SEPARATOR . 'Admin');
define('ADMINURI', THEMEURL . '/Admin');

define('VERSION', '1.2.0');
define('ASSETS_VERSION', '1.1.1');

################################################################################
# Load the translations from the child theme if present
################################################################################

add_action( 'after_setup_theme', function () {
	load_child_theme_textdomain( 'cfood', get_stylesheet_directory() . '/languages' );
});


################################################################################
# Includes
################################################################################

require_once  VENDORDIR . '/autoload.php';

################################################################################
# Init
################################################################################

Shortcodes::init();
General::init();
Ajax::init();
Calls::init();

################################################################################
# Admin settings
################################################################################

if (is_admin()) {
	Admin::init();
}


################################################################################
# Services (Cron, CLI, etc)
################################################################################

CronJob::init();
ConsoleCommands::init();

################################################################################
# New Post Types
################################################################################

Event::init(__('Event','cfood'),__('Events','cfood'));
Place::init(__('Place','cfood'),__('Places','cfood'));


// Init
TaxonomyCreator::addToInit(); // Taxonomies need to be init before the PostTypes for the correct url structure
PostTypeCreator::addToInit();
<?php

namespace Inc;

class ConsoleCommands
{

	/**
	 * Init console commands
	 */
	public static function init()
	{
		if (class_exists('\WP_CLI')) {

			\WP_CLI::add_command('test start', function () {
				ConsoleCommands::testStart();
			});
		}
	}

	/**
	 * CLI command for testing services
	 */
	public static function testStart()
	{
		\WP_CLI::log('Start test');


		\WP_CLI::success("Test was finished.");
	}

}


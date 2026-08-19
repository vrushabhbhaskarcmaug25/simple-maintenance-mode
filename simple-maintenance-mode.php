<?php
/**
 * Plugin Name: Simple Maintenance Mode
 * Plugin URI: https://cheekybhaskar.wordpress.com/my-plugins/
 * Description: A lightweight maintenance mode plugin that lets administrators keep access to the website while showing visitors a temporary maintenance page.
 * Version: 1.0.0
 * Author: Vrushabh Bhaskar
 * Author URI: https://cheekybhaskar.wordpress.com/
 * License: GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: simple-maintenance-mode
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin version.
 */
define( 'SMM_VERSION', '1.0.0' );

/**
 * Plugin directory path.
 */
define( 'SMM_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

/**
 * Plugin directory URL.
 */
define( 'SMM_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * Main option name.
 */
define( 'SMM_OPTION_ENABLED', 'smm_enabled' );

/**
 * Maintenance message option.
 */
define( 'SMM_OPTION_MESSAGE', 'smm_message' );


/**
 * Load plugin classes.
 */
require_once SMM_PLUGIN_DIR . 'includes/class-smm-maintenance.php';
require_once SMM_PLUGIN_DIR . 'includes/class-smm-renderer.php';
require_once SMM_PLUGIN_DIR . 'includes/class-smm-settings.php';


/**
 * Initialize the plugin.
 */
function smm_init() {

	SMM_Maintenance::init();
	SMM_Settings::init();

}

add_action( 'plugins_loaded', 'smm_init' );
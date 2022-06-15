<?php
/**
 * Plugin Name: plugin Customization
 * Description: Made for the customization of theme.
 * Version: 1.1.1.7
 * Author: Harry
 * Author URI: https://abc.com/
 * Text Domain: first-plugin
 * WC requires at least: 3.8.0
 * WC tested up to: 5.1.0
 *
 * @package plugin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'FIRST_PLUGIN_DIR' ) ) {
	define( 'FIRST_PLUGIN_DIR', __DIR__ );
}

if ( ! defined( 'FIRST_PLUGIN_DIR_URL' ) ) {
	define( 'FIRST_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'FIRST_ABSPATH' ) ) {
	define( 'FIRST_ABSPATH', dirname( __FILE__ ) );
}

require FIRST_PLUGIN_DIR . '/includes/class-plugin-loader.php';

?>
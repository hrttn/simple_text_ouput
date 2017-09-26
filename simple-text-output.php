<?php
/**
 * The file responsible for starting the Simple Text Output plugin
 *
 * Simple Text Output is a plugin that displays a text on a 
 * front-end using the shortcode [simple_text_output]. This particular
 * file is responsible for including the necessary dependencies and 
 * starting the plugin.
 *
 * @package STO
 *
 * Plugin Name:			Simple Text Output
 * Plugin URI:			https://github.com/hrttn/simple_text_output
 * Description:			Simple Text Output displays a text on your front-end with the shortcode [simple_text_output]
 * Version:				2017-09-26-00
 * Author:				WP Elk
 * Author URI:			https://www.wpelk.com
 * Text Domain:			simple-text-output-locale
 * License:				GPL-3.0+
 * License URI:			http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path:			/languages
 */

// If this file is called directly, then abort execution.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Include the core class responsible for loading all necessary components of the plugin.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-simple-text-output.php';

/**
 * Instantiates the Simple Text Output class and then
 * calls its run method officially starting up the plugin.
 */ 
function run_simple_text_output() {
 
	$sto = new Simple_Text_Output();
	$sto->run();
 
}

// Call the above function to begin execution of the plugin. 
run_simple_text_output();
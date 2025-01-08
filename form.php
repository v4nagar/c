<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://anurag.com
 * @since             1.0.0
 * @package           Form
 *
 * @wordpress-plugin
 * Plugin Name:       MLV Fees Portal 
 * Plugin URI:        https://form.com
 * Description:       Forms....
 * Version:           1.0.1
 * Author:            anurag
 * Author URI:        https://anurag.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       form
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'FORM_VERSION', '1.0.1' );
define('MLV_FEE_PORTAL_PLUGIN_BASE_URL',plugin_dir_url( __FILE__ ));
// define( 'MLV_FORMS_ARRAY', array(
// 	"degree"=>array(
// 		"id"=>"degree_form",
// 		"title"=>"Application & Affidavit for Obtaining Degree",
// 		"fees"=>100,
// 		"active"=>true,

// 	),
// 	"tt_cc"=>array(
// 		"id"=>"tt_cc_form",
// 		"title"=>"Application for issuing TC/CC.",
// 		"fees"=>50,
// 		//"fees"=>1,
// 		"active"=>true,
		
// 	),
// 	"studying_certificate"=>array(
// 		"id"=>"studying_certificate_form",
// 		"title"=>"Application for issuing Studying Certificate",
// 		"fees"=>50,
// 		//"fees"=>1,
// 		"active"=>true,
		
// 	),
// 	"cdc_fee"=>array(
// 		"id"=>"cdc_fee_form",
// 		"title"=>"Non-Collegiate CDC Examination Fee Form",
// 		"fees"=>410,
// 		//"fees"=>1,
// 		"active"=>true,
		
// 	),
// 	"cdc_fee_geography"=>array(
// 		"id"=>"cdc_fee_geography_form",
// 		"title"=>"Non-Collegiate CDC Practical Exam (Geography) Fee Form",
// 		"fees"=>350,
// 		//"fees"=>1,
// 		"active"=>true,
		
// 	),
// ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-form-activator.php
 */
function activate_form() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-form-activator.php';
	Form_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-form-deactivator.php
 */
function deactivate_form() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-form-deactivator.php';
	Form_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_form' );
register_deactivation_hook( __FILE__, 'deactivate_form' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-form.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_form() {

	$plugin = new Form();
	$plugin->run();

}
run_form();

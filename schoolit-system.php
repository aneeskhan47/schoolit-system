<?php 
/*
Plugin Name: Schoolit-System Plugin
Plugin URI: schoolitsystem.com
Description: Schoolit-System Forms Plugin
Version: 0.0.2
Author: SchoolitSystem
Author URI: schoolitsystem.com
Text Domain: schoolitsystem

*/

// If this file is called directly, abort. //
if ( ! defined( 'WPINC' ) ) {die;} // end if

// Let's Initialize Everything
if ( file_exists( plugin_dir_path( __FILE__ ) . 'core-init.php' ) ) {
require_once( plugin_dir_path( __FILE__ ) . 'core-init.php' );
}
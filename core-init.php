<?php 
/*
*
*	***** Schoolit-System Plugin *****
*
*	This file initializes all SS Core components
*	
*/
// If this file is called directly, abort. //
if ( ! defined( 'WPINC' ) ) {die;} // end if


// register_activation_hook(__FILE__, 'ss_register_activation_hook');
// register_deactivation_hook(__FILE__, 'ss_register_deactivation_hook');

// function ss_register_activation_hook()
// {
//   add_option('ss_api_key');
// }

// function ss_register_deactivation_hook()
// {
//   delete_option('ss_api_key');
// }

// Define Our Constants
define('SS_CORE_INC',dirname( __FILE__ ).'/assets/inc/');
define('SS_CORE_IMG',plugins_url( 'assets/img/', __FILE__ ));
define('SS_CORE_CSS',plugins_url( 'assets/css/', __FILE__ ));
define('SS_CORE_JS',plugins_url( 'assets/js/', __FILE__ ));
/*
*
*  Register CSS
*
*/

function ss_register_core_css(){
wp_enqueue_style('ss-core', SS_CORE_CSS . 'ss-core.css',null,time(),'all');
wp_enqueue_style('ss-datetimepicker', SS_CORE_CSS . 'ss-datetimepicker.min.css',null,time(),'all');
wp_enqueue_style('ss-sweetalert2', SS_CORE_CSS . 'ss-sweetalert2.min.css',null,time(),'all');
};
add_action( 'wp_enqueue_scripts', 'ss_register_core_css' );    
/*
*
*  Register JS/Jquery Ready
*
*/
function ss_register_core_js(){
// Register Core Plugin JS	


wp_enqueue_script('ss-core', SS_CORE_JS . 'ss-core.js',array( 'jquery' ),time(),true);


$scriptData = array(
	'ss_website_url' => get_option( 'ss_website_url' ),
);

wp_localize_script('ss-core', 'ss_options', $scriptData);

wp_enqueue_script('ss-datetimepicker', SS_CORE_JS . 'ss-datetimepicker.full.min.js',array( 'jquery' ),time(),true);
wp_enqueue_script('ss-blockUI', SS_CORE_JS . 'ss-blockUI.js',array( 'jquery' ),time(),true);
wp_enqueue_script('ss-sweetalert2', SS_CORE_JS . 'ss-sweetalert2.min.js',null,time(),true);
};
add_action( 'wp_enqueue_scripts', 'ss_register_core_js' );

/*
*
*  Includes
*
*/ 
// Load the Functions
if ( file_exists( SS_CORE_INC . 'ss-core-functions.php' ) ) {
	require_once SS_CORE_INC . 'ss-core-functions.php';
}     
// Load the ajax Request
if ( file_exists( SS_CORE_INC . 'ss-ajax-request.php' ) ) {
	require_once SS_CORE_INC . 'ss-ajax-request.php';
} 
// Load the Shortcodes
if ( file_exists( SS_CORE_INC . 'ss-shortcodes.php' ) ) {
	require_once SS_CORE_INC . 'ss-shortcodes.php';
}
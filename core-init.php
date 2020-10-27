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

include_once('updater.php');

if (is_admin()) { // note the use of is_admin() to double check that this is happening in the admin
	$config = array(
		'slug' => plugin_basename(__FILE__), // this is the slug of your plugin
		'proper_folder_name' => 'schoolit-system', // this is the name of the folder your plugin lives in
		'api_url' => 'https://api.github.com/users/aneeskhan47/repos/schoolit-system', // the GitHub API url of your GitHub repo
		'raw_url' => 'https://raw.githubusercontent.com/aneeskhan47/schoolit-system/master', // the GitHub raw url of your GitHub repo
		'github_url' => 'https://github.com/aneeskhan47/schoolit-system', // the GitHub url of your GitHub repo
		'zip_url' => 'https://github.com/aneeskhan47/schoolit-system/zipball/master', // the zip url of the GitHub repo
		'sslverify' => false, // whether WP should check the validity of the SSL cert when getting an update, see https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/2 and https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/4 for details
		'requires' => '4.0', // which version of WordPress does your plugin require?
		'tested' => '5.5', // which version of WordPress is your plugin tested up to?
		'readme' => 'README.md', // which file to use as the readme for the version number
		'access_token' => '46476c8aa717c18ba06d69ec96047f1af80fb118', // Access private repositories by authorizing under Plugins > GitHub Updates when this example plugin is installed
	);
	new WP_GitHub_Updater($config);
}

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
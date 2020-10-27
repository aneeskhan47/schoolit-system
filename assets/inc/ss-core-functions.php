<?php 
/*
*
*	***** Schoolit-System Online Admission Form *****
*
*	Core Functions
*	
*/
// If this file is called directly, abort. //
if ( ! defined( 'WPINC' ) ) {die;} // end if
/*
*
* Custom Front End Ajax Scripts / Loads In WP Footer
*
*/
 function ss_frontend_ajax_form_scripts(){
?>
<script type="text/javascript">
jQuery(document).ready(function($){
    "use strict";
    // add basic front-end ajax page scripts here

    var base_url = '<?php echo get_option('ss_website_url') ?>';



}(jQuery));    
</script>
<?php }
// add_action('wp_footer','ss_frontend_ajax_form_scripts');

/**
 * Custom Admin Menu
 */
function ss_options_submenu()
{
      add_submenu_page(
        'options-general.php',
        'Schoolit-System Plugin Settings',
        'Schoolit-System Setting',
        'administrator',
        'ss_settings',
        'ss_settings_page' );
}
add_action('admin_menu', 'ss_options_submenu');

function ss_settings_page() {

if(!is_admin()) {
    return;
}

?>

  <div class="wrap">
  <h2 style="background-color: #109fc3;padding:10px;color:white;">Schoolit-System Plugin Settings</h2>
  <h4>Online Admission Form English ShortCode: <span>[ss_admission_form lang="English"]</spab></h4>
  <h4>Online Admission Form Urdu ShortCode: <span>[ss_admission_form lang="Urdu"]</span></h4>
  <form method="post" action="options.php">
  <?php 
  
    settings_fields( 'ss_settings' );
    do_settings_sections('ss_settings');
    submit_button(); 

  ?>
  
  </form>
  </div>

<?php



}


function ss_settings_init() {
    // register a new setting for "reading" page
    register_setting('ss_settings', 'ss_website_url');
 
    // register a new section in the "reading" page
    add_settings_section(
        'ss_settings_section',
        'Schoolit System Plugin Setting', 'ss_settings_section_callback',
        'ss_settings'
    );
 
    // register a new field in the "wporg_settings_section" section, inside the "reading" page
    add_settings_field(
        'ss_website_url',
        'Your Schoolit-System URL', 'ss_settings_field_callback',
        'ss_settings',
        'ss_settings_section'
    );
}
 
/**
 * register wporg_settings_init to the admin_init action hook
 */
add_action('admin_init', 'ss_settings_init');
 
/**
 * callback functions
 */
 
// section content cb
function ss_settings_section_callback() {
    echo '<p>General Settings</p>';
}
 
// field content cb
function ss_settings_field_callback() {
    // get the value of the setting we've registered with register_setting()
    $setting = get_option('ss_website_url');
    // output the field
    ?>
    <input type="text" name="ss_website_url" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
    <?php
}


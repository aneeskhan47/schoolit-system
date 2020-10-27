<?php 
/*
*
*	***** Schoolit-System Online Admission Form *****
*
*	Shortcodes
*	
*/
// If this file is called directly, abort. //
if ( ! defined( 'WPINC' ) ) {die;} // end if
/*
*
*  Build The Custom Plugin Form
*
*  Display Anywhere Using Shortcode: [ss_admission_form]
*
*/
function ss_admission_form_display($atts){
		// $atts = shortcode_atts(array(
      	// 'lang' => 'english',	
        // ),$atts, 'ss_admission_form');    

        $base_url =  get_option('ss_website_url');
        
        $response = wp_remote_get( ''.$base_url.'api2/admission_form/'.$atts['lang'].'' );
        $out = wp_remote_retrieve_body( $response );

        // echo "<pre>";
        // print_r ($out);
        // echo "</pre>";
        
        
        // $out ='';
        // $out .= '<div id="ss_custom_plugin_form_wrap" class="ss-form-wrap">';
        // $out .= 'Hey! Im a cool new plugin named <strong>Schoolit-System Online Admission Form!</strong>';
        // $out .= '<form id="ss_custom_plugin_form">';
        // $out .= '<p><input type="text" name="myInputField" id="myInputField" placeholder="Test Field: Test Ajax Responses"></p>';
        
        // // Final Submit Button
        // $out .= '<p><input type="submit" id="submit_btn" value="Submit My Form"></p>';        
        // $out .= '</form>';
        //  // Form Ends
        // $out .='</div><!-- ss_custom_plugin_form_wrap -->';       
        return $out;
}

// Registered Shortcodes
add_shortcode ('ss_admission_form', 'ss_admission_form_display' );
<?php

// if uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}
 
$ss_website_url = 'ss_website_url';
 
delete_option($ss_website_url);
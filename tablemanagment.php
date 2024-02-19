<?php
/*
Plugin Name: Table of Contents
Description: A simple table of contents plugin
Version: 1.0
Author: mojtaba_sji
*/

require_once plugin_dir_path(__FILE__) . 'Loggers/logger.php';
require_once plugin_dir_path(__FILE__) . 'class.toc.php';
use  tableManagement\Loggers\logger;


// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

function store_log($message){
    $my_loger = new logger();
    $my_loger->log($message);
}


define( 'TOC_VERSION', '1.0.0' );
define( 'TOC__MINIMUM_WP_VERSION', '5.8' );
define( 'TOC__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'TOC_DELETE_LIMIT', 10000 );

register_activation_hook( __FILE__, array('toc', 'toc_install') );
register_deactivation_hook( __FILE__, array('toc', 'toc_uninstall') );

add_action('init', array('toc', 'init'));

store_log("End of main plugin file");

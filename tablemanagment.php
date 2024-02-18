<?php
/*
Plugin Name: Table of Contents
Description: A simple table of contents plugin
Version: 1.0
Author: mojtaba_sji
*/

require_once plugin_dir_path(__FILE__) . 'Loggers/logger.php';


register_activation_hook( __FILE__, 'toc_install' );
register_deactivation_hook( __FILE__, 'toc_uninstall' );
use tableManagement\Loggers\logger;


function toc_install(): void
{
    $my_logger = new logger();
    $my_logger->log("Table Created");
}

function toc_uninstall(): void
{
    $my_logger = new logger();
    $my_logger->log("Table Deleted");
}

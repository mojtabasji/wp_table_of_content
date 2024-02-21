<?php

require_once plugin_dir_path(__FILE__) . 'Loggers/logger.php';
require_once plugin_dir_path(__FILE__) . 'view_handler.php';
require_once plugin_dir_path(__FILE__) . 'baseFunctions.php';

use tableManagement\Loggers\logger;


class toc
{
    private static $initiated = false;

    public function __construct()
    {

    }

    public static function logger($message)
    {
        $file = fopen(plugin_dir_path(__FILE__) . 'logs\log.txt', 'a');
        $date = date('Y-m-d H:i:s');
        fwrite($file, "$date: $message\n");
        fclose($file);
    }

    public static function init()
    {
        if (!self::$initiated) {
            self::init_hooks();
        }
        self::logger("Plugin is activated");
    }

    private static function init_hooks()
    {
        self::$initiated = true;

        add_action('admin_menu', array('toc', 'add_admin_menu'));

        add_shortcode('toc', array('toc', 'toc_user_page'));

        self::logger("Hooks are initiated");

        enqueue_font_awesome();
    }

    public static function toc_user_page()
    {
        ob_start();
        show_client_content();
        return ob_get_clean();
    }

    public static function add_admin_menu()
    {
        self::logger("Admin menu is adding");
        add_menu_page(
            'Table of Content',           // Page title
            'Table of Content',                      // Menu title
            'manage_options',           // Capability
            'toc-user-page',      // Menu slug (unique identifier)
            'management_show',   // Callback function to display the page content
            'dashicons-admin-generic', // Dashicon for the menu icon (optional)
            6                       // Menu position (optional)
        );
        self::logger("submenu is adding");
        // Add a submenu page under the top-level menu
        add_submenu_page(
            'my-plugin-slug',      // Parent menu slug
            'Submenu Page',        // Page title
            'Submenu',             // Menu title
            'manage_options',      // Capability required to access the menu
            'my-submenu-slug',     // Submenu slug (unique identifier)
            'subtest_show'   // Callback function to display the submenu content
        );
        self::logger("Admin menu is added");
    }

    public static function toc_install()
    {
        $newLoger = new logger();
        global $wpdb;
        $table_name = $wpdb->prefix . 'toc';
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            name tinytext NOT NULL,
            text text NOT NULL,
            url varchar(55) DEFAULT '' NOT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        $newLoger->log("Table Created");
        self::logger("Table Created");

    }

    public static function toc_uninstall()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'toc';
        $sql = "DROP TABLE IF EXISTS $table_name";
        $wpdb->query($sql);
        self::logger("Table Deleted");
    }
}


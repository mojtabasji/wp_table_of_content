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
    }

    private static function init_hooks()
    {
        self::$initiated = true;

        add_action('admin_menu', array('toc', 'add_admin_menu'));
        add_action('admin_post_toc_form_handler', 'toc_form_handler');
        add_action('wp_ajax_toc_ajax_action', 'toc_ajax_handler');
        add_action('wp_ajax_nopriv_toc_ajax_action', 'toc_ajax_handler');
        add_action('wp_enqueue_scripts', array('toc', 'enqueue_toc_scripts'));

        add_shortcode('toc_all_tables', array('toc', 'toc_up_all_tables'));


        enqueue_font_awesome();
    }

    public static function enqueue_toc_scripts()
    {
        wp_enqueue_script('toc_app', plugin_dir_url(__FILE__) . 'js/App.js', array('jquery'), '1.0.0', true);
        wp_localize_script('toc_app', 'toc_ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
    }

    public static function toc_up_all_tables()
    {
        ob_start();
        show_all_tables();
        return ob_get_clean();
    }

    public static function create_product_table()
    {

    }

    public static function add_admin_menu()
    {
        add_menu_page(
            'Table of Content',           // Page title
            'جدول محتوی',                      // Menu title
            'manage_options',           // Capability
            'toc-admin-page',      // Menu slug (unique identifier)
            'management_show',   // Callback function to display the page content
            'dashicons-admin-generic', // Dashicon for the menu icon (optional)
            6                       // Menu position (optional)
        );
        // Add a submenu page under the top-level menu
        add_submenu_page(
            'my-plugin-slug',      // Parent menu slug
            'Submenu Page',        // Page title
            'Submenu',             // Menu title
            'manage_options',      // Capability required to access the menu
            'my-submenu-slug',     // Submenu slug (unique identifier)
            'subtest_show'   // Callback function to display the submenu content
        );
    }

    public static function toc_install()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'toc';
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            name tinytext NOT NULL,
            slug tinytext NOT NULL,
            time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);

    }

    public static function toc_uninstall()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'toc';
        $sql = "DROP TABLE IF EXISTS $table_name";
        $wpdb->query($sql);
    }
}


//    post request will handle here first
function toc_form_handler()
{
    global $wpdb;
    if (isset($_POST['page']) && $_POST['page'] == 'add-product') {
        $table_name_inp = $_POST['table_name'];
        $table_name = map_table_name($table_name_inp);
        $table_name = $wpdb->prefix . 'toc_' . $table_name;
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            name mediumtext NOT NULL,
            thickness tinytext,
            factory tinytext,
            state tinytext,
            depot tinytext,
            price longtext NOT NULL DEFAULT '',
            previous_price longtext NOT NULL DEFAULT '',
            update_date date DEFAULT '0000-00-00' NOT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        $result = $wpdb->insert('wp_toc', array('name' => $table_name_inp, 'slug' => $table_name, 'time' => current_time('mysql', 1)));
        if ($result === false) {
            toc::logger($wpdb->last_error);
        }
        wp_redirect(admin_url('admin.php?page=toc-admin-page'));
    } elseif (isset($_POST['page']) && $_POST['page'] == 'add-row') {
        $table_name = $_POST['table_name'];
        $name = $_POST['name'];
        $thickness = $_POST['thickness'];
        $factory = $_POST['factory'];
        $state = $_POST['state'];
        $depot = $_POST['depot'];
        $price = $_POST['price'];
        $previous_price = "";
        $result = $wpdb->insert($table_name, array('name' => $name, 'thickness' => $thickness, 'factory' => $factory,
            'state' => $state, 'depot' => $depot, 'price' => $price, 'update_date' => date('Y-m-d'),
            'previous_price' => $previous_price));
        if ($result === false) {
            toc::logger("Error: insert row to table " . $table_name . " -> " . $wpdb->last_error);
        }
        $table_id = $wpdb->get_results("SELECT * FROM wp_toc WHERE slug = '$table_name'")[0]->id;
        wp_redirect(admin_url('admin.php?page=toc-admin-page&subpage=management_items&table_id=' . $table_id));
    } else {
        toc::logger("invalid request in post request");
        throw new Exception('Invalid request');
    }
}


//    ajax request will handle here first
function toc_ajax_handler()
{
    global $wpdb;
    if (isset($_POST['request']) && $_POST['request'] == 'get_products') {
        $json_data = json_encode(array('name' => 'mojtaba', 'family' => 'sji'));
        wp_send_json($json_data);
    } else {
        toc::logger("invalid request property in ajax request");
        throw new Exception('Invalid request. check log for more information');
    }
}


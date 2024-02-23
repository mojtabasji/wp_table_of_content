<?php


function view($name, array $args = array())
{
    $args = apply_filters('toc_view_arguments', $args, $name);
    foreach ($args as $key => $val) {
        $$key = $val;
    }
    load_plugin_textdomain('toc');
    $file = TOC__PLUGIN_DIR . 'views/' . $name . '.php';
    include($file);
}

function management_show()
{
    global $wpdb;
    if (isset($_GET['subpage'] ) && $_GET['subpage'] == 'management_items') {
        $file_name = 'management_items';
        $args['type'] = 'management_items';
        $wp_table_name = $wpdb->get_results("SELECT * FROM wp_toc WHERE id = " . $_GET['table_id'])[0]->slug;
        $args['wp_table_name'] = $wp_table_name;
        $args['table_name'] = $wpdb->get_results("SELECT * FROM wp_toc WHERE id = " . $_GET['table_id'])[0]->name;
        $args['data'] = $wpdb->get_results("SELECT * FROM $wp_table_name");
        view($file_name, $args);
    } else {
        $Tables = $wpdb->get_results("SELECT * FROM wp_toc");
        $file_name = 'management';
        $args['type'] = 'management';
        $args['tables'] = $Tables;
        view($file_name, $args);
    }
}

function management_item_show()
{
    $file_name = 'management_items';
    $args['type'] = 'management_items';
    view($file_name, $args);
}

function subtest_show()
{
    toc::logger("Subtest show is called");
    $file_name = 'test';
    $args['type'] = 'subtest';
    view($file_name, $args);
}

function show_all_tables()
{
    global $wpdb;
    $Tables = $wpdb->get_results("SELECT * FROM wp_toc");
    $args['tables'] = array();
    foreach ($Tables as $table) {
        $table_name = $table->slug;
        $args['tables'][$table_name] = $wpdb->get_results("SELECT * FROM $table_name");
    }
    $file_name = 'client_side';
    $args['type'] = 'client';
    view($file_name, $args);
}
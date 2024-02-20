<?php


function view($name, array $args = array())
{
    $args = apply_filters('toc_view_arguments', $args, $name);
    foreach ($args as $key => $val) {
        $$key = $val;
    }
    load_plugin_textdomain('toc');
    $file = TOC__PLUGIN_DIR . 'views/' . $name . '.php';
    toc::logger("in view is here --> ");
    include($file);
}

function management_show()
{
    $file_name = 'management';
    $args['type'] = 'management';
    view($file_name, $args);
}

function subtest_show()
{
    toc::logger("Subtest show is called");
    $file_name = 'test';
    $args['type'] = 'subtest';
    view($file_name, $args);
}

function show_client_content()
{
    $file_name = 'client_side';
    $args['type'] = 'client';
    view($file_name, $args);
}
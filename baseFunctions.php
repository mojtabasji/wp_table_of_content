<?php

// Enqueue Font Awesome stylesheet
function enqueue_font_awesome() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css', array(), '5.15.3');
}

function map_table_name($table_name){
    $persian_to_english = array(
        "آ" => "a",
        "ا" => "a",
        "ب" => "b",
        "پ" => "p",
        "ت" => "t",
        "ث" => "s",
        "ج" => "j",
        "چ" => "ch",
        "ح" => "h",
        "خ" => "kh",
        "د" => "d",
        "ذ" => "z",
        "ر" => "r",
        "ز" => "z",
        "ژ" => "zh",
        "س" => "s",
        "ش" => "sh",
        "ص" => "s",
        "ض" => "z",
        "ط" => "t",
        "ظ" => "z",
        "ع" => "a",
        "غ" => "gh",
        "ف" => "f",
        "ق" => "gh",
        "ک" => "k",
        "گ" => "g",
        "ل" => "l",
        "م" => "m",
        "ن" => "n",
        "و" => "v",
        "ه" => "h",
        "ی" => "y",
        "ئ" => "y",
        " " => "_",
    );
    $table_name = strtr($table_name, $persian_to_english);
    return $table_name;
}

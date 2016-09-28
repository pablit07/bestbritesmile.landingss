<?php
/**
 * Theme options > General Options
 */

$admin_options[] = array (
    'slug'        => 'general_options',
    'parent'      => 'general_options',
    "name"        => __( 'GENERAL SETTINGS', 'zn_framework' ),
    "description" => __( 'These settings below are related to theme itself.', 'zn_framework' ),
    "id"          => "info_title1",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-large zn-toptabs-margin"
);

$admin_options[] = array (
    'slug'        => 'general_options',
    'parent'      => 'general_options',
    "name"        => __( "Use page preloader?", 'zn_framework' ),
    "description" => __( "Choose yes if you want to show a page preloader.", 'zn_framework' ),
    "id"          => "page_preloader",
    "std"         => 'no',
    "options"     => array ( 'yes' => __( "Yes", 'zn_framework' ), 'no' => __( "No", 'zn_framework' ) ),
    "type"        => "select"
);

$admin_options[] = array (
    'slug'        => 'general_options',
    'parent'      => 'general_options',
    "name"        => __( "Hide page subheader?", 'zn_framework' ),
    "description" => __( "Choose yes if you want to hide the page subheader ( including sliders ). Please note that this option can be overridden from each page/post", 'zn_framework' ),
    "id"          => "zn_disable_subheader",
    "std"         => 'no',
    "options"     => array ( 'yes' => __( "Yes", 'zn_framework' ), 'no' => __( "No", 'zn_framework' ) ),
    "type"        => "select"
);


$admin_options[] = array (
    'slug'        => 'general_options',
    'parent'      => 'general_options',
    "name"        => __( "Enable Smooth Scroll?", 'zn_framework' ),
    "description" => __( "This option will hijack the page default scroll and add an ease effect. It's very appealing with parallax scrolls and general nativation.", 'zn_framework' ),
    "id"          => "smooth_scroll",
    "std"         => 'no',
    "options"     => array ( 'yes' => __( "Yes", 'zn_framework' ), 'no' => __( "No", 'zn_framework' ) ),
    "type"        => "select"
);


$admin_options[] = array (
    'slug'        => 'general_options',
    'parent'      => 'general_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "go_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator"
);

$admin_options[] = array (
    'slug'        => 'general_options',
    'parent'      => 'general_options',
    "name"        => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> Video Tutorial: <a href="http://support.hogash.com/kallyas-videos/#u0uQWA-kJOY" target="_blank">Click here to access video tutorial for this options section.</a>', 'zn_framework' ),
    "id"          => "go_video",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn_nomargin"
);

// $admin_options[] = array (
//     'slug'        => 'general_options',
//     'parent'      => 'general_options',
//     "name"        => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> Written Documentation: <a href="" target="_blank">Click here to access documentation for this options section.</a>', 'zn_framework' ),
//     "id"          => "go_link",
//     "std"         => "",
//     "type"        => "zn_title",
//     "class"       => "zn_full zn-admin-helplink zn_nomargin"
// );

$admin_options[] = array (
    'slug'        => 'general_options',
    'parent'      => 'general_options',
    "name"        => __( '<a href="http://support.hogash.com/support/forum/wordpress-themes/kallyas-wordpress-theme/" target="_blank">Support Forums</a> &nbsp; | &nbsp; <a href="http://support.hogash.com/kallyas-help/" target="_blank">Kallyas Video Tutorials & Documentation</a> &nbsp; | &nbsp; <a href="http://themeforest.net/downloads?sort_by=Recent+Updates&filter_by=themeforest.net#item-4091658" target="_blank" class="stars-yellow">Rate Kallyas <span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></a>', 'zn_framework' ),
    "id"          => "go_otherlinks",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn-custom-title-sm zn_nomargin"
);


<?php
/**
 * Theme options > General Options  > Favicon options
 */
global $header_option;

if(!isset($header_option) || empty($header_option)){
    $header_option = WpkZn::getThemeHeaders(true);
}

$admin_options[] = array (
    'slug'        => 'documentation_options',
    'parent'      => 'documentation_options',
    "name"        => __( "Header Style", 'zn_framework' ),
    "description" => __( "Select the header style you want to use for this page. Please note that
					header styles can be created from the theme's admin page.", 'zn_framework' ),
    "id"          => "zn_doc_header_style",
    "std"         => "",
    "type"        => "select",
    "options"     => $header_option,
    "class"       => ""
);

$admin_options[] = array (
    'slug'        => 'documentation_options',
    'parent'      => 'documentation_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "dcmo_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator"
);

// $admin_options[] = array (
//     'slug'        => 'documentation_options',
//     'parent'      => 'documentation_options',
//     "name"        => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> Video Tutorial: <a href="" target="_blank">Click here to access video tutorial for this options section.</a>', 'zn_framework' ),
//     "id"          => "dcmo_video",
//     "std"         => "",
//     "type"        => "zn_title",
//     "class"       => "zn_full zn-admin-helplink zn_nomargin"
// );

// $admin_options[] = array (
//     'slug'        => 'documentation_options',
//     'parent'      => 'documentation_options',
//     "name"        => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> Written Documentation: <a href="" target="_blank">Click here to access documentation for this options section.</a>', 'zn_framework' ),
//     "id"          => "dcmo_link",
//     "std"         => "",
//     "type"        => "zn_title",
//     "class"       => "zn_full zn-admin-helplink zn_nomargin"
// );

$admin_options[] = array (
    'slug'        => 'documentation_options',
    'parent'      => 'documentation_options',
    "name"        => __( '<a href="http://support.hogash.com/support/forum/wordpress-themes/kallyas-wordpress-theme/" target="_blank">Support Forums</a> &nbsp; | &nbsp; <a href="http://support.hogash.com/kallyas-help/" target="_blank">Kallyas Video Tutorials & Documentation</a> &nbsp; | &nbsp; <a href="http://themeforest.net/downloads?sort_by=Recent+Updates&filter_by=themeforest.net#item-4091658" target="_blank" class="stars-yellow">Rate Kallyas <span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></a>', 'zn_framework' ),
    "id"          => "dcmo_otherlinks",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn-custom-title-sm zn_nomargin"
);
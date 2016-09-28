<?php
/**
 * Theme options > General Options  > Navigation options
 */

$admin_options[] = array (
    'slug'        => 'nav_options',
    'parent'      => 'general_options',
    "name"        => __( 'NAVIGATION OPTIONS', 'zn_framework' ),
    "description" => __( 'These options below are related to site\'s navigations. For example the header contains 2 registered menus: "Main Navigation" and "Header Navigation".', 'zn_framework' ),
    "id"          => "info_title7",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-large zn-toptabs-margin"
);

$admin_options[] = array (
    'slug'        => 'nav_options',
    'parent'      => 'general_options',
    "name"        => __( "Show Scrolling menu or sticky header?", 'zn_framework' ),
    "description" => __( "The scrolling menu will only display a simple cloned main navigation, upon scrolling.<br> The Sticky header, upon scrolling, will fix the entire menu to top even when scrolling to the bottom.", 'zn_framework' ),
    "id"          => "menu_follow",
    "std"         => 'no',
    "options"     => array ( 'yes' => __( "Scrolling Menu (a.k.a. Chaser / Follow menu)", 'zn_framework' ), 'sticky' => __( "Sticky Header", 'zn_framework' ), 'no' => __( "No", 'zn_framework' ) ),
    "type"        => "select"
);

$admin_options[] = array (
    'slug'        => 'nav_options',
    'parent'      => 'general_options',
    "name"        => __( "Enable Scroll-Spy?", 'zn_framework' ),
    "description" => __( "If you're trying to have a <strong>ONE-PAGE</strong> functionality, this option will enable the menu to move it's <em>Active</em> state, according to the section/zone associated with it.", 'zn_framework' ),
    "id"          => "scrollspy_menu",
    "std"         => 'no',
    "value"       => 'yes',
    "type"        => "toggle2",
    'dependency'  => array ( 'element' => 'menu_follow', 'value' => array ( 'yes', 'sticky') ),
);

$admin_options[] = array (
    'slug'        => 'nav_options',
    'parent'      => 'general_options',
    "name"        => __( "Enable dropdown Top Header Navigation? Only available for smartphones.", 'zn_framework' ),
    "description" => __( "This option will enable a dropdown menu for the header-navigation (not main-menu!). If you have for example lots of menu items in header, this option will fallback nicely in the header.", 'zn_framework' ),
    "id"          => "header_topnav_dd",
    "std"         => "yes",
    "value"         => "yes",
    "type"        => "toggle2",
);


// HELP STARTS HERE

$admin_options[] = array (
    'slug'        => 'nav_options',
    'parent'      => 'general_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "nvo_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator"
);

// $admin_options[] = array (
//     'slug'        => 'nav_options',
//     'parent'      => 'general_options',
//     "name"        => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> Video Tutorial: <a href="http://support.hogash.com/kallyas-videos/#TuXcJu9jl7c" target="_blank">Click here to access video tutorial for this options section.</a>', 'zn_framework' ),
//     "id"          => "nvo_video",
//     "std"         => "",
//     "type"        => "zn_title",
//     "class"       => "zn_full zn-admin-helplink zn_nomargin"
// );

// $admin_options[] = array (
//     'slug'        => 'nav_options',
//     'parent'      => 'general_options',
//     "name"        => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> Written Documentation: <a href="" target="_blank">Click here to access documentation for this options section.</a>', 'zn_framework' ),
//     "id"          => "nvo_link",
//     "std"         => "",
//     "type"        => "zn_title",
//     "class"       => "zn_full zn-admin-helplink zn_nomargin"
// );

$admin_options[] = array (
    'slug'        => 'nav_options',
    'parent'      => 'general_options',
    "name"        => __( '<a href="http://support.hogash.com/support/forum/wordpress-themes/kallyas-wordpress-theme/" target="_blank">Support Forums</a> &nbsp; | &nbsp; <a href="http://support.hogash.com/kallyas-help/" target="_blank">Kallyas Video Tutorials & Documentation</a> &nbsp; | &nbsp; <a href="http://themeforest.net/downloads?sort_by=Recent+Updates&filter_by=themeforest.net#item-4091658" target="_blank" class="stars-yellow">Rate Kallyas <span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></a>', 'zn_framework' ),
    "id"          => "nvo_otherlinks",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn-custom-title-sm zn_nomargin"
);
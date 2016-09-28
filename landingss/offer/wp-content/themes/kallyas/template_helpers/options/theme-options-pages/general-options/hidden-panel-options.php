<?php
/**
 * Theme options > General Options  > Hidden Panel options
 */

$admin_options[] = array (
    'slug'        => 'hidden_panel_options',
    'parent'      => 'general_options',
    "name"        => __( 'HIDDEN HEADER PANEL OPTIONS', 'zn_framework' ),
    "description" => __( 'These options below are related to SUPPORT button in header and hidden panel that toggles.( <a href="http://hogash.d.pr/BWS9" target="_blank" title="Click to open screenshot">Open screenshot</a>). ', 'zn_framework' ),
    "id"          => "info_title10",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-large zn-toptabs-margin"
);

$admin_options[] = array (
    'slug'        => 'hidden_panel_options',
    'parent'      => 'general_options',
    "name"        => __( 'How to disable the "SUPPORT" panel?', 'zn_framework' ),
    "description" => __( '<span class="dashicons dashicons-warning"></span> Go to <a href="'.admin_url( 'widgets.php' ).'">Appereance > Widgets</a> and insde the widgets position called “Hidden panel sidebar” and make sure it’s empty by dragging out the Text widget inside ( screenshot: <a href="http://hogash.d.pr/ypNB">http://hogash.d.pr/ypNB</a> ).', 'zn_framework' ),
    "id"          => "hp_info",
    "type"        => "zn_title",
    "class"       => "zn_full"
);

$admin_options[] = array (
    'slug'        => 'hidden_panel_options',
    'parent'      => 'general_options',
    "name"        => __( "Support button text", 'zn_framework' ),
    "description" => __( "Enter the desired button text that will appear for the support button in header. If left blank, the Support word will be used", 'zn_framework' ),
    "id"          => "hidden_panel_title",
    "std"         => '',
    "type"        => "text"
);

$admin_options[] = array (
    'slug'        => 'hidden_panel_options',
    'parent'      => 'general_options',
    "name"        => __( "Select background color", 'zn_framework' ),
    "description" => __( "Select background color for the hidden panel.", 'zn_framework' ),
    "id"          => "hidden_panel_bg",
    "std"         => '#F0F0F0',
    "type"        => "colorpicker"
);

$admin_options[] = array (
    'slug'        => 'hidden_panel_options',
    'parent'      => 'general_options',
    "name"        => __( "Select font color", 'zn_framework' ),
    "description" => __( "Select font color for the hidden panel.", 'zn_framework' ),
    "id"          => "hidden_panel_fg",
    "std"         => '#000000',
    "type"        => "colorpicker"
);

$admin_options[] = array (
    'slug'        => 'hidden_panel_options',
    'parent'      => 'general_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "hpo_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator"
);

$admin_options[] = array (
    'slug'        => 'hidden_panel_options',
    'parent'      => 'general_options',
    "name"        => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> Video Tutorial: <a href="http://support.hogash.com/kallyas-videos/#kq6-PZHlL8U" target="_blank">Click here to access video tutorial for this options section.</a>', 'zn_framework' ),
    "id"          => "hpo_video",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn_nomargin"
);

// $admin_options[] = array (
//     'slug'        => 'hidden_panel_options',
//     'parent'      => 'general_options',
//     "name"        => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> Written Documentation: <a href="" target="_blank">Click here to access documentation for this options section.</a>', 'zn_framework' ),
//     "id"          => "hpo_link",
//     "std"         => "",
//     "type"        => "zn_title",
//     "class"       => "zn_full zn-admin-helplink zn_nomargin"
// );

$admin_options[] = array (
    'slug'        => 'hidden_panel_options',
    'parent'      => 'general_options',
    "name"        => __( '<a href="http://support.hogash.com/support/forum/wordpress-themes/kallyas-wordpress-theme/" target="_blank">Support Forums</a> &nbsp; | &nbsp; <a href="http://support.hogash.com/kallyas-help/" target="_blank">Kallyas Video Tutorials & Documentation</a> &nbsp; | &nbsp; <a href="http://themeforest.net/downloads?sort_by=Recent+Updates&filter_by=themeforest.net#item-4091658" target="_blank" class="stars-yellow">Rate Kallyas <span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></a>', 'zn_framework' ),
    "id"          => "hpo_otherlinks",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn-custom-title-sm zn_nomargin"
);
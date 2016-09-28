<?php
/**
 * Theme options > Font Options  > Main Menu
 */

// Menu TYPOGRAPHY
$admin_options[] = array (
    'slug'        => 'main_menu_fonts_options',
    'parent'      => 'font_options',
    "name"        => __( "Menu Font Options", 'zn_framework' ),
    "description" => __( "Specify the typography properties for the Main Menu.", 'zn_framework' ),
    "id"          => "menu_font",
    "std"         => array (
        'font-size'   => '14px',
        'font-family'   => 'Lato',
        'line-height' => '14px',
        'color'  => '#fff',
        'font-style'  => 'normal',
        'font-weight'  => '700',
    ),
    'supports'   => array( 'size', 'font', 'line', 'color', 'style', 'weight' ),
    "type"        => "font"
);

$admin_options[] = array (
    'slug'        => 'main_menu_fonts_options',
    'parent'      => 'font_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "mfto_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator"
);

$admin_options[] = array (
    'slug'        => 'main_menu_fonts_options',
    'parent'      => 'font_options',
    "name"        => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> Video Tutorial: <a href="http://support.hogash.com/kallyas-videos/#p-YITyC1ROU" target="_blank">Click here to access video tutorial for this options section.</a>', 'zn_framework' ),
    "id"          => "mfto_video",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn_nomargin"
);

// $admin_options[] = array (
//     'slug'        => 'main_menu_fonts_options',
//     'parent'      => 'font_options',
//     "name"        => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> Written Documentation: <a href="" target="_blank">Click here to access documentation for this options section.</a>', 'zn_framework' ),
//     "id"          => "mfto_link",
//     "std"         => "",
//     "type"        => "zn_title",
//     "class"       => "zn_full zn-admin-helplink zn_nomargin"
// );

$admin_options[] = array (
    'slug'        => 'main_menu_fonts_options',
    'parent'      => 'font_options',
    "name"        => __( '<a href="http://support.hogash.com/support/forum/wordpress-themes/kallyas-wordpress-theme/" target="_blank">Support Forums</a> &nbsp; | &nbsp; <a href="http://support.hogash.com/kallyas-help/" target="_blank">Kallyas Video Tutorials & Documentation</a> &nbsp; | &nbsp; <a href="http://themeforest.net/downloads?sort_by=Recent+Updates&filter_by=themeforest.net#item-4091658" target="_blank" class="stars-yellow">Rate Kallyas <span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></a>', 'zn_framework' ),
    "id"          => "mfto_otherlinks",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn-custom-title-sm zn_nomargin"
);
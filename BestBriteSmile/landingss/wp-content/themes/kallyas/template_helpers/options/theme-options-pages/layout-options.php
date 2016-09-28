<?php
/**
 * Theme options > General Options  > Favicon options
 */


// BOXED LAYOUT
$admin_options[] = array (
    'slug'        => 'layout_options',
    'parent'      => 'layout_options',
    "name"        => __( "Use Boxed Layout", 'zn_framework' ),
    "description" => __( "Choose yes if you want to use the boxed layout instead of the full width.", 'zn_framework' ),
    "id"          => "zn_boxed_layout",
    "std"         => "no",
    "type"        => "zn_radio",
    "options"     => array ( 'no' => __( 'No', 'zn_framework' ), 'yes' => __( 'Yes', 'zn_framework' ) ),
);

// BACKGROUND IMAGE
$admin_options[] = array (
    'slug'        => 'layout_options',
    'parent'      => 'layout_options',
    "name"        => __( "Background Image", 'zn_framework' ),
    "description" => __( "Please choose your desired image to be used as a background", 'zn_framework' ),
    "id"          => "boxed_style_image",
    "std"         => '',
    "options"     => array ( "repeat" => true, "position" => true, "attachment" => true ),
    "type"        => "background",
    'dependency'  => array ( 'element' => 'zn_boxed_layout', 'value' => array ( 'yes' ) ),
);

// BACKGROUND COLOR
$admin_options[] = array (
    'slug'        => 'layout_options',
    'parent'      => 'layout_options',
    "name"        => __( "Background Color", 'zn_framework' ),
    "description" => __( "Please choose your desired background color", 'zn_framework' ),
    "id"          => "boxed_style_color",
    "std"         => '#fff',
    "type"        => "colorpicker",
    'dependency'  => array ( 'element' => 'zn_boxed_layout', 'value' => array ( 'yes' ) ),
);

// BOXED LAYOUT FOR HOMEPAGE
$admin_options[] = array (
    'slug'        => 'layout_options',
    'parent'      => 'layout_options',
    "name"        => __( "Homepage Boxed Layout", 'zn_framework' ),
    "description" => __( "Here you can choose a specific layout setting for the homepage that will override the
		setting from above.", 'zn_framework' ),
    "id"          => "zn_home_boxed_layout",
    "std"         => "def",
    "type"        => "zn_radio",
    "options"     => array (
        'def' => __( 'Default', 'zn_framework' ),
        'no'  => __( 'No', 'zn_framework' ),
        'yes' => __( 'Yes', 'zn_framework' )
    ),
);

$admin_options[] = array (
    'slug'        => 'layout_options',
    'parent'      => 'layout_options',
    "name"        => __( "Content size", 'zn_framework' ),
    "description" => __( "Please choose the desired default size for the content.", 'zn_framework' ),
    "id"          => "zn_width",
    "std"         => "1170",
    "options"     => array ( '1170' => '1170px', '960' => '960px' ),
    "type"        => "select"
);

/*
    Commented as per https://github.com/hogash/kallyas/issues/232
*/
// // START SLIDER AFTER HEADER
// $admin_options[] = array (
//     'slug'        => 'layout_options',
//     'parent'      => 'layout_options',
//     "name"        => __( "Start Slider/header area after header?", 'zn_framework' ),
//     "description" => __( "If set to yes, the slider/subheader area will start bellow the header.", 'zn_framework' ),
//     "id"          => "zn_slider_header",
//     "std"         => "no",
//     "type"        => "zn_radio",
//     "options"     => array ( 'no' => __( 'No', 'zn_framework' ), 'yes' => __( 'Yes', 'zn_framework' ) ),
// );


$admin_options[] = array (
    'slug'        => 'layout_options',
    'parent'      => 'layout_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "lto_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator"
);

$admin_options[] = array (
    'slug'        => 'layout_options',
    'parent'      => 'layout_options',
    "name"        => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> Video Tutorial: <a href="http://support.hogash.com/kallyas-videos/#X6qGyb6Bmaw" target="_blank">Click here to access video tutorial for this options section.</a>', 'zn_framework' ),
    "id"          => "lto_video",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn_nomargin"
);

// $admin_options[] = array (
//     'slug'        => 'layout_options',
//     'parent'      => 'layout_options',
//     "name"        => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> Written Documentation: <a href="" target="_blank">Click here to access documentation for this options section.</a>', 'zn_framework' ),
//     "id"          => "lto_link",
//     "std"         => "",
//     "type"        => "zn_title",
//     "class"       => "zn_full zn-admin-helplink zn_nomargin"
// );

$admin_options[] = array (
    'slug'        => 'layout_options',
    'parent'      => 'layout_options',
    "name"        => __( '<a href="http://support.hogash.com/support/forum/wordpress-themes/kallyas-wordpress-theme/" target="_blank">Support Forums</a> &nbsp; | &nbsp; <a href="http://support.hogash.com/kallyas-help/" target="_blank">Kallyas Video Tutorials & Documentation</a> &nbsp; | &nbsp; <a href="http://themeforest.net/downloads?sort_by=Recent+Updates&filter_by=themeforest.net#item-4091658" target="_blank" class="stars-yellow">Rate Kallyas <span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></a>', 'zn_framework' ),
    "id"          => "lto_otherlinks",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn-custom-title-sm zn_nomargin"
);
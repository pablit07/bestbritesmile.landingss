<?php
/**
 * Theme options > General Options  > Logo options
 */
$admin_options[] = array (
    'slug'        => 'logo_options',
    'parent'      => 'general_options',
    "name"        => __( 'LOGO OPTIONS', 'zn_framework' ),
    "description" => __( 'These options below are related to site\'s logo.  ( <a href="http://hogash.d.pr/108qR" target="_blank" title="Click to open screenshot">Open screenshot</a>).', 'zn_framework' ),
    "id"          => "info_title3",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-large zn-toptabs-margin"
);

// Show LOGO In header
$admin_options[] = array (
    'slug'        => 'logo_options',
    'parent'      => 'general_options',
    "name"        => __( "Show LOGO in header", 'zn_framework' ),
    "description" => __( "Please choose if you want to display the logo or not.", 'zn_framework' ),
    "id"          => "head_show_logo",
    "std"         => "yes",
    "type"        => "zn_radio",
    "options"     => array (
        "yes" => __( "Show", 'zn_framework' ),
        "no"  => __( "Hide", 'zn_framework' )
    )
);

// Logo Upload
$admin_options[] = array (
    'slug'        => 'logo_options',
    'parent'      => 'general_options',
    "name"        => __( "Logo Upload", 'zn_framework' ),
    "description" => __( "Upload your logo.", 'zn_framework' ),
    "id"          => "logo_upload",
    "std"         => '',
    "type"        => "media"
);

// Logo auto size ?

$logo_size    = array (
    "yes"     => __( "Auto resize logo", 'zn_framework' ),
    "no"      => __( "Custom size", 'zn_framework' ),
    "contain" => __( "Contain in header", 'zn_framework' ),
);
$admin_options[] = array (
    'slug'        => 'logo_options',
    'parent'      => 'general_options',
    "name"        => __( "Logo Size :", 'zn_framework' ),
    "description" => __( "Auto resize logo will use the image dimensions, Custom size let's you set the desired logo size and Contain in header will select the proper logo size so that it will be displayed in the header.", 'zn_framework' ),
    "id"          => "logo_size",
    "std"         => "contain",
    "type"        => "zn_radio",
    "options"     => $logo_size,
);

// Logo Dimensions
$default_size = array (
    'height' => '55',
    'width'  => '125'
);
$admin_options[] = array (
    'slug'        => 'logo_options',
    'parent'      => 'general_options',
    "name"        => __( "Logo manual sizes", 'zn_framework' ),
    "description" => __( 'Please insert your desired logo size in pixels ( for example "35" )', 'zn_framework' ),
    "id"          => "logo_manual_size",
    "std"         => $default_size,
    "type"        => "image_size",
    'dependency'  => array ( 'element' => 'logo_size', 'value' => array ( 'no' ) ),
);

// Logo typography for link

$admin_options[] = array (
    'slug'        => 'logo_options',
    'parent'      => 'general_options',
    "name"        => __( "Logo Link Options", 'zn_framework' ),
    "description" => __( "Specify the logo typography properties. Will only work if you don't upload a logo image.", 'zn_framework' ),
    "id"          => "logo_font",
    "std"         => array (
        'font-size'   => '36px',
        'font-family'   => 'Open Sans',
        'font-style'  => 'normal',
        'color'  => '#000',
        'line-height' => '40px'
    ),
    'supports'   => array( 'size', 'font', 'style', 'color', 'line', 'weight' ),
    "type"        => "font"
);

// Logo Hover Typography

$admin_options[] = array (
    'slug'        => 'logo_options',
    'parent'      => 'general_options',
    "name"        => __( "Logo Link Hover Color", 'zn_framework' ),
    "description" => __( "Specify the logo hover color. Will only work if you don't upload a logo image. ", 'zn_framework' ),
    "id"          => "logo_hover",
    "std"         => array (
        'color' => '#CD2122',
        'font-family'  => 'Open Sans'
    ),
    'supports'   => array( 'font', 'color' ),
    "type"        => "font"
);

// Logo Sticky
$admin_options[] = array (
    'slug'        => 'logo_options',
    'parent'      => 'general_options',
    "name"        => __( "Sticky Logo", 'zn_framework' ),
    "description" => __( "Will display a secondary logo when header is sticky and scrolling the page. <strong>ONLY</strong> available if you have Sticky Header enabled in General Options. ", 'zn_framework' ),
    "id"          => "logo_sticky",
    "std"         => '',
    "type"        => "media"
);


$admin_options[] = array (
    'slug'        => 'logo_options',
    'parent'      => 'general_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "lgo_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator"
);

$admin_options[] = array (
    'slug'        => 'logo_options',
    'parent'      => 'general_options',
    "name"        => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> Video Tutorial: <a href="http://support.hogash.com/kallyas-videos/#m2dbZdeciZs" target="_blank">Click here to access video tutorial for this options section.</a>', 'zn_framework' ),
    "id"          => "lgo_video",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn_nomargin"
);

// $admin_options[] = array (
//     'slug'        => 'logo_options',
//     'parent'      => 'general_options',
//     "name"        => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> Written Documentation: <a href="" target="_blank">Click here to access documentation for this options section.</a>', 'zn_framework' ),
//     "id"          => "lgo_link",
//     "std"         => "",
//     "type"        => "zn_title",
//     "class"       => "zn_full zn-admin-helplink zn_nomargin"
// );

$admin_options[] = array (
    'slug'        => 'logo_options',
    'parent'      => 'general_options',
    "name"        => __( '<a href="http://support.hogash.com/support/forum/wordpress-themes/kallyas-wordpress-theme/" target="_blank">Support Forums</a> &nbsp; | &nbsp; <a href="http://support.hogash.com/kallyas-help/" target="_blank">Kallyas Video Tutorials & Documentation</a> &nbsp; | &nbsp; <a href="http://themeforest.net/downloads?sort_by=Recent+Updates&filter_by=themeforest.net#item-4091658" target="_blank" class="stars-yellow">Rate Kallyas <span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></a>', 'zn_framework' ),
    "id"          => "lgo_otherlinks",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn-custom-title-sm zn_nomargin"
);

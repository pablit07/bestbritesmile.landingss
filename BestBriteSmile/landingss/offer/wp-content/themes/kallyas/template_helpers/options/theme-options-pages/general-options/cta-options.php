<?php

$admin_options[] = array (
    'slug'        => 'cta_options',
    'parent'      => 'general_options',
    "name"        => __( 'HEADER\'S CALL TO ACTION BUTTON OPTIONS', 'zn_framework' ),
    "description" => __( 'These options below are related to site\'s call to action button in header. ( <a href="http://hogash.d.pr/1leyL" target="_blank" title="Click to open screenshot">Open screenshot</a>).', 'zn_framework' ),
    "id"          => "info_title6",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-large zn-toptabs-margin"
);

// Show Call to Action Button In header
$admin_options[] = array (
    'slug'        => 'cta_options',
    'parent'      => 'general_options',
    "name"        => __( "Show Call to Action button in header", 'zn_framework' ),
    "description" => __( "Please choose if you want to display the call to action button or not.", 'zn_framework' ),
    "id"          => "head_show_cta",
    "std"         => "no",
    "type"        => "zn_radio",
    "options"     => array (
        "yes" => __( "Show", 'zn_framework' ),
        "no"  => __( "Hide", 'zn_framework' )
    )
);
// Style Call to Action Button In header
$admin_options[] = array (
    'slug'        => 'cta_options',
    'parent'      => 'general_options',
    "name"        => __( "Call to Action button style", 'zn_framework' ),
    "description" => __( "Select a style.", 'zn_framework' ),
    "id"          => "head_show_cta_style",
    "std"         => "ribbon",
    "type"        => "select",
    "options"     => array (
        "ribbon" => __( "Ribbon style", 'zn_framework' ),
        "lined"  => __( "Lined button", 'zn_framework' )
    ),
    'dependency'  => array ( 'element' => 'head_show_cta', 'value' => array ( 'yes' ) ),
);
// BG Color
$admin_options[] = array (
    'slug'        => 'cta_options',
    'parent'      => 'general_options',
    "name"        => __( "Select background color", 'zn_framework' ),
    "description" => __( "Select Call to action (ribbon style) background color.", 'zn_framework' ),
    "id"          => "wpk_cs_bg_color",
    "std"         => '#cd2122',
    "type"        => "colorpicker",
    'dependency'  => array ( 'element' => 'head_show_cta', 'value' => array ( 'yes' ) ),
);

// Set text for Call to Action Button In header
$admin_options[] = array (
    'slug'        => 'cta_options',
    'parent'      => 'general_options',
    "name"        => __( "Set the text for the Call to Action button", 'zn_framework' ),
    "description" => __( "Select the text you want to display int the call to action button.", 'zn_framework' ),
    "id"          => "head_set_text_cta",
    "type"        => "text",
    "std"         => __( "<strong>FREE</strong>QUOTE", 'zn_framework' ),
    'dependency'  => array ( 'element' => 'head_show_cta', 'value' => array ( 'yes' ) ),
);

// FG Color
$admin_options[] = array (
    'slug'        => 'cta_options',
    'parent'      => 'general_options',
    "name"        => __( "Select text color", 'zn_framework' ),
    "description" => __( "Select text color.", 'zn_framework' ),
    "id"          => "wpk_cs_fg_color",
    "std"         => '#fff',
    "type"        => "colorpicker",
    'dependency'  => array ( 'element' => 'head_show_cta', 'value' => array ( 'yes' ) ),
);


// Add link to Call to Action Button
$admin_options[] = array (
    'slug'        => 'cta_options',
    'parent'      => 'general_options',
    "name"        => __( "Set the link for the Call to Action button in header", 'zn_framework' ),
    "description" => __( "Set the URL to link the Call to Action button to.", 'zn_framework' ),
    "id"          => "head_add_cta_link",
    "std"         => "",
    "type"        => "link",
    "options"     => array (
        '_self'     => __( "Same window", 'zn_framework' ),
        '_blank'    => __( "New window", 'zn_framework' ),
        'modal'     => __( "Modal Image", 'zn_framework' ),
        'modal_iframe'     => __( "Modal Iframe", 'zn_framework' ),
        'modal_inline'     => __( "Modal Inline content", 'zn_framework' ),
        'smoothscroll' => __( "Smooth Scroll to Anchor", 'zn_framework' )
    ),
    'dependency'  => array ( 'element' => 'head_show_cta', 'value' => array ( 'yes' ) ),
);


$admin_options[] = array (
    'slug'        => 'cta_options',
    'parent'      => 'general_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "cto_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator"
);

$admin_options[] = array (
    'slug'        => 'cta_options',
    'parent'      => 'general_options',
    "name"        => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> Video Tutorial: <a href="http://support.hogash.com/kallyas-videos/#TuXcJu9jl7c" target="_blank">Click here to access video tutorial for this options section.</a>', 'zn_framework' ),
    "id"          => "cto_video",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn_nomargin"
);

// $admin_options[] = array (
//     'slug'        => 'cta_options',
//     'parent'      => 'general_options',
//     "name"        => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> Written Documentation: <a href="" target="_blank">Click here to access documentation for this options section.</a>', 'zn_framework' ),
//     "id"          => "cto_link",
//     "std"         => "",
//     "type"        => "zn_title",
//     "class"       => "zn_full zn-admin-helplink zn_nomargin"
// );

$admin_options[] = array (
    'slug'        => 'cta_options',
    'parent'      => 'general_options',
    "name"        => __( '<a href="http://support.hogash.com/support/forum/wordpress-themes/kallyas-wordpress-theme/" target="_blank">Support Forums</a> &nbsp; | &nbsp; <a href="http://support.hogash.com/kallyas-help/" target="_blank">Kallyas Video Tutorials & Documentation</a> &nbsp; | &nbsp; <a href="http://themeforest.net/downloads?sort_by=Recent+Updates&filter_by=themeforest.net#item-4091658" target="_blank" class="stars-yellow">Rate Kallyas <span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></a>', 'zn_framework' ),
    "id"          => "cto_otherlinks",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn-custom-title-sm zn_nomargin"
);
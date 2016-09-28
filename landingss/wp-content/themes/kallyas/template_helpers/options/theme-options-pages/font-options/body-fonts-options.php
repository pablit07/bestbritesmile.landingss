<?php
/**
 * Theme options > Font Options  > Body Fonts
 */

// Body font options
$admin_options[] = array (
    'slug'        => 'body_font_options',
    'parent'      => 'font_options',
    "name"        => __( "Body Font Options", 'zn_framework' ),
    "description" => __( "Specify the typography properties for the body section ( this will apply to all the content on the page ). <br><br><strong>* Note:</strong> Don't use the colorpicker!! There is another color option in Kallyas options > Color Options > Text color. Make sure that one is used. We'll keep this one just for backwards compatibility only, but it will be removed in future versions.", 'zn_framework' ),
    "id"          => "body_font",
    "std"         => array (
        'font-size'   => '13px',
        'font-family'   => 'Open Sans',
        'line-height' => '19px',
        'color'  => ''
    ),
    'supports'   => array( 'size', 'font', 'line', 'color' ),
    "type"        => "font"
);

// Grey area font options

$admin_options[] = array (
    'slug'        => 'body_font_options',
    'parent'      => 'font_options',
    "name"        => __( "Grey Area Font Options", 'zn_framework' ),
    "description" => __( "Specify the typography properties for the grey area section.", 'zn_framework' ),
    "id"          => "ga_font",
    "std"         => array (
        'font-size'   => '13px',
        'font-family'   => 'Open Sans',
        'line-height' => '19px',
        'color'  => ''
    ),
    'supports'   => array( 'size', 'font', 'line', 'color' ),
    "type"        => "font"
);

// Footer font options
$admin_options[] = array (
    'slug'        => 'body_font_options',
    'parent'      => 'font_options',
    "name"        => __( "Footer Font Options", 'zn_framework' ),
    "description" => __( "Specify the typography properties for the Footer.", 'zn_framework' ),
    "id"          => "footer_font",
    "std"         => array (
        'font-size'   => '13px',
        'font-family'   => 'Open Sans',
        'line-height' => '19px',
        'color'  => ''
    ),
    'supports'   => array( 'size', 'font', 'line', 'color' ),
    "type"        => "font"
);

$admin_options[] = array (
    'slug'        => 'body_font_options',
    'parent'      => 'font_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "bfto_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator"
);

$admin_options[] = array (
    'slug'        => 'body_font_options',
    'parent'      => 'font_options',
    "name"        => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> Video Tutorial: <a href="http://support.hogash.com/kallyas-videos/#p-YITyC1ROU" target="_blank">Click here to access video tutorial for this options section.</a>', 'zn_framework' ),
    "id"          => "bfto_video",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn_nomargin"
);

// $admin_options[] = array (
//     'slug'        => 'body_font_options',
//     'parent'      => 'font_options',
//     "name"        => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> Written Documentation: <a href="" target="_blank">Click here to access documentation for this options section.</a>', 'zn_framework' ),
//     "id"          => "bfto_link",
//     "std"         => "",
//     "type"        => "zn_title",
//     "class"       => "zn_full zn-admin-helplink zn_nomargin"
// );

$admin_options[] = array (
    'slug'        => 'body_font_options',
    'parent'      => 'font_options',
    "name"        => __( '<a href="http://support.hogash.com/support/forum/wordpress-themes/kallyas-wordpress-theme/" target="_blank">Support Forums</a> &nbsp; | &nbsp; <a href="http://support.hogash.com/kallyas-help/" target="_blank">Kallyas Video Tutorials & Documentation</a> &nbsp; | &nbsp; <a href="http://themeforest.net/downloads?sort_by=Recent+Updates&filter_by=themeforest.net#item-4091658" target="_blank" class="stars-yellow">Rate Kallyas <span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></a>', 'zn_framework' ),
    "id"          => "bfto_otherlinks",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn-custom-title-sm zn_nomargin"
);
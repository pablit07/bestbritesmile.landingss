<?php
/**
 * Theme options > Font Options  > Headings
 */

$admin_options[] = array (
    'slug'        => 'headings_font_options',
    'parent'      => 'font_options',
    "name"        => __( "H1 Typography", 'zn_framework' ),
    "description" => __( "Specify the typography properties for headings.", 'zn_framework' ),
    "id"          => "h1_typo",
    "std"         => array (
        'font-size'   => '36px',
        'font-family'   => 'Open Sans',
        'line-height' => '40px',
        'font-style' => 'normal',
        'font-weight' => '400',
    ),
    'supports'   => array( 'size', 'font', 'style', 'line', 'weight' ),
    "type"        => "font"
);

$admin_options[] = array (
    'slug'        => 'headings_font_options',
    'parent'      => 'font_options',
    "name"        => __( "H2 Typography", 'zn_framework' ),
    "description" => __( "Specify the typography properties for headings.", 'zn_framework' ),
    "id"          => "h2_typo",
    "std"         => array (
        'font-size'   => '30px',
        'font-family'   => 'Open Sans',
        'line-height' => '40px',
        'font-style' => 'normal',
        'font-weight' => '400',
    ),
    'supports'   => array( 'size', 'font', 'style', 'line', 'weight' ),
    "type"        => "font"
);

$admin_options[] = array (
    'slug'        => 'headings_font_options',
    'parent'      => 'font_options',
    "name"        => __( "H3 Typography", 'zn_framework' ),
    "description" => __( "Specify the typography properties for headings.", 'zn_framework' ),
    "id"          => "h3_typo",
    "std"         => array (
        'font-size'   => '24px',
        'font-family'   => 'Open Sans',
        'line-height' => '40px',
        'font-style' => 'normal',
        'font-weight' => '400',
    ),
    'supports'   => array( 'size', 'font', 'style', 'line', 'weight' ),
    "type"        => "font"
);

$admin_options[] = array (
    'slug'        => 'headings_font_options',
    'parent'      => 'font_options',
    "name"        => __( "H4 Typography", 'zn_framework' ),
    "description" => __( "Specify the typography properties for headings.", 'zn_framework' ),
    "id"          => "h4_typo",
    "std"         => array (
        'font-size'   => '14px',
        'font-family'   => 'Open Sans',
        'line-height' => '20px',
        'font-style' => 'normal',
        'font-weight' => '400',
    ),
    'supports'   => array( 'size', 'font', 'style', 'line', 'weight' ),
    "type"        => "font"
);

$admin_options[] = array (
    'slug'        => 'headings_font_options',
    'parent'      => 'font_options',
    "name"        => __( "H5 Typography", 'zn_framework' ),
    "description" => __( "Specify the typography properties for headings.", 'zn_framework' ),
    "id"          => "h5_typo",
    "std"         => array (
        'font-size'   => '12px',
        'font-family'   => 'Open Sans',
        'line-height' => '20px',
        'font-style' => 'normal',
        'font-weight' => '400',
    ),
    'supports'   => array( 'size', 'font', 'style', 'line', 'weight' ),
    "type"        => "font"
);

$admin_options[] = array (
    'slug'        => 'headings_font_options',
    'parent'      => 'font_options',
    "name"        => __( "H6 Typography", 'zn_framework' ),
    "description" => __( "Specify the typography properties for headings.", 'zn_framework' ),
    "id"          => "h6_typo",
    "std"         => array (
        'font-size'   => '12px',
        'font-family'   => 'Open Sans',
        'line-height' => '20px',
        'font-style' => 'normal',
        'font-weight' => '400',
    ),
    'supports'   => array( 'size', 'font', 'style', 'line', 'weight' ),
    "type"        => "font"
);

$admin_options[] = array (
    'slug'        => 'headings_font_options',
    'parent'      => 'font_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "hdfo_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator"
);

$admin_options[] = array (
    'slug'        => 'headings_font_options',
    'parent'      => 'font_options',
    "name"        => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> Video Tutorial: <a href="http://support.hogash.com/kallyas-videos/#p-YITyC1ROU" target="_blank">Click here to access video tutorial for this options section.</a>', 'zn_framework' ),
    "id"          => "hdfo_video",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn_nomargin"
);

// $admin_options[] = array (
//     'slug'        => 'headings_font_options',
//     'parent'      => 'font_options',
//     "name"        => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> Written Documentation: <a href="" target="_blank">Click here to access documentation for this options section.</a>', 'zn_framework' ),
//     "id"          => "hdfo_link",
//     "std"         => "",
//     "type"        => "zn_title",
//     "class"       => "zn_full zn-admin-helplink zn_nomargin"
// );

$admin_options[] = array (
    'slug'        => 'headings_font_options',
    'parent'      => 'font_options',
    "name"        => __( '<a href="http://support.hogash.com/support/forum/wordpress-themes/kallyas-wordpress-theme/" target="_blank">Support Forums</a> &nbsp; | &nbsp; <a href="http://support.hogash.com/kallyas-help/" target="_blank">Kallyas Video Tutorials & Documentation</a> &nbsp; | &nbsp; <a href="http://themeforest.net/downloads?sort_by=Recent+Updates&filter_by=themeforest.net#item-4091658" target="_blank" class="stars-yellow">Rate Kallyas <span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></a>', 'zn_framework' ),
    "id"          => "hdfo_otherlinks",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn-custom-title-sm zn_nomargin"
);
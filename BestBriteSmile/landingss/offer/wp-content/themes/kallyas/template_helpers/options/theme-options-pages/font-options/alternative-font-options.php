<?php
/**
 * Theme options > Font Options  > Alternative font
 */
$admin_options[] = array (
    'slug'        => 'alternative_fonts_options',
    'parent'      => 'font_options',
    "name"        => __( "Custom Selectors Options", 'zn_framework' ),
    "description" => __( "This font is used by various elements in the theme. To add other selectors using this font, use the Custom CSS feature in the page builder or CAREFULLY edit /css/dynamic_css.php file, by searching for 'alternative_font' string.", 'zn_framework' ),
    "id"          => "alternative_font",
    "std"         => array (
        'font-family'   => 'Lato'
    ),
    'supports'   => array( 'font'),
    "type"        => "font"
);


$admin_options[] = array (
    'slug'        => 'alternative_fonts_options',
    'parent'      => 'font_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "afo_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator"
);

$admin_options[] = array (
    'slug'        => 'alternative_fonts_options',
    'parent'      => 'font_options',
    "name"        => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> Video Tutorial: <a href="http://support.hogash.com/kallyas-videos/#p-YITyC1ROU" target="_blank">Click here to access video tutorial for this options section.</a>', 'zn_framework' ),
    "id"          => "afo_video",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn_nomargin"
);

// $admin_options[] = array (
//     'slug'        => 'alternative_fonts_options',
//     'parent'      => 'font_options',
//     "name"        => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> Written Documentation: <a href="" target="_blank">Click here to access documentation for this options section.</a>', 'zn_framework' ),
//     "id"          => "afo_link",
//     "std"         => "",
//     "type"        => "zn_title",
//     "class"       => "zn_full zn-admin-helplink zn_nomargin"
// );

$admin_options[] = array (
    'slug'        => 'alternative_fonts_options',
    'parent'      => 'font_options',
    "name"        => __( '<a href="http://support.hogash.com/support/forum/wordpress-themes/kallyas-wordpress-theme/" target="_blank">Support Forums</a> &nbsp; | &nbsp; <a href="http://support.hogash.com/kallyas-help/" target="_blank">Kallyas Video Tutorials & Documentation</a> &nbsp; | &nbsp; <a href="http://themeforest.net/downloads?sort_by=Recent+Updates&filter_by=themeforest.net#item-4091658" target="_blank" class="stars-yellow">Rate Kallyas <span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></a>', 'zn_framework' ),
    "id"          => "afo_otherlinks",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn-custom-title-sm zn_nomargin"
);
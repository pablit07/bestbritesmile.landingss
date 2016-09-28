<?php
/**
 * Theme options > COLOR OPTIONS
 */

$admin_options[] = array (
    'slug'        => 'color_options',
    'parent'      => 'color_options',
    "name"        => __( "MAIN COLOR", 'zn_framework' ),
    "description" => __( "Please choose a main color for your site. This color will be used for various elements within the site, as text color (and hover) and background color (and hover).", 'zn_framework' ),
    "id"          => "zn_main_color",
    "std"         => "#cd2122",
    "type"        => "colorpicker"
);

// ********************

$admin_options[] = array (
    'slug'        => 'color_options',
    'parent'      => 'color_options',
    "name"        => __( 'Global Site Colors', 'zn_framework' ),
    "description" => __( 'These are the global site color options.', 'zn_framework' ),
    "id"          => "clo_title_main",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator"
);

// BACKGROUND BODY COLOR

// $admin_options[] = array (
//     'slug'        => 'color_options',
//     'parent'      => 'color_options',
//     "name"        => __( "TEXT COLOR", 'zn_framework' ),
//     "description" => __( "Please choose a default color for the site's general text color. <br>* Note: There is another color option in Kallyas options > Font options > Body Options. Make sure that option is empty. We'll keep that one just for backwards compatibility only, but it will be removed.", 'zn_framework' ),
//     "id"          => "zn_body_def_textcolor",
//     "std"         => "",
//     "type"        => "colorpicker"
// );

// $admin_options[] = array (
//     'slug'        => 'color_options',
//     'parent'      => 'color_options',
//     "name"        => __( "LINKS COLORS", 'zn_framework' ),
//     "description" => __( "Please choose a default color for the site's general links color.", 'zn_framework' ),
//     "id"          => "zn_body_def_linkscolor",
//     "std"         => "",
//     "type"        => "colorpicker"
// );

// $admin_options[] = array (
//     'slug'        => 'color_options',
//     'parent'      => 'color_options',
//     "name"        => __( "HOVER LINKS COLOR", 'zn_framework' ),
//     "description" => __( "Please choose a default color for the site's general hover links color.", 'zn_framework' ),
//     "id"          => "zn_body_def_linkscolor_hov",
//     "std"         => "",
//     "type"        => "colorpicker"
// );

$admin_options[] = array (
    'slug'        => 'color_options',
    'parent'      => 'color_options',
    "name"        => __( "BACKGROUND COLOR", 'zn_framework' ),
    "description" => __( "Please choose a default color for the site's body.", 'zn_framework' ),
    "id"          => "zn_body_def_color",
    "std"         => "",
    "type"        => "colorpicker"
);

$admin_options[] = array (
    'slug'        => 'color_options',
    'parent'      => 'color_options',
    "name"        => __( "BACKGROUND IMAGE", 'zn_framework' ),
    "description" => __( "Please choose your desired image to be used as as body background.", 'zn_framework' ),
    "id"          => "body_back_image",
    "std"         => '',
    "options"     => array ( "repeat" => true, "position" => true, "attachment" => true, "size" => true ),
    "type"        => "background"
);

// ********************

$admin_options[] = array (
    'slug'        => 'color_options',
    'parent'      => 'color_options',
    "name"        => __( 'Various Color Options', 'zn_framework' ),
    "description" => __( 'These are various colors for different parts from the site.', 'zn_framework' ),
    "id"          => "clo_title_various",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator"
);

$admin_options[] = array (
    'slug'        => 'color_options',
    'parent'      => 'color_options',
    "name"        => __( "Top Nav default Color", 'zn_framework' ),
    "description" => __( "Please choose a color for the top nav links in header.", 'zn_framework' ),
    "id"          => "zn_top_nav_color",
    "std"         => "",
    "type"        => "colorpicker"
);

$admin_options[] = array (
    'slug'        => 'color_options',
    'parent'      => 'color_options',
    "name"        => __( "Top Nav Hover Color", 'zn_framework' ),
    "description" => __( "Please choose a color for the top nav links in header when hovering over them.", 'zn_framework' ),
    "id"          => "zn_top_nav_h_color",
    "std"         => "",
    "type"        => "colorpicker"
);

$admin_options[] = array (
    'slug'        => 'color_options',
    'parent'      => 'color_options',
    "id"          => "clo_title_sep1",
    "type"        => "zn_title",
    "class"       => "zn_full zn-gray-separator"
);


$admin_options[] = array (
    'slug'        => 'color_options',
    'parent'      => 'color_options',
    "name"        => __( "Header Background Color on Mobiles", 'zn_framework' ),
    "description" => __( "This will change the existing <strong>background color</strong> on Mobile devices, more exactly for device width less than 480px.", 'zn_framework' ),
    "id"          => "zn_header_resp_color",
    "std"         => "#2f2f2f",
    "type"        => "colorpicker"
);

$admin_options[] = array (
    'slug'        => 'color_options',
    'parent'      => 'color_options',
    "name"        => __( "Header Text Color on Mobiles", 'zn_framework' ),
    "description" => __( "This will change the existing <strong>text color</strong> on Mobile devices, more exactly for device width less than 480px.", 'zn_framework' ),
    "id"          => "zn_header_resp_textcolor",
    "std"         => "#FFF",
    "type"        => "colorpicker"
);

$admin_options[] = array (
    'slug'        => 'color_options',
    'parent'      => 'color_options',
    "name"        => __( "Header Text Hover Color on Mobiles", 'zn_framework' ),
    "description" => __( "This will change the existing text <strong>hover color</strong> on Mobile devices, more exactly for device width less than 480px.", 'zn_framework' ),
    "id"          => "zn_header_resp_textcolor_hov",
    "std"         => "#FFF",
    "type"        => "colorpicker"
);


// ********************

$admin_options[] = array (
    'slug'        => 'color_options',
    'parent'      => 'color_options',
    "name"        => __( 'Deprecated', 'zn_framework' ),
    "description" => __( 'These some deprecated options that will get removed in the future versions so please try to find an alternative..', 'zn_framework' ),
    "id"          => "clo_title_depr",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator"
);

$admin_options[] = array (
    'slug'        => 'color_options',
    'parent'      => 'color_options',
    "name"        => __( "Grey area background Color <strong>( deprecated )</strong>", 'zn_framework' ),
    "description" => __( "Please choose a background color for the grey area.", 'zn_framework' ),
    "id"          => "zn_gr_area_def_color",
    "std"         => "",
    "type"        => "colorpicker"
);

// BACKGROUND IMAGE
$admin_options[] = array (
    'slug'        => 'color_options',
    'parent'      => 'color_options',
    "name"        => __( "Grey Area Background Image <strong>( deprecated )</strong>", 'zn_framework' ),
    "description" => __( "Please choose your desired image to be used as as grey area background", 'zn_framework' ),
    "id"          => "gr_arr_back_image",
    "std"         => '',
    "options"     => array ( "repeat" => true, "position" => true, "attachment" => true ),
    "type"        => "background"
);

/*
    Commented as per https://github.com/hogash/kallyas/issues/386
 */
// $admin_options[] = array (
//     'slug'        => 'color_options',
//     'parent'      => 'color_options',
//     "name"        => __( "Color Style", 'zn_framework' ),
//     "description" => __( "Please choose the desired default size for the content.", 'zn_framework' ),
//     "id"          => "zn_main_style",
//     "std"         => "light",
//     "options"     => array (
//         'light' => __( 'Light Style ( default )', 'zn_framework' ),
//         'dark'  => __( 'Dark Style', 'zn_framework' )
//     ),
//     "type"        => "select"
// );


$admin_options[] = array (
    'slug'        => 'color_options',
    'parent'      => 'color_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "clmo_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator"
);

$admin_options[] = array (
    'slug'        => 'color_options',
    'parent'      => 'color_options',
    "name"        => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> Video Tutorial: <a href="http://support.hogash.com/kallyas-videos/#MkYR_3PYbXU" target="_blank">Click here to access video tutorial for this options section.</a>', 'zn_framework' ),
    "id"          => "clmo_video",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn_nomargin"
);

// $admin_options[] = array (
//     'slug'        => 'color_options',
//     'parent'      => 'color_options',
//     "name"        => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> Written Documentation: <a href="" target="_blank">Click here to access documentation for this options section.</a>', 'zn_framework' ),
//     "id"          => "clmo_link",
//     "std"         => "",
//     "type"        => "zn_title",
//     "class"       => "zn_full zn-admin-helplink zn_nomargin"
// );

$admin_options[] = array (
    'slug'        => 'color_options',
    'parent'      => 'color_options',
    "name"        => __( '<a href="http://support.hogash.com/support/forum/wordpress-themes/kallyas-wordpress-theme/" target="_blank">Support Forums</a> &nbsp; | &nbsp; <a href="http://support.hogash.com/kallyas-help/" target="_blank">Kallyas Video Tutorials & Documentation</a> &nbsp; | &nbsp; <a href="http://themeforest.net/downloads?sort_by=Recent+Updates&filter_by=themeforest.net#item-4091658" target="_blank" class="stars-yellow">Rate Kallyas <span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></a>', 'zn_framework' ),
    "id"          => "clmo_otherlinks",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn-custom-title-sm zn_nomargin"
);
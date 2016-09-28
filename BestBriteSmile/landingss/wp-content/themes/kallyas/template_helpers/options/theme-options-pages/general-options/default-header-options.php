<?php
/**
 * Theme options > General Options  > Default Header Options
 */

$admin_options[] = array (
    'slug'        => 'default_header_options',
    'parent'      => 'general_options',
    "name"        => __( 'DEFAULT SUB-HEADER OPTIONS', 'zn_framework' ),
    "description" => __( 'These options below are related to site\'s default sub-header block. ( <a href="http://hogash.d.pr/14aJa" target="_blank" title="Click to open screenshot">Open screenshot</a>).', 'zn_framework' ),
    "id"          => "info_title9",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-large zn-toptabs-margin"
);

// Header background image

$admin_options[] = array (
    'slug'        => 'default_header_options',
    'parent'      => 'general_options',
    "name"        => __( "Sub-Header Background image", 'zn_framework' ),
    "description" => __( "Upload your desired background image for the header.", 'zn_framework' ),
    "id"          => "def_header_background",
    "std"         => '',
    "type"        => "media"
);

// Header background color
$admin_options[] = array (
    'slug'        => 'default_header_options',
    'parent'      => 'general_options',
    "name"        => __( "Sub-Header Background Color", 'zn_framework' ),
    "description" => __( "Here you can choose a default color for your header.If you do not select a background image, this color will be used as background.", 'zn_framework' ),
    "id"          => "def_header_color",
    "std"         => '#AAAAAA',
    "type"        => "colorpicker"
);

$admin_options[] = array (
    'slug'        => 'default_header_options',
    'parent'      => 'general_options',
    "name"        => __( "Add gradient over color?", 'zn_framework' ),
    "description" => __( "Select yes if you want add a gradient over the selected color", 'zn_framework' ),
    "id"          => "def_grad_bg",
    "std"         => "1",
    "type"        => "select",
    "options"     => array (
        "1" => __( "Yes", 'zn_framework' ),
        "0" => __( "No", 'zn_framework' ),
    ),
    "class"       => ""
);

// HEADER - Animate

$admin_options[]    = array (
    'slug'        => 'default_header_options',
    'parent'      => 'general_options',
    "name"        => __( "Use animated header", 'zn_framework' ),
    "description" => __( "Select if you want to add an animation on top of your image/color.", 'zn_framework' ),
    "id"          => "def_header_animate",
    "std"         => "0",
    "type"        => "select",
    "options"     => array (
        '1' => __('Yes', 'zn_framework'),
        '0' => __('No', 'zn_framework'),
    ),
    "class"       => ""
);

$admin_options[] = array (
    'slug'        => 'default_header_options',
    'parent'      => 'general_options',
    "name"        => __( "Add Glare effect?", 'zn_framework' ),
    "description" => __( "Select yes if you want to add a glare effect over the background", 'zn_framework' ),
    "id"          => "def_glare",
    "std"         => "0",
    "type"        => "select",
    "options"     => array (
        "1" => __( "Yes", 'zn_framework' ),
        "0" => __( "No", 'zn_framework' )
    ),
    "class"       => ""
);

$admin_options[] = array (
    'slug'        => 'default_header_options',
    'parent'      => 'general_options',
    "name"        => __( "Bottom style?", 'zn_framework' ),
    "description" => __( "Select the sub-header bottom style you want to use", 'zn_framework' ),
    "id"          => "def_bottom_style",
    "std"         => "0",
    "type"        => "select",
    "options"     => array (
        "none"      => __( "None", 'zn_framework' ),
        "shadow"    => __( "Shadow Up", 'zn_framework' ),
        "shadow_ud" => __( "Shadow Up and down", 'zn_framework' ),
        "mask1"     => __( "Bottom mask 1", 'zn_framework' ),
        "mask2"     => __( "Bottom mask 2", 'zn_framework' )
    )
);

// HEADER show breadcrumbs

$admin_options[]     = array (
    'slug'        => 'default_header_options',
    'parent'      => 'general_options',
    "name"        => __( "Show Breadcrumbs", 'zn_framework' ),
    "description" => __( "Select if you want to show the breadcrumbs or not.", 'zn_framework' ),
    "id"          => "def_header_bread",
    "std"         => "",
    "type"        => "select",
    "options"     => array (
        '1' => __( 'Show', 'zn_framework' ),
        '0' => __( 'Hide', 'zn_framework' ),
    ),
    "class"       => ""
);

// HEADER show date

$admin_options[]    = array (
    'slug'        => 'default_header_options',
    'parent'      => 'general_options',
    "name"        => __( "Show Date", 'zn_framework' ),
    "description" => __( "Select if you want to show the current date under breadcrumbs or not.", 'zn_framework' ),
    "id"          => "def_header_date",
    "std"         => "",
    "type"        => "select",
    "options"     => array (
        '1' => 'Show',
        '0' => 'Hide'
    ),
    "class"       => ""
);

// HEADER show title

$admin_options[]     = array (
    'slug'        => 'default_header_options',
    'parent'      => 'general_options',
    "name"        => __( "Show Page Title", 'zn_framework' ),
    "description" => __( "Select if you want to show the page title or not.", 'zn_framework' ),
    "id"          => "def_header_title",
    "std"         => "",
    "type"        => "select",
    "options"     => array (
        '1' => __( 'Show', 'zn_framework' ),
        '0' => __( 'Hide', 'zn_framework' ),
    ),
    "class"       => ""
);

// HEADER show subtitle

$admin_options[]        = array (
    'slug'        => 'default_header_options',
    'parent'      => 'general_options',
    "name"        => __( "Show Page Subtitle", 'zn_framework' ),
    "description" => __( "Select if you want to show the page subtitle or not.", 'zn_framework' ),
    "id"          => "def_header_subtitle",
    "std"         => "",
    "type"        => "select",
    "options"     => array (
        '1' => __( 'Show', 'zn_framework' ),
        '0' => __( 'Hide', 'zn_framework' ),
    ),
    "class"       => ""
);

// HEADER Custom height
//@since 3.6.9
//@k
// @4.0.7 Upgraded to slider field
$admin_options[]        = array (
    'slug'        => 'default_header_options',
    'parent'      => 'general_options',
    "name"        => __( "Default Sub-Header Height", 'zn_framework' ),
    "description" => __( "Please enter your desired height in pixels for this header.", 'zn_framework' ),
    "id"          => "def_header_custom_height",
    "std"         => "300",
    "type" => "slider",
    'class'       => 'zn_full',
    'helpers'     => array(
        'min' => '1',
        'max' => '1280',
        'step' => '1'
    )
);

/**
 * @Marius: For the moment breakpoint options are added, but disabled and commented and not applied here. That's because the default subheader applies generally, and to keep things simple, advanced settigns should only be available for "Unlimited subheader styles" and "Custom subheader element"
 */

// $admin_options[]        = array (
//     'slug'        => 'default_header_options',
//     'parent'      => 'general_options',
//     "name"        => __( "Edit height and padding for each device breakpoint", 'zn_framework' ),
//     "description" => __( "Edit the height and padding options for each breakpoint (device). This will enable you to have more control over the subheader on each device. For example you might want the subheader to be shorter on mobiles, but taller on desktops.", 'zn_framework' ),
//     "id"          => "def_header_br_options",
//     "std"         => "lg",
//     "type"        => "zn_radio",
//     "options"     => array (
//         "lg"        => __( "LARGE", 'zn_framework' ),
//         "md"        => __( "MEDIUM", 'zn_framework' ),
//         "sm"        => __( "SMALL", 'zn_framework' ),
//         "xs"        => __( "EXTRA SMALL", 'zn_framework' ),
//     ),
//     "class"       => "zn_full zn_breakpoints"
// );

// $admin_options[]        = array (
//     'slug'        => 'default_header_options',
//     'parent'      => 'general_options',
//     "name"        => __( "Custom Sub-Header Height on LARGE DEVICES", 'zn_framework' ),
//     "description" => __( "Please enter your desired height in pixels for this header.", 'zn_framework' ),
//     "id"          => "def_header_custom_height",
//     "std"         => "300",
//     "type" => "slider",
//     'class'       => 'zn_full',
//     'helpers'     => array(
//         'min' => '150',
//         'max' => '1280',
//         'step' => '1'
//     ),
//     "dependency"  => array( 'element' => 'def_header_br_options' , 'value'=> array('lg') )
// );
// $admin_options[]        = array (
//     'slug'        => 'default_header_options',
//     'parent'      => 'general_options',
//     'id'          => 'def_header_top_padding',
//     'name'        => 'Top padding on LARGE DEVICES',
//     'description' => 'Select the top padding ( in pixels ) for this Subheader.',
//     'type'        => 'slider',
//     'std'         => '170',
//     'class'       => 'zn_full',
//     'helpers'     => array(
//         'min' => '50',
//         'max' => '350',
//         'step' => '1'
//     ),
//     "dependency"  => array( 'element' => 'def_header_br_options' , 'value'=> array('lg') )
// );
// $admin_options[]        = array (
//     'slug'        => 'default_header_options',
//     'parent'      => 'general_options',
//     'id'          => 'def_header_bottom_padding',
//     'name'        => 'Bottom padding on LARGE DEVICES',
//     'description' => 'Select the bottom padding ( in pixels ) for this Subheader.',
//     'type'        => 'slider',
//     'std'         => '0',
//     'class'       => 'zn_full',
//     'helpers'     => array(
//         'min' => '0',
//         'max' => '350',
//         'step' => '1'
//     ),
//     "dependency"  => array( 'element' => 'def_header_br_options' , 'value'=> array('lg') )
// );


// $admin_options[]        = array (
//     'slug'        => 'default_header_options',
//     'parent'      => 'general_options',
//     "name"        => __( "Custom Sub-Header Height on MEDIUM DEVICES", 'zn_framework' ),
//     "description" => __( "Please enter your desired height in pixels for this header.", 'zn_framework' ),
//     "id"          => "def_header_header_height_md",
//     "std"         => "300",
//     "type" => "slider",
//     'class'       => 'zn_full',
//     'helpers'     => array(
//         'min' => '150',
//         'max' => '1280',
//         'step' => '1'
//     ),
//     "dependency"  => array( 'element' => 'def_header_br_options' , 'value'=> array('md') )
// );
// $admin_options[]        = array (
//     'slug'        => 'default_header_options',
//     'parent'      => 'general_options',
//     'id'          => 'def_header_top_padding_md',
//     'name'        => 'Top padding on MEDIUM DEVICES',
//     'description' => 'Select the top padding ( in pixels ) for this Subheader.',
//     'type'        => 'slider',
//     'std'         => '170',
//     'class'       => 'zn_full',
//     'helpers'     => array(
//         'min' => '50',
//         'max' => '350',
//         'step' => '1'
//     ),
//     "dependency"  => array( 'element' => 'def_header_br_options' , 'value'=> array('md') )
// );
// $admin_options[]        = array (
//     'slug'        => 'default_header_options',
//     'parent'      => 'general_options',
//     'id'          => 'def_header_bottom_padding_md',
//     'name'        => 'Bottom padding on MEDIUM DEVICES',
//     'description' => 'Select the bottom padding ( in pixels ) for this Subheader.',
//     'type'        => 'slider',
//     'std'         => '0',
//     'class'       => 'zn_full',
//     'helpers'     => array(
//         'min' => '0',
//         'max' => '350',
//         'step' => '1'
//     ),
//     "dependency"  => array( 'element' => 'def_header_br_options' , 'value'=> array('md') )
// );


// $admin_options[]        = array (
//     'slug'        => 'default_header_options',
//     'parent'      => 'general_options',
//     "name"        => __( "Custom Sub-Header Height on SMALL DEVICES", 'zn_framework' ),
//     "description" => __( "Please enter your desired height in pixels for this header.", 'zn_framework' ),
//     "id"          => "def_header_header_height_sm",
//     "std"         => "300",
//     "type" => "slider",
//     'class'       => 'zn_full',
//     'helpers'     => array(
//         'min' => '150',
//         'max' => '1280',
//         'step' => '1'
//     ),
//     "dependency"  => array( 'element' => 'def_header_br_options' , 'value'=> array('sm') )
// );
// $admin_options[]        = array (
//     'slug'        => 'default_header_options',
//     'parent'      => 'general_options',
//     'id'          => 'def_header_top_padding_sm',
//     'name'        => 'Top padding on SMALL DEVICES',
//     'description' => 'Select the top padding ( in pixels ) for this Subheader.',
//     'type'        => 'slider',
//     'std'         => '170',
//     'class'       => 'zn_full',
//     'helpers'     => array(
//         'min' => '50',
//         'max' => '350',
//         'step' => '1'
//     ),
//     "dependency"  => array( 'element' => 'def_header_br_options' , 'value'=> array('sm') )
// );
// $admin_options[]        = array (
//     'slug'        => 'default_header_options',
//     'parent'      => 'general_options',
//     'id'          => 'def_header_bottom_padding_sm',
//     'name'        => 'Bottom padding on SMALL DEVICES',
//     'description' => 'Select the bottom padding ( in pixels ) for this Subheader.',
//     'type'        => 'slider',
//     'std'         => '0',
//     'class'       => 'zn_full',
//     'helpers'     => array(
//         'min' => '0',
//         'max' => '350',
//         'step' => '1'
//     ),
//     "dependency"  => array( 'element' => 'def_header_br_options' , 'value'=> array('sm') )
// );


// $admin_options[]        = array (
//     'slug'        => 'default_header_options',
//     'parent'      => 'general_options',
//     "name"        => __( "Custom Sub-Header Height on EXTRA SMALL DEVICES", 'zn_framework' ),
//     "description" => __( "Please enter your desired height in pixels for this header.", 'zn_framework' ),
//     "id"          => "def_header_header_height_xs",
//     "std"         => "300",
//     "type" => "slider",
//     'class'       => 'zn_full',
//     'helpers'     => array(
//         'min' => '150',
//         'max' => '1280',
//         'step' => '1'
//     ),
//     "dependency"  => array( 'element' => 'def_header_br_options' , 'value'=> array('xs') )
// );
// $admin_options[]        = array (
//     'slug'        => 'default_header_options',
//     'parent'      => 'general_options',
//     'id'          => 'def_header_top_padding_xs',
//     'name'        => 'Top padding on EXTRA SMALL DEVICES',
//     'description' => 'Select the top padding ( in pixels ) for this Subheader.',
//     'type'        => 'slider',
//     'std'         => '170',
//     'class'       => 'zn_full',
//     'helpers'     => array(
//         'min' => '50',
//         'max' => '350',
//         'step' => '1'
//     ),
//     "dependency"  => array( 'element' => 'def_header_br_options' , 'value'=> array('xs') )
// );
// $admin_options[]        = array (
//     'slug'        => 'default_header_options',
//     'parent'      => 'general_options',
//     'id'          => 'def_header_bottom_padding_xs',
//     'name'        => 'Bottom padding on EXTRA SMALL DEVICES',
//     'description' => 'Select the bottom padding ( in pixels ) for this Subheader.',
//     'type'        => 'slider',
//     'std'         => '0',
//     'class'       => 'zn_full',
//     'helpers'     => array(
//         'min' => '0',
//         'max' => '350',
//         'step' => '1'
//     ),
//     "dependency"  => array( 'element' => 'def_header_br_options' , 'value'=> array('xs') )
// );

$admin_options[] = array (
    'slug'        => 'default_header_options',
    'parent'      => 'general_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "dfho_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator"
);

$admin_options[] = array (
    'slug'        => 'default_header_options',
    'parent'      => 'general_options',
    "name"        => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> Video Tutorial: <a href="http://support.hogash.com/kallyas-videos/#1olr-Oy_RD0" target="_blank">Click here to access video tutorial for this options section.</a>', 'zn_framework' ),
    "id"          => "dfho_video",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn_nomargin"
);

// $admin_options[] = array (
//     'slug'        => 'default_header_options',
//     'parent'      => 'general_options',
//     "name"        => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> Written Documentation: <a href="" target="_blank">Click here to access documentation for this options section.</a>', 'zn_framework' ),
//     "id"          => "dfho_link",
//     "std"         => "",
//     "type"        => "zn_title",
//     "class"       => "zn_full zn-admin-helplink zn_nomargin"
// );

$admin_options[] = array (
    'slug'        => 'default_header_options',
    'parent'      => 'general_options',
    "name"        => __( '<a href="http://support.hogash.com/support/forum/wordpress-themes/kallyas-wordpress-theme/" target="_blank">Support Forums</a> &nbsp; | &nbsp; <a href="http://support.hogash.com/kallyas-help/" target="_blank">Kallyas Video Tutorials & Documentation</a> &nbsp; | &nbsp; <a href="http://themeforest.net/downloads?sort_by=Recent+Updates&filter_by=themeforest.net#item-4091658" target="_blank" class="stars-yellow">Rate Kallyas <span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></a>', 'zn_framework' ),
    "id"          => "dfho_otherlinks",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn-custom-title-sm zn_nomargin"
);
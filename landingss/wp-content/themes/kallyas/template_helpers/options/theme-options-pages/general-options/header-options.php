<?php
/**
 * Theme options > General Options  > Header options
 */

$admin_options[] = array (
    'slug'        => 'header_options',
    'parent'      => 'general_options',
    "name"        => __( 'HEADER OPTIONS', 'zn_framework' ),
    "description" => __( 'These options below are related to site\'s header ( <a href="http://hogash.d.pr/1cv3m" target="_blank" title="Click to open screenshot">Open screenshot</a>).', 'zn_framework' ),
    "id"          => "info_title2",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-large zn-toptabs-margin"
);

$admin_options[] = array (
    'slug'        => 'header_options',
    'parent'      => 'general_options',
    "name"        => __( "Header Layout", 'zn_framework' ),
    "description" => __( "Please choose the desired header layout.", 'zn_framework' ),
    "id"          => "zn_header_layout",
    "std"         => "style2",
    "options"     => array (
        'style1' => __( 'Style 1', 'zn_framework' ),
        'style2' => __( 'Style 2 (default)', 'zn_framework' ),
        'style3' => __( 'Style 3', 'zn_framework' ),
        'style4' => __( 'Style 4', 'zn_framework' ),
        'style5' => __( 'Style 5', 'zn_framework' ),
        'style6' => __( 'Style 6', 'zn_framework' ),
        'style7' => __( 'Style 7 (since v4.0)', 'zn_framework' ),
        'style8' => __( 'Style 8 (since v4.0)', 'zn_framework' ),
        'style9' => __( 'Style 9 (since v4.0)', 'zn_framework' )
    ),
    "type"        => "select"
);

// Header height
$admin_options[] = array (
    'slug'        => 'header_options',
    'parent'      => 'general_options',
    "name"        => __( "Header Height (in px)", 'zn_framework' ),
    "description" => __( "Header's height. By default it's 100px. <strong>Leave empty if you're not sure!</strong>", 'zn_framework' ),
    "id"          => "zn_head_height",
    "std"         => "",
    "type"        => "text",
    "placeholder" => "ex: 100px",
    'dependency'  => array ( 'element' => 'zn_header_layout', 'value' => array ( 'style1', 'style2', 'style3', 'style4', 'style5', 'style6' ) )
);

$admin_options[] = array(
    'slug'        => 'header_options',
    'parent'      => 'general_options',
    'id'          => 'header_res_width',
    'name'        => __( 'Header responsive width', 'zn_framework'),
    'description' => __( 'Choose the desired width when the responsive menu should appear.', 'zn_framework' ),
    'type'        => 'slider',
    'class'		  => 'zn_full',
    'std'        => '992',
    'helpers'	  => array(
        'min' => '50',
        'max' => '1200'
    )
);

// Header custom text
$admin_options[] = array (
    'slug'        => 'header_options',
    'parent'      => 'general_options',
    "name"        => __( "Top header text", 'zn_framework' ),
    "description" => __( "Will display any text (ex: phone number).", 'zn_framework' ),
    "id"          => "zn_head_s7_toptext",
    "std"         => "",
    "type"        => "text",
    "dependency"  => array( 'element' => 'zn_header_layout' , 'value'=> array('style7', 'style9') )
);

// HEADER STYLE
$admin_options[] = array (
    'slug'        => 'header_options',
    'parent'      => 'general_options',
    "name"        => __( "Header Style", 'zn_framework' ),
    "description" => __( "Select the desired style for the header", 'zn_framework' ),
    "id"          => "header_style",
    "std"         => "default",
    "type"        => "zn_radio",
    "options"     => array (
        'default'     => __( "Default", 'zn_framework' ),
        'image_color' => __( 'Background Image & color', 'zn_framework' ),
    ),
    'dependency'  => array ( 'element' => 'zn_header_layout', 'value' => array ( 'style1', 'style2', 'style3', 'style4', 'style5', 'style6', 'style9' ) )
);



// HEADER IMAGE
$admin_options[] = array (
    'slug'        => 'header_options',
    'parent'      => 'general_options',
    "name"        => __( "Header Background Image", 'zn_framework' ),
    "description" => __( "Please choose your desired image to be used as a background", 'zn_framework' ),
    "id"          => "header_style_image",
    "std"         => '',
    "options"     => array ( "repeat" => true, "position" => true, "attachment" => true ),
    "type"        => "background",
    'dependency'  => array ( 'element' => 'header_style', 'value' => array ( 'image_color' ) ),
);

// HEADER Color
$admin_options[] = array (
    'slug'        => 'header_options',
    'parent'      => 'general_options',
    "name"        => __( "Background Color", 'zn_framework' ),
    "description" => __( "Please choose your desired background color for the header", 'zn_framework' ),
    "id"          => "header_style_color",
    "std"         => '#000',
    "type"        => "colorpicker",
    "class"       => "header_style-image_color",
    'dependency'  => array ( 'element' => 'header_style', 'value' => array ( 'image_color' ) ),
);

// HEADER TEXT COLOR
$admin_options[] = array (
    'slug'        => 'header_options',
    'parent'      => 'general_options',
    "name"        => __( "Header Text Color", 'zn_framework' ),
    "description" => __( "Please choose a text color scheme. This helps in case you add a dark background and you want light colors, or in case of light background - dark colors for the texts.", 'zn_framework' ),
    "id"          => "header_text_scheme",
    "std"         => '',
    "options"     => array (
        "default" => "Header style default",
        "light" => "Light color",
        "gray" => "Grayish colors",
        "dark" => "Darken colors"
    ),
    "type"        => "select",
    'dependency'  => array ( 'element' => 'header_style', 'value' => array ( 'image_color' ) )
);

$admin_options[] = array (
    'slug'        => 'header_options',
    'parent'      => 'general_options',
    "name"        => __( "Header over Subheader / Slideshow?", 'zn_framework' ),
    "description" => __( "This will basically toggle the header's css position, from 'absolute' to 'relative'. If this option is disabled, the subheader or slideshow will go after the header. Don't foget to style the background of the header.", 'zn_framework' ),
    "id"          => "head_position",
    "std"         => "1",
    "type"        => "zn_radio",
    "options"     => array (
        "1" => __( "Yes", 'zn_framework' ),
        "0" => __( "No", 'zn_framework' )
    ),
    'dependency'  => array ( 'element' => 'zn_header_layout', 'value' => array ( 'style1', 'style2', 'style3', 'style4', 'style5', 'style6', 'style8', 'style9' ) )
);

$admin_options[] = array (
    'slug'        => 'header_options',
    'parent'      => 'general_options',
    "name"        => __( "Show WPML languages ?", 'zn_framework' ),
    "description" => __( "Choose yes if you want to show WPML languages in header. Please note that you will
        need WPML installed.", 'zn_framework' ),
    "id"          => "head_show_flags",
    "std"         => "1",
    "type"        => "zn_radio",
    "options"     => array (
        "1" => __( "Show", 'zn_framework' ),
        "0" => __( "Hide", 'zn_framework' )
    )
);

// Show LINK to LOGIN
$admin_options[] = array (
    'slug'        => 'header_options',
    'parent'      => 'general_options',
    "name"        => __( "Show Login in header", 'zn_framework' ),
    "description" => __( "Choose yes if you want to show a link that will let users login/register or retrieve their lost password. Please note that in order to show the registration page, you need to allow user registration from General settings.", 'zn_framework' ),
    "id"          => "head_show_login",
    "std"         => "1",
    "type"        => "zn_radio",
    "options"     => array (
        "1" => __( "Show", 'zn_framework' ),
        "0" => __( "Hide", 'zn_framework' )
    )
);


// Show SEARCH In header
$admin_options[] = array (
    'slug'        => 'header_options',
    'parent'      => 'general_options',
    "name"        => __( "Show SEARCH in header", 'zn_framework' ),
    "description" => __( "Please choose if you want to display the search button or not.", 'zn_framework' ),
    "id"          => "head_show_search",
    "std"         => "yes",
    "type"        => "zn_radio",
    "options"     => array (
        "yes" => __( "Show", 'zn_framework' ),
        "no"  => __( "Hide", 'zn_framework' )
    )
);

$admin_options[] = array (
    'slug'        => 'header_options',
    'parent'      => 'general_options',
    "id"          => "hdo_title_sep1",
    "type"        => "zn_title",
    "class"       => "zn_full zn-gray-separator"
);


// Show/Hide Social Icons in header
$admin_options[] = array (
    'slug'        => 'header_options',
    'parent'      => 'general_options',
    "name"        => __( "Show or hide the Social icons in the header.", 'zn_framework' ),
    "description" => __( "Please select the visibility status of the Social Icons(this setting will not affect
        the visibility of Social Icons from the info Card)", 'zn_framework' ),
    "id"          => "social_icons_visibility_status",
    "std"         => "yes",
    "type"        => "zn_radio",
    "options"     => array (
        "yes" => __( "Show", 'zn_framework' ),
        "no"  => __( "Hide", 'zn_framework' )
    )
);

$admin_options[]         = array (
    'slug'        => 'header_options',
    'parent'      => 'general_options',
    "name"        => __( "Use normal or colored social icons?", 'zn_framework' ),
    "description" => __( "Here you can choose to use the normal social icons or the colored version of each
        icon.", 'zn_framework' ),
    "id"          => "header_which_icons_set",
    "std"         => "",
    "type"        => "select",
    "options"     => array (
        'normal'  => __( 'Normal Icons', 'zn_framework' ),
        'colored' => __( 'Colored icons', 'zn_framework' ),
        'colored_hov' => __( 'Colored on Hover icons', 'zn_framework' ),
        'clean' => __( 'Clean icons', 'zn_framework' )
    ),
    "class"       => ""
);

$admin_options[]         = array (
    'slug'        => 'header_options',
    'parent'      => 'general_options',
    "name"        => __( "Social Icons", 'zn_framework' ),
    "description" => __( "Here you can configure what social icons to appear on the right side of the header.", 'zn_framework' ),
    "id"          => "header_social_icons",
    "std"         => "",
    "type"        => "group",
    "element_title"    => "header_social_title",
    "add_text"    => __( "Social Icon", 'zn_framework' ),
    "remove_text" => __( "Social Icon", 'zn_framework' ),
    "subelements" => array (
        array (
            "name"        => __( "Icon title", 'zn_framework' ),
            "description" => __( "Here you can enter a title for this social icon.Please note that this is just
				for your information as this text will not be visible on the site.", 'zn_framework' ),
            "id"          => "header_social_title",
            "std"         => "",
            "type"        => "text"
        ),
        array (
            "name"        => __( "Social icon link", 'zn_framework' ),
            "description" => __( "Please enter your desired link for the social icon. If this field is left
				blank, the icon will not be linked.", 'zn_framework' ),
            "id"          => "header_social_link",
            "std"         => "",
            "type"        => "link",
            "options"     => array (
                '_blank' => __( "New window", 'zn_framework' ),
                '_self'  => __( "Same window", 'zn_framework' )
            )
        ),
        array (
            "name"        => __( "Social icon Background color", 'zn_framework' ),
            "description" => __( "Select a background color for the icon (if you selected <strong>Colored</strong> or <strong>Colored on hover</strong> options)", 'zn_framework' ),
            "id"          => "header_social_color",
            "std"         => "#000",
            "type"        => "colorpicker"
        ),
        array (
            "name"        => __( "Social icon", 'zn_framework' ),
            "description" => __( "Select your desired social icon.", 'zn_framework' ),
            "id"          => "header_social_icon",
            "std"         => "",
            "type"        => "icon_list",
            'class'       => 'zn_full'
        )
    ),
    "class"       => ""
);

$admin_options[] = array (
    'slug'        => 'header_options',
    'parent'      => 'general_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "ho_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator"
);

$admin_options[] = array (
    'slug'        => 'header_options',
    'parent'      => 'general_options',
    "name"        => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> Video Tutorial: <a href="http://support.hogash.com/kallyas-videos/#TuXcJu9jl7c" target="_blank">Click here to access video tutorial for this options section.</a>', 'zn_framework' ),
    "id"          => "ho_video",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn_nomargin"
);

// $admin_options[] = array (
//     'slug'        => 'header_options',
//     'parent'      => 'general_options',
//     "name"        => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> Written Documentation: <a href="" target="_blank">Click here to access documentation for this options section.</a>', 'zn_framework' ),
//     "id"          => "ho_link",
//     "std"         => "",
//     "type"        => "zn_title",
//     "class"       => "zn_full zn-admin-helplink zn_nomargin"
// );

$admin_options[] = array (
    'slug'        => 'header_options',
    'parent'      => 'general_options',
    "name"        => __( '<a href="http://support.hogash.com/support/forum/wordpress-themes/kallyas-wordpress-theme/" target="_blank">Support Forums</a> &nbsp; | &nbsp; <a href="http://support.hogash.com/kallyas-help/" target="_blank">Kallyas Video Tutorials & Documentation</a> &nbsp; | &nbsp; <a href="http://themeforest.net/downloads?sort_by=Recent+Updates&filter_by=themeforest.net#item-4091658" target="_blank" class="stars-yellow">Rate Kallyas <span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></a>', 'zn_framework' ),
    "id"          => "ho_otherlinks",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn-custom-title-sm zn_nomargin"
);

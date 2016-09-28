<?php
/**
 * Theme options > General Options  > Favicon options
 */

$admin_options[] = array (
    'slug'        => 'unlimited_header_options',
    'parent'      => 'unlimited_header_options',
    "name"           => __( "Header Styles Generator", 'zn_framework' ),
    "description"    => __( "Here you can create unlimited header styles to be used on different pages.", 'zn_framework' ),
    "id"             => "header_generator",
    "std"            => "",
    "type"           => "group",
    "add_text"       => __( "Header Style", 'zn_framework' ),
    "remove_text"    => __( "Header Style", 'zn_framework' ),
    "element_title"       => "uh_style_name",
    "group_sortable" => false,
    "subelements"    => array (
        array (
            "name"        => __( "Header Style Name", 'zn_framework' ),
            "description" => __( "The name of this header style.Please note that all names must be unique.", 'zn_framework' ),
            "id"          => "uh_style_name",
            "std"         => '',
            "type"        => "text",
            'supports'    => 'block'
        ),
        /**
         * @since  v4.0.5
         */
        array (
            "name"        => __( "Background Type", 'zn_framework' ),
            "description" => __( "Please select the source type of the background.", 'zn_framework' ),
            "id"          => "uh_bg_type",
            "std"         => "simple_bg",
            "type"        => "select",
            "options"     => array (
                'simple_bg'  => __( "Simple Background Image", 'zn_framework' ),
                'advanced_bg' => __( "Advanced Settings Background Image", 'zn_framework' ),
            )
        ),

        array (
            "id"          => "uh_background_image",
            "name"        => __( "Background image", 'zn_framework' ),
            "description" => __( "Select a background image for your Sub-header. It will automatically be resized to fully stretch inside the subheader boundries.", 'zn_framework' ),
            "std"         => "",
            "type"        => "media",
            'dependency' => array( 'element' => 'uh_bg_type' , 'value'=> array('simple_bg') )
        ),
        /**
         * @since  v4.0.5
         */
        array(
            'id'          => 'uh_background_image_advanced',
            'name'        => 'Background image',
            'description' => 'Please choose a background image for this Subheader and select advanced options.',
            'type'        => 'background',
            'options' => array( "repeat" => true , "position" => true , "attachment" => true, "size" => true ),
            'class'       => 'zn_full',
            'dependency' => array( 'element' => 'uh_bg_type' , 'value'=> array('advanced_bg') )
        ),

        array (
            "name"        => __( "Header Background Color", 'zn_framework' ),
            "description" => __( "Here you can choose a default color for your header.If you do not select a
				background image, this color will be used as background.", 'zn_framework' ),
            "id"          => "uh_header_color",
            "std"         => '#AAAAAA',
            "type"        => "colorpicker"
        ),
        array (
            "name"        => __( "Add gradient over color?", 'zn_framework' ),
            "description" => __( "Select yes if you want add a gradient over the selected color", 'zn_framework' ),
            "id"          => "uh_grad_bg",
            "std"         => "1",
            "type"        => "select",
            "options"     => array (
                "1" => __( "Yes", 'zn_framework' ),
                "0" => __( "No", 'zn_framework' ),
            ),
            "class"       => ""
        ),
        array (
            "name"        => __( "Animate Background?", 'zn_framework' ),
            "description" => __( "Select yes if you want to make your background animated", 'zn_framework' ),
            "id"          => "uh_anim_bg",
            "std"         => "0",
            "type"        => "select",
            "options"     => array (
                "1" => __( "Yes", 'zn_framework' ),
                "0" => __( "No", 'zn_framework' ),
            ),
            "class"       => ""
        ),
        array (
            "name"        => __( "Add Glare effect?", 'zn_framework' ),
            "description" => __( "Select yes if you want to add a glare effect over the background", 'zn_framework' ),
            "id"          => "uh_glare",
            "std"         => "0",
            "type"        => "select",
            "options"     => array (
                "1" => __( "Yes", 'zn_framework' ),
                "0" => __( "No", 'zn_framework' ),
            ),
            "class"       => ""
        ),
        array (
            "name"        => __( "Bottom style?", 'zn_framework' ),
            "description" => __( "Select the header bottom style you want to use", 'zn_framework' ),
            "id"          => "uh_bottom_style",
            "std"         => "0",
            "type"        => "select",
            "options"     => array (
                "none"      => __( "None", 'zn_framework' ),
                "shadow"    => __( "Shadow Up", 'zn_framework' ),
                "shadow_ud" => __( "Shadow Up and down", 'zn_framework' ),
                "mask1"     => __( "Bottom mask 1", 'zn_framework' ),
                "mask2"     => __( "Bottom mask 2", 'zn_framework' ),
            ),
            "class"       => ""
        ),

        array (
            "name"        => __( "Edit height and padding for each device breakpoint", 'zn_framework' ),
            "description" => __( "Edit the height and padding options for each breakpoint (device). This will enable you to have more control over the subheader on each device. For example you might want the subheader to be shorter on mobiles, but taller on desktops.", 'zn_framework' ),
            "id"          => "uh_br_options",
            "std"         => "lg",
            "type"        => "zn_radio",
            "options"     => array (
                "lg"        => __( "LARGE", 'zn_framework' ),
                "md"        => __( "MEDIUM", 'zn_framework' ),
                "sm"        => __( "SMALL", 'zn_framework' ),
                "xs"        => __( "EXTRA SMALL", 'zn_framework' ),
            ),
            "class"       => "zn_full zn_breakpoints"
        ),

        array (
            "id"          => "uh_header_height",
            "name"        => __( "Height on LARGE DEVICES ( Desktops )", 'zn_framework' ),
            "description" => __( "Please enter your desired height in pixels for this header.", 'zn_framework' ),
            "std"         => "300",
            "type" => "slider",
            'class'       => 'zn_full',
            'helpers'     => array(
                'min' => '150',
                'max' => '1280',
                'step' => '1'
            ),
            "dependency"  => array( 'element' => 'uh_br_options' , 'value'=> array('lg') )
        ),
        array(
            'id'          => 'uh_top_padding',
            'name'        => 'Top Padding on LARGE DEVICES ( Desktops )',
            'description' => 'Select the top padding ( in pixels ) for this Subheader.',
            'type'        => 'slider',
            'std'         => '170',
            'class'       => 'zn_full',
            'helpers'     => array(
                'min' => '50',
                'max' => '350',
                'step' => '1'
            ),
            "dependency"  => array( 'element' => 'uh_br_options' , 'value'=> array('lg') )
        ),
        array(
            'id'          => 'uh_bottom_padding',
            'name'        => 'Bottom Padding on LARGE DEVICES ( Desktops )',
            'description' => 'Select the bottom padding ( in pixels ) for this Subheader.',
            'type'        => 'slider',
            'std'         => '0',
            'class'       => 'zn_full',
            'helpers'     => array(
                'min' => '0',
                'max' => '350',
                'step' => '1'
            ),
            "dependency"  => array( 'element' => 'uh_br_options' , 'value'=> array('lg') )
        ),


        array (
            "id"          => "uh_header_height_md",
            "name"        => __( "Height on MEDIUM DEVICES (Tablets, wide mode)", 'zn_framework' ),
            "description" => __( "Please enter your desired height in pixels for this header.", 'zn_framework' ),
            "std"         => "300",
            "type" => "slider",
            'class'       => 'zn_full',
            'helpers'     => array(
                'min' => '150',
                'max' => '1280',
                'step' => '1'
            ),
            "dependency"  => array( 'element' => 'uh_br_options' , 'value'=> array('md') )
        ),
        array(
            'id'          => 'uh_top_padding_md',
            'name'        => 'Top Padding on MEDIUM DEVICES (Tablets, wide mode)',
            'description' => 'Select the top padding ( in pixels ) for this Subheader.',
            'type'        => 'slider',
            'std'         => '170',
            'class'       => 'zn_full',
            'helpers'     => array(
                'min' => '50',
                'max' => '350',
                'step' => '1'
            ),
            "dependency"  => array( 'element' => 'uh_br_options' , 'value'=> array('md') )
        ),
        array(
            'id'          => 'uh_bottom_padding_md',
            'name'        => 'Bottom Padding on MEDIUM DEVICES (Tablets, wide mode)',
            'description' => 'Select the bottom padding ( in pixels ) for this Subheader.',
            'type'        => 'slider',
            'std'         => '0',
            'class'       => 'zn_full',
            'helpers'     => array(
                'min' => '0',
                'max' => '350',
                'step' => '1'
            ),
            "dependency"  => array( 'element' => 'uh_br_options' , 'value'=> array('md') )
        ),


        array (
            "id"          => "uh_header_height_sm",
            "name"        => __( "Height on SMALL DEVICES (Tablets, portrait mode)", 'zn_framework' ),
            "description" => __( "Please enter your desired height in pixels for this header.", 'zn_framework' ),
            "std"         => "300",
            "type" => "slider",
            'class'       => 'zn_full',
            'helpers'     => array(
                'min' => '150',
                'max' => '1280',
                'step' => '1'
            ),
            "dependency"  => array( 'element' => 'uh_br_options' , 'value'=> array('sm') )
        ),
        array(
            'id'          => 'uh_top_padding_sm',
            'name'        => 'Top Padding on SMALL DEVICES (Tablets, portrait mode)',
            'description' => 'Select the top padding ( in pixels ) for this Subheader.',
            'type'        => 'slider',
            'std'         => '170',
            'class'       => 'zn_full',
            'helpers'     => array(
                'min' => '50',
                'max' => '350',
                'step' => '1'
            ),
            "dependency"  => array( 'element' => 'uh_br_options' , 'value'=> array('sm') )
        ),
        array(
            'id'          => 'uh_bottom_padding_sm',
            'name'        => 'Bottom Padding on SMALL DEVICES (Tablets, portrait mode)',
            'description' => 'Select the bottom padding ( in pixels ) for this Subheader.',
            'type'        => 'slider',
            'std'         => '0',
            'class'       => 'zn_full',
            'helpers'     => array(
                'min' => '0',
                'max' => '350',
                'step' => '1'
            ),
            "dependency"  => array( 'element' => 'uh_br_options' , 'value'=> array('sm') )
        ),


        array (
            "id"          => "uh_header_height_xs",
            "name"        => __( "Height on EXTRA SMALL DEVICES ( SmartPhones )", 'zn_framework' ),
            "description" => __( "Please enter your desired height in pixels for this header.", 'zn_framework' ),
            "std"         => "300",
            "type" => "slider",
            'class'       => 'zn_full',
            'helpers'     => array(
                'min' => '150',
                'max' => '1280',
                'step' => '1'
            ),
            "dependency"  => array( 'element' => 'uh_br_options' , 'value'=> array('xs') )
        ),
        array(
            'id'          => 'uh_top_padding_xs',
            'name'        => 'Top Padding on EXTRA SMALL DEVICES ( SmartPhones )',
            'description' => 'Select the top padding ( in pixels ) for this Subheader.',
            'type'        => 'slider',
            'std'         => '170',
            'class'       => 'zn_full',
            'helpers'     => array(
                'min' => '50',
                'max' => '350',
                'step' => '1'
            ),
            "dependency"  => array( 'element' => 'uh_br_options' , 'value'=> array('xs') )
        ),
        array(
            'id'          => 'uh_bottom_padding_xs',
            'name'        => 'Bottom Padding on EXTRA SMALL DEVICES ( SmartPhones )',
            'description' => 'Select the bottom padding ( in pixels ) for this Subheader.',
            'type'        => 'slider',
            'std'         => '0',
            'class'       => 'zn_full',
            'helpers'     => array(
                'min' => '0',
                'max' => '350',
                'step' => '1'
            ),
            "dependency"  => array( 'element' => 'uh_br_options' , 'value'=> array('xs') )
        ),


    ),
    "class"          => ""
);


$admin_options[] = array (
    'slug'        => 'unlimited_header_options',
    'parent'      => 'unlimited_header_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "uho_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator"
);

$admin_options[] = array (
    'slug'        => 'unlimited_header_options',
    'parent'      => 'unlimited_header_options',
    "name"        => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> Video Tutorial: <a href="http://support.hogash.com/kallyas-videos/#6T0VYHCS9mA" target="_blank">Click here to access video tutorial for this options section.</a>', 'zn_framework' ),
    "id"          => "uho_video",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn_nomargin"
);

// $admin_options[] = array (
//     'slug'        => 'unlimited_header_options',
//     'parent'      => 'unlimited_header_options',
//     "name"        => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> Written Documentation: <a href="" target="_blank">Click here to access documentation for this options section.</a>', 'zn_framework' ),
//     "id"          => "uho_link",
//     "std"         => "",
//     "type"        => "zn_title",
//     "class"       => "zn_full zn-admin-helplink zn_nomargin"
// );

$admin_options[] = array (
    'slug'        => 'unlimited_header_options',
    'parent'      => 'unlimited_header_options',
    "name"        => __( '<a href="http://support.hogash.com/support/forum/wordpress-themes/kallyas-wordpress-theme/" target="_blank">Support Forums</a> &nbsp; | &nbsp; <a href="http://support.hogash.com/kallyas-help/" target="_blank">Kallyas Video Tutorials & Documentation</a> &nbsp; | &nbsp; <a href="http://themeforest.net/downloads?sort_by=Recent+Updates&filter_by=themeforest.net#item-4091658" target="_blank" class="stars-yellow">Rate Kallyas <span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></a>', 'zn_framework' ),
    "id"          => "uho_otherlinks",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn-custom-title-sm zn_nomargin"
);
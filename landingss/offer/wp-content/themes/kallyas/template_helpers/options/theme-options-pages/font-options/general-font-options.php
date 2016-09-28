<?php
/**
 * Theme options > Font Options  > General Font Options
 */

// Google fonts
$url = esc_url( __('//www.google.com/fonts', 'zn_framework'));
$admin_options[] = array(
    'slug'        => 'gfont_setup',
    'parent'      => 'google_font_options',
    'id'          => 'zn_google_fonts_setup',
    'name'        => 'Google Fonts Setup',
    'description' => 'Here you can setup the <a href="'.$url.'" target="blank">Google web fonts</a> that you want to use in your site.',
    'type'        => 'zn_google_fonts_setup',
    'std'         => array (
                    'Roboto' => array (
                        'font_family' => 'Roboto',
                        'font_variants' => array (
                            0 => 'regular',
                            1 => '300',
                            2 => '700',
                            3 => '900',
                        ),
                    ),
                ),
    'class'       => 'zn_full'
);

// General fonts subset
$admin_options[] = array(
    'slug'        => 'gfont_setup',
    'parent'      => 'google_font_options',
    'id'          => 'zn_google_fonts_subsets',
    'name'        => 'Google Fonts Subset',
    'description' => 'Select which subsets you want to load for the Google fonts.',
    'type'        => 'checkbox',
    'options'     => array(
            'latin' => 'Latin',
            'latin-ext' => 'Latin Ext',
            'greek' => 'Greek',
            'cyrillic' => 'Cyrillic',
            'cyrillic-ext' => 'Cyrillic Ext',
            'khmer' => 'Khmer',
            'greek-ext' => 'Greek Ext',
            'vietnamese' => 'Vietnamese'
        ),
    'std'         => '',
    'class'       => 'zn_full'
);


// Custom fonts subset
$admin_options[] = array(
    'slug'        => 'custom_font_setup',
    'parent'      => 'google_font_options',
    'id'          => 'zn_custom_fonts',
    'name'        => 'Custom Fonts Setup',
    'description' => 'Using this option you can add your own custom fonts to the theme.',
    'type'        => 'group',
    "element_title" => "cf_name",
    'subelements' => array (
        array (
            "name"        => __( "Font Name", 'zn_framework' ),
            "description" => __( "Here you can type the font name that will be used.", 'zn_framework' ),
            "id"          => "cf_name",
            "std"         => '',
            "type"        => "text",
        ),
        array (
            "name"        => __( "Custom font .woff", 'zn_framework' ),
            "description" => __( "Upload the .woff font file.", 'zn_framework' ),
            "id"          => "cf_woff",
            "std"         => '',
            "type"        => "zn_media",
            'data'        => array(
                'button_title' => 'Add .woff font',
                'media_type' => 'media_field_upload', // The text that will appear on the inser button from the media manager
                'insert_title' => 'Select font', // The text that will appear on the inser button from the media manager
                'title' => 'Add Custom Font', // The text that will appear as the main option button for adding images
                'type' => 'application/font-woff', // The media type : image, video, etc
                'state' => 'library', // The media manager state
                'frame' => 'select', // The media manager frame - can be select, post, manage, image, audio, video, edit-attachments
                'class' => 'zn-media-video media-frame', // A css class that will be applied to the modal
                'value_type' => 'url', // The media manager state
                'preview' => 'text'
            ),

        ),
        array (
            "name"        => __( "Custom font .ttf", 'zn_framework' ),
            "description" => __( "Upload the .ttf font file.", 'zn_framework' ),
            "id"          => "cf_ttf",
            "std"         => '',
            "type"        => "zn_media",
            'data'        => array(
                'button_title' => 'Add .ttf font',
                'media_type' => 'media_field_upload', // The text that will appear on the inser button from the media manager
                'insert_title' => 'Select font', // The text that will appear on the inser button from the media manager
                'title' => 'Add Custom Font', // The text that will appear as the main option button for adding images
                'type' => 'font/ttf', // The media type : image, video, etc
                'state' => 'library', // The media manager state
                'frame' => 'select', // The media manager frame - can be select, post, manage, image, audio, video, edit-attachments
                'class' => 'zn-media-video media-frame', // A css class that will be applied to the modal
                'value_type' => 'url', // The media manager state
                'preview' => 'text'
            )
        ),
        array (
            "name"        => __( "Custom font .svg", 'zn_framework' ),
            "description" => __( "Upload the .svg font file.", 'zn_framework' ),
            "id"          => "cf_svg",
            "std"         => '',
            "type"        => "zn_media",
            'data'        => array(
                'button_title' => 'Add .svg font',
                'media_type' => 'media_field_upload', // The text that will appear on the inser button from the media manager
                'insert_title' => 'Select font', // The text that will appear on the inser button from the media manager
                'title' => 'Add Custom Font', // The text that will appear as the main option button for adding images
                'type' => 'image/svg+xml', // The media type : image, video, etc
                'state' => 'library', // The media manager state
                'frame' => 'select', // The media manager frame - can be select, post, manage, image, audio, video, edit-attachments
                'class' => 'zn-media-video media-frame', // A css class that will be applied to the modal
                'value_type' => 'url', // The media manager state
                'preview' => 'text'
            )
        ),
        array (
            "name"        => __( "Custom font .eot", 'zn_framework' ),
            "description" => __( "Upload the .eot font file.", 'zn_framework' ),
            "id"          => "cf_eot",
            "std"         => '',
            "type"        => "zn_media",
            'data'        => array(
                'button_title' => 'Add .eot font',
                'media_type' => 'media_field_upload', // The text that will appear on the inser button from the media manager
                'insert_title' => 'Select font', // The text that will appear on the inser button from the media manager
                'title' => 'Add Custom Font', // The text that will appear as the main option button for adding images
                'type' => 'application/vnd.ms-fontobject', // The media type : image, video, etc
                'state' => 'library', // The media manager state
                'frame' => 'select', // The media manager frame - can be select, post, manage, image, audio, video, edit-attachments
                'class' => 'zn-media-video media-frame', // A css class that will be applied to the modal
                'value_type' => 'url', // The media manager state
                'preview' => 'text'
            )
        ),
    ),
);

$admin_options[] = array (
    'slug'        => 'custom_font_setup',
    'parent'      => 'google_font_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "gfto_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator"
);

$admin_options[] = array (
    'slug'        => 'custom_font_setup',
    'parent'      => 'google_font_options',
    "name"        => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> Video Tutorial: <a href="http://support.hogash.com/kallyas-videos/#ffnXlhSxpaI" target="_blank">Click here to access video tutorial for this options section.</a>', 'zn_framework' ),
    "id"          => "gfto_video",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn_nomargin"
);

// $admin_options[] = array (
//     'slug'        => 'custom_font_setup',
//     'parent'      => 'google_font_options',
//     "name"        => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> Written Documentation: <a href="" target="_blank">Click here to access documentation for this options section.</a>', 'zn_framework' ),
//     "id"          => "gfto_link",
//     "std"         => "",
//     "type"        => "zn_title",
//     "class"       => "zn_full zn-admin-helplink zn_nomargin"
// );

$admin_options[] = array (
    'slug'        => 'custom_font_setup',
    'parent'      => 'google_font_options',
    "name"        => __( '<a href="http://support.hogash.com/support/forum/wordpress-themes/kallyas-wordpress-theme/" target="_blank">Support Forums</a> &nbsp; | &nbsp; <a href="http://support.hogash.com/kallyas-help/" target="_blank">Kallyas Video Tutorials & Documentation</a> &nbsp; | &nbsp; <a href="http://themeforest.net/downloads?sort_by=Recent+Updates&filter_by=themeforest.net#item-4091658" target="_blank" class="stars-yellow">Rate Kallyas <span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></a>', 'zn_framework' ),
    "id"          => "gfto_otherlinks",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn-custom-title-sm zn_nomargin"
);
<?php
/**
 * Theme options > Blog Options  > Archive options
 */
global $sidebar_option;

if(!isset($sidebar_option) || empty($sidebar_option)){
    $sidebar_option = WpkZn::getThemeSidebars();
}

$admin_options[] = array (
    'slug'        => 'blog_archive_options',
    'parent'      => 'blog_options',
    "name"        => __( "Blog Columns", 'zn_framework' ),
    "description" => __( "Select the number of columns you want to use.", 'zn_framework' ),
    "id"          => "blog_style_layout",
    "std"         => "1",
    "type"        => "select",
    "options"     => array (
        '1' => __( "1", 'zn_framework' ),
        '2' => __( "2", 'zn_framework' ),
        '3' => __( "3", 'zn_framework' ),
        '4' => __( "4", 'zn_framework' ),
    ),
    "class"       => ""
);

$admin_options[] = array (
    'slug'        => 'blog_archive_options',
    'parent'      => 'blog_options',
    "name"        => __( "Content to show", 'zn_framework' ),
    "description" => __( "Choose what content you want to show <b>Important : This only works for 1 column</b>", 'zn_framework' ),
    "id"          => "sb_archive_content_type",
    "std"         => "full",
    "type"        => "select",
    "options"     => array (
        'excerpt' => __( 'Excerpt', 'zn_framework' ),
        'full'  => __( 'Full content', 'zn_framework' ),
    ),
    'dependency'   => array( "element" => 'blog_style_layout', 'value' => array( '1' ) ),
);

$admin_options[] = array (
    'slug'        => 'blog_archive_options',
    'parent'      => 'blog_options',
    "name"           => __( "Archive Page Title", 'zn_framework' ),
    "description"    => __( "Enter the desired page title for the blog archive page.", 'zn_framework' ),
    "id"             => "archive_page_title",
    "type"           => "text",
    "std"            => __( "BLOG & Gossip", 'zn_framework' ),
    "translate_name" => __( "Archive Page Title", 'zn_framework' ),
    "class"          => ""
);
$admin_options[] = array (
    'slug'        => 'blog_archive_options',
    'parent'      => 'blog_options',
    "name"           => __( "Archive page subtitle", 'zn_framework' ),
    "description"    => __( "Enter the desired page subtitle for the blog archive page.", 'zn_framework' ),
    "id"             => "archive_page_subtitle",
    "type"           => "text",
    "std"            => __( "This would be the blog category page", 'zn_framework' ),
    "translate_name" => __( "Archive Page Subtitle", 'zn_framework' ),
    "class"          => ""
);

$admin_options[] = array (
    'slug'        => 'blog_archive_options',
    'parent'      => 'blog_options',
    "name"        => __( "Use full width image", 'zn_framework' ),
    "description" => __( "Choose Use full width image option if you want the images to be full width rather then
		the default layout", 'zn_framework' ),
    "id"          => "sb_archive_use_full_image",
    "std"         => "no",
    "type"        => "select",
    "options"     => array (
        'yes' => __( 'Use full width image', 'zn_framework' ),
        'no'  => __( 'Use default layout', 'zn_framework' ),
    )
);

$admin_options[] = array (
    'slug'        => 'blog_archive_options',
    'parent'      => 'blog_options',
    "name"        => __( "Use first attached image ?", 'zn_framework' ),
    "description" => __( "Choose yes if you want the theme to display the first image inside a page if no featured image is present", 'zn_framework' ),
    "id"          => "zn_use_first_image",
    "std"         => 'yes',
    "options"     => array ( 'yes' => __( "Yes", 'zn_framework' ), 'no' => __( "No", 'zn_framework' ) ),
    "type"        => "select"
);

$admin_options[] = array (
    'slug'        => 'blog_archive_options',
    'parent'      => 'blog_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "bgao_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator"
);

$admin_options[] = array (
    'slug'        => 'blog_archive_options',
    'parent'      => 'blog_options',
    "name"        => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> Video Tutorial: <a href="http://support.hogash.com/kallyas-videos/#Kd0a0kDrg1s" target="_blank">Click here to access video tutorial for this options section.</a>', 'zn_framework' ),
    "id"          => "bgao_video",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn_nomargin"
);

$admin_options[] = array (
    'slug'        => 'blog_archive_options',
    'parent'      => 'blog_options',
    "name"        => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> Written Documentation: <a href="http://support.hogash.com/documentation/setting-up-blog/" target="_blank">Click here to access documentation for this options section.</a>', 'zn_framework' ),
    "id"          => "bgao_link",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn_nomargin"
);

$admin_options[] = array (
    'slug'        => 'blog_archive_options',
    'parent'      => 'blog_options',
    "name"        => __( '<a href="http://support.hogash.com/support/forum/wordpress-themes/kallyas-wordpress-theme/" target="_blank">Support Forums</a> &nbsp; | &nbsp; <a href="http://support.hogash.com/kallyas-help/" target="_blank">Kallyas Video Tutorials & Documentation</a> &nbsp; | &nbsp; <a href="http://themeforest.net/downloads?sort_by=Recent+Updates&filter_by=themeforest.net#item-4091658" target="_blank" class="stars-yellow">Rate Kallyas <span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></a>', 'zn_framework' ),
    "id"          => "bgao_otherlinks",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn-custom-title-sm zn_nomargin"
);
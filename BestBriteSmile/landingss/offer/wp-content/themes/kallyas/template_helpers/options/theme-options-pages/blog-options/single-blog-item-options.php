<?php
/**
 * Theme options > Blog Options  > Single blog item options
 */
global $sidebar_option;

if(!isset($sidebar_option) || empty($sidebar_option)){
    $sidebar_option = WpkZn::getThemeSidebars();
}

$admin_options[] = array (
    'slug'        => 'single_blog_options',
    'parent'      => 'blog_options',
    "name"        => __( "Use full width image", 'zn_framework' ),
    "description" => __( "Choose Use full width image option if you want the images to be full widht rather then the default layout", 'zn_framework' ),
    "id"          => "sb_use_full_image",
    "std"         => 'no',
    "type"        => "select",
    "options"     => array (
        'yes' => __( 'Use full width image', 'zn_framework' ),
        'no'  => __( 'Use default layout', 'zn_framework' ),
    )
);

// $admin_options[] = array (
//     'slug'        => 'single_blog_options',
//     'parent'      => 'blog_options',
//     "name"        => __( "Default Sidebar Position", 'zn_framework' ),
//     "description" => __( "Select the default position of the sidebars throughout the site.", 'zn_framework' ),
//     "id"          => "default_sidebar_position",
//     "std"         => "right_sidebar",
//     "type"        => "select",
//     "options"     => array (
//         'left_sidebar'  => __( "Left Sidebar", 'zn_framework' ),
//         'right_sidebar' => __( "Right sidebar", 'zn_framework' ),
//         "no_sidebar"    => __( "No sidebar", 'zn_framework' ),
//     ),
//     "class"       => ""
// );
// $admin_options[] = array (
//     'slug'        => 'single_blog_options',
//     'parent'      => 'blog_options',
//     "name"        => __( "Single Post Default Sidebar", 'zn_framework' ),
//     "description" => __( "Select the default sidebar that will be used on single post pages. Please note you can
// 		                    select a different sidebar from the post edit page.", 'zn_framework' ),
//     "id"          => "single_sidebar",
//     "std"         => "defaultsidebar",
//     "type"        => "select",
//     "options"     => $sidebar_option,
//     "class"       => ""
// );

$admin_options[] = array (
    'slug'        => 'single_blog_options',
    'parent'      => 'blog_options',
    "name"        => __( "Show author info ?", 'zn_framework' ),
    "description" => __( "Choose if you want to show the author info section on single post item.", 'zn_framework' ),
    "id" => "zn_show_author_info",
    "std" => 'yes',
    "type" => "toggle2",
    "value" => "yes"
);

$admin_options[] = array (
    'slug'        => 'single_blog_options',
    'parent'      => 'blog_options',
    "name"        => __( "Show related posts ?", 'zn_framework' ),
    "description" => __( "Choose if you want to show related posts section.", 'zn_framework' ),
    "id" => "zn_show_related_posts",
    "std" => 'yes',
    "type" => "toggle2",
    "value" => "yes"
);

$admin_options[] = array (
    'slug'        => 'single_blog_options',
    'parent'      => 'blog_options',
    "name"        => __( "Show Social Share Buttons?", 'zn_framework' ),
    "description" => __( "Choose if you want to show the social share buttons bellow the post's content.", 'zn_framework' ),
    "id"          => "show_social",
    "std"         => "show",
    "type"        => "select",
    "options"     => array (
        'show' => __( 'Show social buttons', 'zn_framework' ),
        'hide' => __( 'Do not show social buttons', 'zn_framework' ),
    )
);


$admin_options[] = array (
    'slug'        => 'single_blog_options',
    'parent'      => 'blog_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "sbio_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator"
);

$admin_options[] = array (
    'slug'        => 'single_blog_options',
    'parent'      => 'blog_options',
    "name"        => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> Video Tutorial: <a href="http://support.hogash.com/kallyas-videos/#Kd0a0kDrg1s" target="_blank">Click here to access video tutorial for this options section.</a>', 'zn_framework' ),
    "id"          => "sbio_video",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn_nomargin"
);

$admin_options[] = array (
    'slug'        => 'single_blog_options',
    'parent'      => 'blog_options',
    "name"        => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> Written Documentation: <a href="http://support.hogash.com/documentation/setting-up-blog/" target="_blank">Click here to access documentation for this options section.</a>', 'zn_framework' ),
    "id"          => "sbio_link",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn_nomargin"
);

$admin_options[] = array (
    'slug'        => 'single_blog_options',
    'parent'      => 'blog_options',
    "name"        => __( '<a href="http://support.hogash.com/support/forum/wordpress-themes/kallyas-wordpress-theme/" target="_blank">Support Forums</a> &nbsp; | &nbsp; <a href="http://support.hogash.com/kallyas-help/" target="_blank">Kallyas Video Tutorials & Documentation</a> &nbsp; | &nbsp; <a href="http://themeforest.net/downloads?sort_by=Recent+Updates&filter_by=themeforest.net#item-4091658" target="_blank" class="stars-yellow">Rate Kallyas <span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></a>', 'zn_framework' ),
    "id"          => "sbio_otherlinks",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn-custom-title-sm zn_nomargin"
);

<?php
/**
 * Theme options > General Options  > Favicon options
 */

/*--------------------------------------------------------------------------------------------------
	Sidebar Generator
	--------------------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------------------
    Unlimited Sidebars
--------------------------------------------------------------------------------------------------*/
// Unlimited Sidebars

$admin_options[] = array(
    'slug'          => 'unlimited_sidebars', // subpage
    'parent'        => 'unlimited_sidebars', // master page
    'id'            => 'unlimited_sidebars',
    'name'          => 'Unlimited Sidebars',
    'description'   => 'Here you can create unlimited sidebars that you can use all over the theme.',
    'type'          => 'group',
    'sortable'      => false,
    'element_title' => 'sidebar_name',
    'subelements'   => array(
                            array(
                                'id'          => 'sidebar_name',
                                'name'        => 'Sidebar Name',
                                'description' => 'Please enter a name for this sidebar. Please note that the name should only contain alphanumeric characters',
                                'type'        => 'text',
                                'supports'    => 'block'
                            ),
                    )
);


$admin_options[] = array (
    'slug'          => 'unlimited_sidebars', // subpage
    'parent'        => 'unlimited_sidebars', // master page
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "usbo_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator"
);

$admin_options[] = array (
    'slug'          => 'unlimited_sidebars', // subpage
    'parent'        => 'unlimited_sidebars', // master page
    "name"        => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> Video Tutorial: <a href="http://support.hogash.com/kallyas-videos/#M7TcpipwAKw" target="_blank">Click here to access video tutorial for this options section.</a>', 'zn_framework' ),
    "id"          => "usbo_video",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn_nomargin"
);

// $admin_options[] = array (
//     'slug'        => 'unlimited_sidebars',
//     'parent'      => 'unlimited_sidebars',
//     "name"        => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> Written Documentation: <a href="" target="_blank">Click here to access documentation for this options section.</a>', 'zn_framework' ),
//     "id"          => "usbo_link",
//     "std"         => "",
//     "type"        => "zn_title",
//     "class"       => "zn_full zn-admin-helplink zn_nomargin"
// );

$admin_options[] = array (
    'slug'          => 'unlimited_sidebars', // subpage
    'parent'        => 'unlimited_sidebars', // master page
    "name"        => __( '<a href="http://support.hogash.com/support/forum/wordpress-themes/kallyas-wordpress-theme/" target="_blank">Support Forums</a> &nbsp; | &nbsp; <a href="http://support.hogash.com/kallyas-help/" target="_blank">Kallyas Video Tutorials & Documentation</a> &nbsp; | &nbsp; <a href="http://themeforest.net/downloads?sort_by=Recent+Updates&filter_by=themeforest.net#item-4091658" target="_blank" class="stars-yellow">Rate Kallyas <span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></a>', 'zn_framework' ),
    "id"          => "usbo_otherlinks",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn-custom-title-sm zn_nomargin"
);

// Sidebars settings
$sidebar_options = array( 'right_sidebar' => 'Right sidebar' , 'left_sidebar' => 'Left sidebar' , 'no_sidebar' => 'No sidebar' );
$admin_options[] = array(
    'slug'        => 'sidebar_settings',
    'parent'      => 'unlimited_sidebars',
    'id'          => 'archive_sidebar',
    'name'        => 'Sidebar on archive pages',
    'description' => 'Please choose the sidebar position for the archive pages.',
    'type'        => 'sidebar',
    'class'     => 'zn_full',
    'std'       => array (
        'layout' => 'sidebar_right',
        'sidebar' => 'default_sidebar',
    ),
    'supports'  => array(
        'default_sidebar' => 'defaultsidebar',
        'sidebar_options' => $sidebar_options
    ),
);

$admin_options[] = array(
    'slug'        => 'sidebar_settings',
    'parent'      => 'unlimited_sidebars',
    'id'          => 'blog_sidebar',
    'name'        => 'Sidebar on Blog',
    'description' => 'Please choose the sidebar position for the blog page.',
    'type'        => 'sidebar',
    'class'     => 'zn_full',
    'std'       => array (
        'layout' => 'sidebar_right',
        'sidebar' => 'default_sidebar',
    ),
    'supports'  => array(
        'default_sidebar' => 'defaultsidebar',
        'sidebar_options' => $sidebar_options
    ),
);

$admin_options[] = array(
    'slug'        => 'sidebar_settings',
    'parent'      => 'unlimited_sidebars',
    'id'          => 'single_sidebar',
    'name'        => 'Sidebar on single blog post',
    'description' => 'Please choose the sidebar position for the single blog posts.',
    'type'        => 'sidebar',
    'class'     => 'zn_full',
    'std'       => array (
        'layout' => 'sidebar_right',
        'sidebar' => 'default_sidebar',
    ),
    'supports'  => array(
        'default_sidebar' => 'defaultsidebar',
        'sidebar_options' => $sidebar_options
    ),
);

$admin_options[] = array(
    'slug'        => 'sidebar_settings',
    'parent'      => 'unlimited_sidebars',
    'id'          => 'page_sidebar',
    'name'        => 'Sidebar on pages',
    'description' => 'Please choose the sidebar position for the pages.',
    'type'        => 'sidebar',
    'class'     => 'zn_full',
    'std'       => array (
        'layout' => 'sidebar_right',
        'sidebar' => 'default_sidebar',
    ),
    'supports'  => array(
        'default_sidebar' => 'defaultsidebar',
        'sidebar_options' => $sidebar_options
    ),
);

<?php
/**
 * Theme options > General Options  > Favicon options
 */

// $admin_options[] = array (
//     'slug'        => 'advanced_options',
//     'parent'      => 'advanced_options',
//     "name"        => __( "Themeforest Username", 'zn_framework' ),
//     "description" => __( "Please fill in your Themeforest username.", 'zn_framework' ),
//     "id"          => "zn_theme_username",
//     "std"         => "",
//     "type"        => "text",
// );

// $admin_options[] = array (
//     'slug'        => 'advanced_options',
//     'parent'      => 'advanced_options',
//     "name"        => __( "Themeforest API key", 'zn_framework' ),
//     "description" => __( "Please fill in your Themeforest API key.", 'zn_framework' ),
//     "id"          => "zn_theme_api",
//     "std"         => "",
//     "type"        => "text",
// );

$admin_options[] = array(
    'slug'        => 'advanced_options',
    'parent'      => 'advanced_options',
    'id'          => 'font_uploader',
    'name'        => 'Icon Font uploader',
    'description' => 'Please select a zip archive containing the font (generate it using http://fontello.com).',
    'type'        => 'upload',
    'supports'    => array
    (
        'file_extension' => 'zip',
        'file_type' => 'application/octet-stream, application/zip',
    )
);

$admin_options[] = array(
    'slug'        => 'advanced_options',
    'parent'      => 'advanced_options',
    'id'          => 'zn_refresh_pb',
    'name'        => 'Refresh page builder data',
    'description' => 'If you have made changes to the theme\'s page builder folder or files, you will need to press this button in order to refresh their css and folder structure.',
    'type'        => 'zn_ajax_call',
    'ajax_call_setup' => array(
        'action' => 'zn_refresh_pb',
        'button_text' => 'Refresh page builder data'
    )
);

$admin_options[] = array(
    'slug'        => 'advanced_options',
    'parent'      => 'advanced_options',
    'id'          => 'zn_importer',
    'name'        => 'Import dummy data',
    'description' => 'Press this button if you want to import the dummy data.<b>IMPORTANT : This process can take a long time as all images are downloaded from an external server.</b>',
    'type'        => 'zn_import'
);

$admin_options[] = array (
    'slug'        => 'advanced_options',
    'parent'      => 'advanced_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "advo_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator"
);

$admin_options[] = array (
    'slug'        => 'advanced_options',
    'parent'      => 'advanced_options',
    "name"        => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> Video Tutorials: <a href="http://support.hogash.com/kallyas-videos/#F5bYMHBcHO0" target="_blank">Icon fonts uploader</a>, <a href="http://support.hogash.com/kallyas-videos/#l_Bi-OWEvaI" target="_blank">Install Dummy Data</a>, <a href="http://support.hogash.com/kallyas-videos/#T_fV69CcbNY" target="_blank">Automatic Updates</a>; ', 'zn_framework' ),
    "id"          => "advo_video",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn_nomargin"
);

$admin_options[] = array (
    'slug'        => 'advanced_options',
    'parent'      => 'advanced_options',
    "name"        => __( '<a href="http://support.hogash.com/support/forum/wordpress-themes/kallyas-wordpress-theme/" target="_blank">Support Forums</a> &nbsp; | &nbsp; <a href="http://support.hogash.com/kallyas-help/" target="_blank">Kallyas Video Tutorials & Documentation</a> &nbsp; | &nbsp; <a href="http://themeforest.net/downloads?sort_by=Recent+Updates&filter_by=themeforest.net#item-4091658" target="_blank" class="stars-yellow">Rate Kallyas <span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></a>', 'zn_framework' ),
    "id"          => "advo_otherlinks",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn-custom-title-sm zn_nomargin"
);

/************** */

$admin_options[] = array(
    'slug'        => 'custom_css',
    'parent'      => 'advanced_options',
    'id'          => 'custom_css',
    'name'        => 'Custom css',
    'description' => 'Here you can enter your custom css that will be used by the theme.',
    'type'        => 'custom_css',
    'class'       => 'zn_full'
);

$admin_options[] = array (
    'slug'        => 'custom_css',
    'parent'      => 'advanced_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "adv_css_o_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator"
);

$admin_options[] = array (
    'slug'        => 'custom_css',
    'parent'      => 'advanced_options',
    "name"        => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> Video Tutorials: <a href="http://support.hogash.com/kallyas-videos/#d4D9lAV8NEs" target="_blank">Add custom CSS</a>', 'zn_framework' ),
    "id"          => "adv_css_o_video",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn_nomargin"
);

$admin_options[] = array (
    'slug'        => 'custom_css',
    'parent'      => 'advanced_options',
    "name"        => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> Written Documentation: <a href="http://support.hogash.com/documentation/adding-custom-css/" target="_blank">Click here to access documentation for this options section.</a>', 'zn_framework' ),
    "id"          => "adv_css_o_link",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn_nomargin"
);

$admin_options[] = array (
    'slug'        => 'custom_css',
    'parent'      => 'advanced_options',
    "name"        => __( '<a href="http://support.hogash.com/support/forum/wordpress-themes/kallyas-wordpress-theme/" target="_blank">Support Forums</a> &nbsp; | &nbsp; <a href="http://support.hogash.com/kallyas-help/" target="_blank">Kallyas Video Tutorials & Documentation</a> &nbsp; | &nbsp; <a href="http://themeforest.net/downloads?sort_by=Recent+Updates&filter_by=themeforest.net#item-4091658" target="_blank" class="stars-yellow">Rate Kallyas <span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></a>', 'zn_framework' ),
    "id"          => "adv_css_o_otherlinks",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn-custom-title-sm zn_nomargin"
);

$admin_options[] = array(
    'slug'        => 'custom_js',
    'parent'      => 'advanced_options',
    'id'          => 'custom_js',
    'name'        => 'Custom Javascript',
    'description' => 'Here you can enter your custom javascript that will be added on all pages.',
    'type'        => 'custom_code',
    'editor_type'        => 'javascript',
    'class'       => 'zn_full'
);

$admin_options[] = array (
    'slug'        => 'custom_js',
    'parent'      => 'advanced_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "adv_js_o_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator"
);

$admin_options[] = array (
    'slug'        => 'custom_js',
    'parent'      => 'advanced_options',
    "name"        => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> Video Tutorials: <a href="http://support.hogash.com/kallyas-videos/#DIvUKRBQ3BM" target="_blank">Add custom JS</a>', 'zn_framework' ),
    "id"          => "adv_js_o_video",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn_nomargin"
);

$admin_options[] = array (
    'slug'        => 'custom_js',
    'parent'      => 'advanced_options',
    "name"        => __( '<a href="http://support.hogash.com/support/forum/wordpress-themes/kallyas-wordpress-theme/" target="_blank">Support Forums</a> &nbsp; | &nbsp; <a href="http://support.hogash.com/kallyas-help/" target="_blank">Kallyas Video Tutorials & Documentation</a> &nbsp; | &nbsp; <a href="http://themeforest.net/downloads?sort_by=Recent+Updates&filter_by=themeforest.net#item-4091658" target="_blank" class="stars-yellow">Rate Kallyas <span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></a>', 'zn_framework' ),
    "id"          => "adv_js_o_otherlinks",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn-custom-title-sm zn_nomargin"
);
// $admin_options[] = array (
//     'slug'        => 'advanced_options',
//     'parent'      => 'advanced_options',
//     "name"        => __( "Backup/Restore options", 'zn_framework' ),
//     "description" => __( "Using this feature you can backup or restore your theme options. If you want to restore a backup, please click on the backup name. If you want to delete a backup , press the red x next to the backup", 'zn_framework' ),
//     "id"          => "backup_restore",
//     "type"        => "zn_backup_restore",
// );

// $admin_options[] = array(
//     'slug'        => 'advanced_options',
//     'parent'      => 'advanced_options',
//     'name'        => __('Debug info', 'zn_framework'),
//     'description' => __('Send us this information so we can help you with debugging any issues you might experience with Kallyas.', 'zn_framework'),
//     'id'          => 'zn_get_debug_info',
//     'type'        => 'zn_debug_info',
// );

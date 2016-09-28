<?php
/**
 * Theme options > General Options  > Mailchimp options
 */

$admin_options[] = array (
    'slug'        => 'mailchimp_options',
    'parent'      => 'general_options',
    "name"        => __( 'MAILCHIMP OPTIONS', 'zn_framework' ),
    "description" => __( 'The options below are related to Mailchimp (Online email marketing) platform integration in Kallyas. ', 'zn_framework' ),
    "id"          => "info_title12",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-large zn-toptabs-margin"
);

$admin_options[] = array (
	'slug'        => 'mailchimp_options',
    'parent'      => 'general_options',
    "name"        => __( "Mailchimp API KEY", 'zn_framework' ),
    "description" => __( "Paste your mailchimp api key that will be used by the mailchimp widget.", 'zn_framework' ),
    "id"          => "mailchimp_api",
    "std"         => '',
    "type"        => "text"
);

$admin_options[] = array (
    'slug'        => 'mailchimp_options',
    'parent'      => 'general_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "mco_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator"
);

$admin_options[] = array (
    'slug'        => 'mailchimp_options',
    'parent'      => 'general_options',
    "name"        => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> Video Tutorial: <a href="http://support.hogash.com/kallyas-videos/#4zt7-E985Xw" target="_blank">Click here to access video tutorial for this options section.</a>', 'zn_framework' ),
    "id"          => "mco_video",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn_nomargin"
);

$admin_options[] = array (
    'slug'        => 'mailchimp_options',
    'parent'      => 'general_options',
    "name"        => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> Written Documentation: <a href="http://support.hogash.com/documentation/configure-mailchimp/" target="_blank">Click here to access documentation for this options section.</a>', 'zn_framework' ),
    "id"          => "mco_link",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn_nomargin"
);

$admin_options[] = array (
    'slug'        => 'mailchimp_options',
    'parent'      => 'general_options',
    "name"        => __( '<a href="http://support.hogash.com/support/forum/wordpress-themes/kallyas-wordpress-theme/" target="_blank">Support Forums</a> &nbsp; | &nbsp; <a href="http://support.hogash.com/kallyas-help/" target="_blank">Kallyas Video Tutorials & Documentation</a> &nbsp; | &nbsp; <a href="http://themeforest.net/downloads?sort_by=Recent+Updates&filter_by=themeforest.net#item-4091658" target="_blank" class="stars-yellow">Rate Kallyas <span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></a>', 'zn_framework' ),
    "id"          => "mco_otherlinks",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn-custom-title-sm zn_nomargin"
);
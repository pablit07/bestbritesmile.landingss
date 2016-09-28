<?php
/**
 * Theme options > General Options  > ReCaptcha options
 */

$admin_options[] = array (
    'slug'        => 'recaptcha_options',
    'parent'      => 'general_options',
    "name"        => __( 'RECAPTCHA OPTIONS', 'zn_framework' ),
    "description" => __( 'The options below are related to <a href="http://www.google.com/recaptcha" target="_blank">Google ReCaptcha</a> security integration in Kallyas forms. ', 'zn_framework' ),
    "id"          => "info_title13",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-large zn-toptabs-margin"
);


$admin_options[] = array (
    'slug'        => 'recaptcha_options',
    'parent'      => 'general_options',
    "name"        => __( "Recaptcha style", 'zn_framework' ),
    "description" => __( "Choose the desired recapthca style.", 'zn_framework' ),
    "id"          => "rec_theme",
    "std"         => "red",
    "type"        => "select",
    "options"     => array (
        "red"        => __( "Red", 'zn_framework' ),
        "white"      => __( "White", 'zn_framework' ),
        "blackglass" => __( "Blackglass", 'zn_framework' ),
        "clean"      => __( "Clean", 'zn_framework' ),
    )
);

$admin_options[] = array (
    'slug'        => 'recaptcha_options',
    'parent'      => 'general_options',
    "name"        => __( "reCaptcha Public Key", 'zn_framework' ),
    "description" => __( "Please enter the Public key got from http://www.google.com/recaptcha.", 'zn_framework' ),
    "id"          => "rec_pub_key",
    "std"         => "",
    "type"        => "text"
);

$admin_options[] = array (
    'slug'        => 'recaptcha_options',
    'parent'      => 'general_options',
    "name"        => __( "reCaptcha Private Key", 'zn_framework' ),
    "description" => __( "Please enter the Private key got from http://www.google.com/recaptcha", 'zn_framework' ),
    "id"          => "rec_priv_key",
    "std"         => "",
    "type"        => "text"
);

$admin_options[] = array (
    'slug'        => 'recaptcha_options',
    'parent'      => 'general_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "rco_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator"
);

$admin_options[] = array (
    'slug'        => 'recaptcha_options',
    'parent'      => 'general_options',
    "name"        => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> Video Tutorial: <a href="http://support.hogash.com/kallyas-videos/#MXRAmRVaOaY" target="_blank">Click here to access video tutorial for this options section.</a>', 'zn_framework' ),
    "id"          => "rco_video",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn_nomargin"
);

$admin_options[] = array (
    'slug'        => 'recaptcha_options',
    'parent'      => 'general_options',
    "name"        => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> Written Documentation: <a href="http://support.hogash.com/documentation/configure-recaptcha/" target="_blank">Click here to access documentation for this options section.</a>', 'zn_framework' ),
    "id"          => "rco_link",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn_nomargin"
);

$admin_options[] = array (
    'slug'        => 'recaptcha_options',
    'parent'      => 'general_options',
    "name"        => __( '<a href="http://support.hogash.com/support/forum/wordpress-themes/kallyas-wordpress-theme/" target="_blank">Support Forums</a> &nbsp; | &nbsp; <a href="http://support.hogash.com/kallyas-help/" target="_blank">Kallyas Video Tutorials & Documentation</a> &nbsp; | &nbsp; <a href="http://themeforest.net/downloads?sort_by=Recent+Updates&filter_by=themeforest.net#item-4091658" target="_blank" class="stars-yellow">Rate Kallyas <span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></a>', 'zn_framework' ),
    "id"          => "rco_otherlinks",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn-custom-title-sm zn_nomargin"
);
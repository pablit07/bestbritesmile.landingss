<?php
/**
 * Theme options > General Options  > Favicon options
 */

$mail_lists = array ();
$mailchimp_api = zget_option( 'mailchimp_api', 'general_options' );
if ( ! empty( $mailchimp_api ) ) {
    if ( ! class_exists( 'MCAPI' ) ) {
        include_once( THEME_BASE . '/template_helpers/widgets/mailchimp/MCAPI.class.php' );
    }

    $api_key = $mailchimp_api;
    $mcapi   = new MCAPI( $api_key );
    $lists   = $mcapi->lists();
    if ( ! empty( $lists['data'] ) ) {
        foreach ( $lists['data'] as $key => $value ) {
            $mail_lists[ $value['id'] ] = $value['name'];
        }
    }
}

// ENABLE COMING SOON PAGE
$admin_options[] = array (
    'slug'        => 'coming_soon_options',
    'parent'      => 'coming_soon_options',
    "name"        => __( "Enable Coming Soon?", 'zn_framework' ),
    "description" => __( "If enabled, the visitors will be displayed the coming soon page. Please note that
		all logged in users will still be able to see your site.", 'zn_framework' ),
    "id"          => "cs_enable",
    "std"         => "no",
    "type"        => "zn_radio",
    "options"     => array (
        'yes' => 'Enable',
        'no'  => 'Disable'
    ),
);

// ENABLE COMING SOON PAGE

$admin_options[] = array (
    'slug'        => 'coming_soon_options',
    'parent'      => 'coming_soon_options',
    "name"           => __( "Description", 'zn_framework' ),
    "description"    => __( "Enter a description that will appear above the countdown clock.", 'zn_framework' ),
    "id"             => "cs_desc",
    "std"            => __( "We are currently working on a new website and won't take long. Please don't forget to check
		out our tweets and to subscribe to be notified!", 'zn_framework' ),
    "type"           => "textarea",
    "translate_name" => __( "Coming Soon Page Description", 'zn_framework' ),
    'dependency'     => array ( 'element' => 'cs_enable', 'value' => array ( 'yes' ) ),
);

// ENABLE COMING SOON PAGE

$admin_options[] = array (
    'slug'        => 'coming_soon_options',
    'parent'      => 'coming_soon_options',
    "name"        => __( "Launch date", 'zn_framework' ),
    "description" => __( "Please select the date when your site will be available.", 'zn_framework' ),
    "id"          => "cs_date",
    "std"         => "",
    "type"        => "date_picker",
    'dependency'  => array ( 'element' => 'cs_enable', 'value' => array ( 'yes' ) ),
);

// MAILCHIMP LIST ID

$admin_options[] = array (
    'slug'        => 'coming_soon_options',
    'parent'      => 'coming_soon_options',
    "name"        => __( "Mailchimp List ID", 'zn_framework' ),
    "description" => __( "Please select the mailchimp list ID you want to use. Please note that in order for the theme to display your list id's ,you will need to enter your Mailchimp API id in the General options > Mailchimp API option", 'zn_framework' ),
    "id"          => "cs_lsit_id",
    "std"         => "",
    "type"        => "select",
    "options"     => $mail_lists,
    'dependency'  => array ( 'element' => 'cs_enable', 'value' => array ( 'yes' ) ),
);


// Show/Hide Social Icons in footer
$admin_options[] = array (
    'slug'        => 'coming_soon_options',
    'parent'      => 'coming_soon_options',
    "name"        => __( "Show or hide the Social icons", 'zn_framework' ),
    "description" => __( "Display the social icons list in coming soon page?.", 'zn_framework' ),
    "id"          => "cs_social_icons_enable",
    "std"         => "yes",
    "type"        => "zn_radio",
    "options"     => array (
        "yes" => __( "Show", 'zn_framework' ),
        "no"  => __( "Hide", 'zn_framework' )
    ),
    'dependency'  => array ( 'element' => 'cs_enable', 'value' => array ( 'yes' ) ),
);

$admin_options[]         = array (
    'slug'        => 'coming_soon_options',
    'parent'      => 'coming_soon_options',
    "name"        => __( "Use normal or colored social icons?", 'zn_framework' ),
    "description" => __( "Here you can choose to use the normal social icons or the colored version of each icon.", 'zn_framework' ),
    "id"          => "cs_which_icons_set",
    "std"         => "",
    "type"        => "select",
    "options"     => array (
        'normal'  => __( 'Normal Icons', 'zn_framework' ),
        'colored' => __( 'Colored icons', 'zn_framework' ),
        'colored_hov' => __( 'Colored on Hover icons', 'zn_framework' ),
        'clean' => __( 'Clean icons', 'zn_framework' )
    ),
    'dependency'  => array ( 'element' => 'cs_enable', 'value' => array ( 'yes' ) ),
);

$admin_options[] = array (
    'slug'        => 'coming_soon_options',
    'parent'      => 'coming_soon_options',
    "name"        => __( "Social Icons", 'zn_framework' ),
    "description" => __( "Here you can configure what social icons to appear on the right side of the MailChimp
		form.", 'zn_framework' ),
    "id"          => "cs_social_icons",
    "std"         => "",
    "type"        => "group",
    "element_title"    => "cs_social_title",
    "add_text"    => __( "Social Icon", 'zn_framework' ),
    "remove_text" => __( "Social Icon", 'zn_framework' ),
    "subelements" => array (
        array (
            "name"        => __( "Icon title", 'zn_framework' ),
            "description" => __( "Here you can enter a title for this social icon.Please note that this is just
				for your information as this text will not be visible on the site.", 'zn_framework' ),
            "id"          => "cs_social_title",
            "std"         => "",
            "type"        => "text"
        ),
        array (
            "name"        => __( "Social icon link", 'zn_framework' ),
            "description" => __( "Please enter your desired link for the social icon. If this field is left
				blank, the icon will not be linked.", 'zn_framework' ),
            "id"          => "cs_social_link",
            "std"         => "",
            "type"        => "link",
            "options"     => array (
                '_blank' => __( "New window", 'zn_framework' ),
                '_self'  => __( "Same window", 'zn_framework' ),
            )
        ),
        array (
            "name"        => __( "Social icon Background color", 'zn_framework' ),
            "description" => __( "Select a background color for the icon (if you selected <strong>Colored</strong> or <strong>Colored on hover</strong> options)", 'zn_framework' ),
            "id"          => "cs_social_color",
            "std"         => "#000",
            "type"        => "colorpicker"
        ),
        array (
            "name"        => __( "Social icon", 'zn_framework' ),
            "description" => __( "Select your desired social icon.", 'zn_framework' ),
            "id"          => "cs_social_icon",
            "std"         => "",
            "type"        => "icon_list",
            'class'       => 'zn_full'
        )
    ),
    'dependency'  => array ( 'element' => 'cs_enable', 'value' => array ( 'yes' ) ),
);

$admin_options[] = array (
    'slug'        => 'coming_soon_options',
    'parent'      => 'coming_soon_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "cmso_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator"
);

$admin_options[] = array (
    'slug'        => 'coming_soon_options',
    'parent'      => 'coming_soon_options',
    "name"        => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> Video Tutorial: <a href="http://support.hogash.com/kallyas-videos/#7-u8q7VwPaA" target="_blank">Click here to access video tutorial for this options section.</a>', 'zn_framework' ),
    "id"          => "cmso_video",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn_nomargin"
);

// $admin_options[] = array (
//     'slug'        => 'coming_soon_options',
//     'parent'      => 'coming_soon_options',
//     "name"        => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> Written Documentation: <a href="" target="_blank">Click here to access documentation for this options section.</a>', 'zn_framework' ),
//     "id"          => "cmso_link",
//     "std"         => "",
//     "type"        => "zn_title",
//     "class"       => "zn_full zn-admin-helplink zn_nomargin"
// );

$admin_options[] = array (
    'slug'        => 'coming_soon_options',
    'parent'      => 'coming_soon_options',
    "name"        => __( '<a href="http://support.hogash.com/support/forum/wordpress-themes/kallyas-wordpress-theme/" target="_blank">Support Forums</a> &nbsp; | &nbsp; <a href="http://support.hogash.com/kallyas-help/" target="_blank">Kallyas Video Tutorials & Documentation</a> &nbsp; | &nbsp; <a href="http://themeforest.net/downloads?sort_by=Recent+Updates&filter_by=themeforest.net#item-4091658" target="_blank" class="stars-yellow">Rate Kallyas <span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></a>', 'zn_framework' ),
    "id"          => "cmso_otherlinks",
    "std"         => "",
    "type"        => "zn_title",
    "class"       => "zn_full zn-admin-helplink zn-custom-title-sm zn_nomargin"
);
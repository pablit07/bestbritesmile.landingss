<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' );?>"/>
<meta name="twitter:widgets:csp" content="on">
<link rel="profile" href="http://gmpg.org/xfn/11"/>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<link href='https://fonts.googleapis.com/css?family=Arimo:400,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>
<?php
	global $post;
	wp_head();

?>
</head>
<body  <?php body_class(); ?>>


<?php //<!-- AFTER BODY ACTION -->
/*
 * @hooked zn_add_page_loading()
 * @hooked zn_add_hidden_panel()
 * @hooked zn_add_login_form()
 * @hooked zn_add_open_graph()
 */
do_action( 'zn_after_body' ); ?>


<div id="page_wrapper">

<?php
/*
 * Display SITE HEADER
 */
do_action('th_display_site_header');
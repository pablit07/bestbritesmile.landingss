<?php

/* FILTERS */
add_filter( 'zn_theme_pages', 'zn_woocommerce_pages' );
add_filter( 'zn_theme_options', 'zn_woocommerce_options' );

function zn_woocommerce_pages( $admin_pages ){
	$admin_pages['zn_woocommerce_options'] = array(
			'title' =>  'Woocommerce options',
			'submenus' => 	array(
					array(
						'slug' => 'zn_woocommerce_options',
						'title' =>  __( "General options", 'zn_framework' )
					),
					array(
						'slug' => 'woo_category_options',
						'title' =>  __( "Categories page", 'zn_framework' ),
					),
				)
		);

	return $admin_pages;
}

function zn_woocommerce_options( $admin_options ){

$admin_options[] = array (
	'slug'        => 'zn_woocommerce_options',
	'parent'      => 'zn_woocommerce_options',
    "name"        => __( "Enable Catalog Mode?", 'zn_framework' ),
    "description" => __( "Choose yes if you want to turn your shop in a catalog mode shop ( all the purchase buttons will be removed. )", 'zn_framework' ),
    "id"          => "woo_catalog_mode",
    "std"         => "no",
    "type"        => "zn_radio",
    "options"     => array (
        "yes" => __( "Yes", 'zn_framework' ),
        "no"  => __( "No", 'zn_framework' )
    )
);

$admin_options[] = array (
    'slug'        => 'zn_woocommerce_options',
    'parent'      => 'zn_woocommerce_options',
    'id'            => 'zn_use_second_image',
    'name'          => 'Show first gallery image on image hover ?',
    'description'   => 'Select if you want to show the first gallery image when you hover over the product in archive pages.',
    'type'          => 'toggle2',
    'std'           => 'yes',
    'value'         => 'yes'
);

$admin_options[] = array (
    'slug'        => 'zn_woocommerce_options',
    'parent'      => 'zn_woocommerce_options',
    'id'            => 'zn_show_thumb_on_hover',
    'name'          => 'Replace product main image on hover ?',
    'description'   => 'Replace product main image when hovering a thumbnail ? <b>Please note that depending on your image sizes, it may be possible that your images won\'t look good if you enable this.</b>',
    'type'          => 'toggle2',
    'std'           => 'yes',
    'value'         => 'yes'
);

$header_option = WpkZn::getThemeHeaders(true);
$admin_options[] = array (
    'slug'        => 'zn_woocommerce_options',
    'parent'      => 'zn_woocommerce_options',
    "name"        => __( "Header Style for main shop page", 'zn_framework' ),
    "description" => __( 'Select the background style you want to use.Please note that the styles can be created from the "Unlimited Headers" options in the theme admin\'s page.', 'zn_framework' ),
    "id"          => "woo_sub_header",
    "std"         => "",
    "type"        => "select",
    "options"     => $header_option,
    "class"       => ""
);

$admin_options[] = array (
    'slug'        => 'zn_woocommerce_options',
    'parent'      => 'zn_woocommerce_options',
    "name"        => __( "Show cart to visitors?", 'zn_framework' ),
    "description" => __( "Choose no if you want to hide the add to cart buttons for visitors. )", 'zn_framework' ),
    "id"          => "show_cart_to_visitors",
    "std"         => "yes",
    "type"        => "zn_radio",
    "options"     => array (
        "yes" => __( "Yes", 'zn_framework' ),
        "no"  => __( "No", 'zn_framework' )
    )
);


$admin_options[] = array (
	'slug'        => 'zn_woocommerce_options',
	'parent'      => 'zn_woocommerce_options',
    "name"        => __( "Show MY CART in header", 'zn_framework' ),
    "description" => __( "Choose yes if you want to show a link to MY CART and the total value of the cart in
		                    the header", 'zn_framework' ),
    "id"          => "woo_show_cart",
    "std"         =>  "1",
    "type"        => "zn_radio",
    "options"     => array (
        "1" => __( "Show", 'zn_framework' ),
        "0" => __( "Hide", 'zn_framework' )
    )
);

// Show new items badge

$show_new_badge = array (
    "1" => __( "Show", 'zn_framework' ),
    "0" => __( "Hide", 'zn_framework' )
);
$admin_options[]   = array (
	'slug'        => 'zn_woocommerce_options',
	'parent'      => 'zn_woocommerce_options',
    "name"        => __( "Show new items badge ?", 'zn_framework' ),
    "description" => __( "Choose yes if you want to show a NEW item badge over the new products", 'zn_framework' ),
    "id"          => "woo_new_badge",
    "std"         => "1",
    "type"        => "zn_radio",
    "options"     => $show_new_badge
);

$admin_options[] = array (
	'slug'        => 'zn_woocommerce_options',
	'parent'      => 'zn_woocommerce_options',
    "name"        => __( "Hide small description in catalog view and related products ?", 'zn_framework' ),
    "description" => __( "Choose yes if you want to hide the short description in the catalog mode and related
		                    products", 'zn_framework' ),
    "id"          => "woo_hide_small_desc",
    "std"         => "no",
    "type"        => "zn_radio",
    "options"     => array (
        "yes" => __( "Yes", 'zn_framework' ),
        "no"  => __( "No", 'zn_framework' )
    )
);

// Days to show as new
$admin_options[] = array (
	'slug'        => 'zn_woocommerce_options',
	'parent'      => 'zn_woocommerce_options',
    "name"        => __( "Days to show badge", 'zn_framework' ),
    "description" => __( "Please insert the number of days after a product is published to display the badge", 'zn_framework' ),
    "id"          => "woo_new_badge_days",
    "std"         => '3',
    "type"        => "text",
    'dependency'  => array ( 'element' => 'woo_new_badge', 'value' => array ( '1' ) ),
);

$admin_options[] = array (
	'slug'        => 'zn_woocommerce_options',
	'parent'      => 'zn_woocommerce_options',
    "name"        => __( "Products per page", 'zn_framework' ),
    "description" => __( "Enter the desired number of products to be displayed per page.", 'zn_framework' ),
    "id"          => "woo_show_products_per_page",
    "std"         => "9",
    "type"        => "text",
    "class"       => ""
);


//$admin_options[] = array (
//    'slug'        => 'zn_woocommerce_options',
//    'parent'      => 'zn_woocommerce_options',
//    "name"        => __( " Products layout ", 'zn_framework' ),
//    "description" => __( "Choose the products layout", 'zn_framework' ),
//    "id"          => "woo_prod_layout",
//    "std"         => "classic",
//    "type"        => "select",
//    "options"     => array (
//        "classic" => __( "Classic", 'zn_framework' ),
//        "modern"  => __( "Modern v4.0+", 'zn_framework' )
//    )
//);


/*** CATEGORY PAGE ***/
if(!isset($sidebar_option) || empty($sidebar_option)){
    $sidebar_option = WpkZn::getThemeSidebars();
}

$admin_options[] = array (
	'slug'        => 'woo_category_options',
	'parent'      => 'zn_woocommerce_options',
    "name"           => __( "Shop Archive Page Title", 'zn_framework' ),
    "description"    => __( "Enter the desired page title for the shop archive page.", 'zn_framework' ),
    "id"             => "woo_arch_page_title",
    "std"            => __( "OUR PRODUCTS", 'zn_framework' ),
    "type"           => "text",
    "translate_name" => __( "Shop Archive Page Title", 'zn_framework' ),
    "class"          => ""
);

$admin_options[] = array (
	'slug'        => 'woo_category_options',
	'parent'      => 'zn_woocommerce_options',
    "name"           => __( "Shop Archive Page Subitle", 'zn_framework' ),
    "description"    => __( "Enter the desired page subtitle for the Shop archive page.", 'zn_framework' ),
    "id"             => "woo_arch_page_subtitle",
    "std"            => __( "Shop category here with product list", 'zn_framework' ),
    "type"           => "text",
    "translate_name" => __( "Shop Archive Page Subtitle", 'zn_framework' ),
    "class"          => ""
);

$admin_options[] = array (
	'slug'        => 'woo_category_options',
	'parent'      => 'zn_woocommerce_options',
    "name"        => __( "Image size", 'zn_framework' ),
    "description" => __( "Enter the desired image sizes for the category images. Please note that the single item image sizes can be set from WooCommerce options.", 'zn_framework' ),
    "id"          => "woo_cat_image_size",
    "std"         => "",
    "type"        => "image_size",
    "class"       => ""
);

$admin_options[] = array (
    'slug'        => 'zn_woocommerce_options',
    'parent'      => 'zn_woocommerce_options',
    "name"        => __( "Lazy Load Images ?", 'zn_framework' ),
    "description" => __( "This option creates a cool simple fade-in effect for images in category listing.", 'zn_framework' ),
    "id"          => "woo_img_lazyload",
    "std"         => "no",
    "type"        => "zn_radio",
    "options"     => array (
        "yes" => __( "Yes", 'zn_framework' ),
        "no"  => __( "No", 'zn_framework' )
    )
);

$admin_options[] = array (
    'slug'        => 'zn_woocommerce_options',
    'parent'      => 'zn_woocommerce_options',
    "name"        => __( "Display discount amount in sale flash?", 'zn_framework' ),
    "description" => __( "If checked, this option will display the discount amount as percentage in the products sale
     flash badge.",'zn_framework' ),
    "id"          => "woo_show_sale_flash_discount",
    "std"         => "no",
    "type"        => "zn_radio",
    "options"     => array (
        "yes" => __( "Yes", 'zn_framework' ),
        "no"  => __( "No", 'zn_framework' )
    )
);





$sidebar_options = array( 'right_sidebar' => 'Right sidebar' , 'left_sidebar' => 'Left sidebar' , 'no_sidebar' => 'No sidebar' );
$admin_options[] = array(
    'slug'        => 'sidebar_settings',
    'parent'      => 'unlimited_sidebars',
    'id'          => 'woo_archive_sidebar',
    'name'        => 'Sidebar on Shop archive pages',
    'description' => 'Please choose the sidebar position for the shop archive pages.',
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
    'id'          => 'woo_single_sidebar',
    'name'        => 'Sidebar on Shop product page',
    'description' => 'Please choose the sidebar position for the shop product pages.',
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
	return $admin_options;

}

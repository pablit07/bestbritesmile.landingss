<?php
	/**
	* Plugin Name: WooSale Converter Plugin
	* Description: Let the user easily change simple functions in WooCommerce that can affect sales.
	* Version: 1.0
	* Tested on wordpress: 4.0
	* Author: Weblink Solutions AS
	* Legal: Copyright 2014 - This file is protected by copyright law and provided under license.
	*/
	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly
	}



	/***************************************************/

	class GiWOO_WooSales_Converter {

		/**
		* Bootstraps the class and hooks required actions & filters.
		*
		*/
		public static function init() {
			add_filter( 'woocommerce_settings_tabs_array', __CLASS__ . '::add_settings_tab', 50 );
			add_action( 'woocommerce_settings_tabs_settings_tab_woosales_converter', __CLASS__ . '::settings_tab' );
			add_action( 'woocommerce_update_options_settings_tab_woosales_converter', __CLASS__ . '::update_settings' );
		}
		/**
		* Add a new settings tab to the WooCommerce settings tabs array.
		*
		* @param array $settings_tabs Array of WooCommerce setting tabs & their labels, excluding the Subscription tab.
		* @return array $settings_tabs Array of WooCommerce setting tabs & their labels, including the Subscription tab.
		*/
		public static function add_settings_tab( $settings_tabs ) {
			$settings_tabs['settings_tab_woosales_converter'] = __( 'WooSale Converter', 'woocommerce-settings-tab-woosale-converter' );
			return $settings_tabs;
		}


		/**
		* Uses the WooCommerce admin fields API to output settings via the @see woocommerce_admin_fields() function.
		*
		* @uses woocommerce_admin_fields()
		* @uses self::get_settings()
		*/
		public static function settings_tab() {
			woocommerce_admin_fields( self::get_settings() );
		}


		/**
		* Uses the WooCommerce options API to save settings via the @see woocommerce_update_options() function.
		*
		* @uses woocommerce_update_options()
		* @uses self::get_settings()
		*/
		public static function update_settings() {
			woocommerce_update_options( self::get_settings() );
		}


		/**
		* Get all the settings for this plugin for @see woocommerce_admin_fields() function.
		*
		* @return array Array of settings for @see woocommerce_admin_fields() function.
		*/
		public static function get_settings() {

			$settings = array(
				'section_title' => array(
					'name' => __( 'WooSale Converter Plugin version 1.0', 'woocommerce-settings-tab-woosale-converter' ),
					'type' => 'title',
					'desc' => __( 'Adjust the settings below to configure the plugin as you want', 'woocommerce-settings-tab-woosale-converter' ),
					'id' => 'GiWOO_section_title_1'
				),
				'section_subtitle' => array(
					'name' => __( 'Frontend shopping functions', 'woocommerce-settings-tab-woosale-converter' ),
					'type' => 'title',
					'desc' => __( '', 'woocommerce-settings-tab-woosale-converter' ),
					'id' => 'GiWOO_WooSales_subtitle'
				),
				'direct_checkout' => array(
					'name' => __( 'Direct checkout', 'woocommerce-settings-tab-woosale-converter' ),
					'type' => 'checkbox',
					'label' => __( 'Enable direct checkout to skip the shopping cart page', 'woocommerce-settings-tab-woosale-converter' ),
					'desc' => __( 'Enable direct checkout to skip the shopping cart page.', 'woocommerce-settings-tab-woosale-converter' ),
					'id' => 'GiWOO_direct_checkout_enable'
				),
				"free_content_dc" => array(
					'type' => 'free_content',
					'content' => "<br><br>",
				),
				'section_end' => array(
					'type' => 'sectionend',
					'id' => 'GiWOO_WooSales_Converter_section_end_1'
				),

				/*******/

				'section_title_2' => array(
					'name' => __( 'Custom add to cart button on single product page', 'woocommerce-settings-tab-woosale-converter' ),
					'type' => 'title',
					'id' => 'GiWOO_section_title_2'
				),
				'button_enable_spp' => array(
					'name' => __( '', 'woocommerce-settings-tab-woosale-converter' ),
					'type' => 'checkbox',
					'desc' => __( 'Enable custom add to cart button', 'woocommerce-settings-tab-woosale-converter' ),
					'id' => 'GiWOO_button_enable_spp'
				),
				'button_name_spp' => array(
					'name' => __( 'Add to cart button text', 'woocommerce-settings-tab-woosale-converter' ),
					'type' => 'text',
					'desc' => __( '', 'woocommerce-settings-tab-woosale-converter' ),
					'id' => 'GiWOO_button_name_spp'
				),
				"free_content_spp_e" => array(
					'type' => 'free_content_2',
					'content_td' => "If you want you can generate buttons here: <a href=\"http://css3buttongenerator.com/\" target=\"_blank\">css3buttongenerator.com</a> and paste in the codes. <a href='#' onclick=\"jQuery('.button_style_spp_example').toggle(); return false;\"><b>CLICK HERE TO VIEW EXAMPLE</b></a><br><img class='button_style_spp_example' src='". plugins_url() ."/woocommerce-woosale-converter/images/view-example1.jpg' style='display: none; width: 100%; max-width: 600px; height: auto;'>",
				),

				'button_style_spp' => array(
					'name' => __( 'Custom button style with CSS', 'woocommerce-settings-tab-woosale-converter' ),
					'type' => 'textarea',
					'custom_attributes' => array(
						'placeholder' => __( 'Paste your button CSS styling code here...', 'woocommerce-settings-tab-woosale-converter' ),
					),
					'css' => 'width: 90%; height: 100px',
					'id' => 'GiWOO_button_style_spp'
				),
				'button_style_spp_hover' => array(
					'name' => __( 'Custom button style with CSS (HOVER state)', 'woocommerce-settings-tab-woosale-converter' ),
					'type' => 'textarea',
					'custom_attributes' => array(
						'placeholder' => __( 'Paste your button CSS styling code here...', 'woocommerce-settings-tab-woosale-converter' ),
					),
					'css' => 'width: 90%; height: 100px',
					'id' => 'GiWOO_button_style_spp_hover'
				),
				"free_content_spp" => array(
					'type' => 'free_content',
					'content' => "<br><br>",
				),
				'section_end_2' => array(
					'type' => 'sectionend',
					'id' => 'GiWOO_WooSales_Converter_section_end_2'
				),

				/********/

				'section_title_3' => array(
					'name' => __( 'Custom add to cart button on all other archive product pages', 'woocommerce-settings-tab-woosale-converter' ),
					'type' => 'title',
					'id' => 'GiWOO_section_title_3'
				),
				'button_enable_app' => array(
					'name' => __( '', 'woocommerce-settings-tab-woosale-converter' ),
					'type' => 'checkbox',
					'desc' => __( 'Enable custom add to cart button', 'woocommerce-settings-tab-woosale-converter' ),
					'id' => 'GiWOO_button_enable_app'
				),
				'button_name_app' => array(
					'name' => __( 'Add to cart button text', 'woocommerce-settings-tab-woosale-converter' ),
					'type' => 'text',
					'desc' => __( '<br>Keep this blank to use default', 'woocommerce-settings-tab-woosale-converter' ),
					'id' => 'GiWOO_button_name_app'
				),
				"free_content_app_e" => array(
					'type' => 'free_content_2',
					'content_td' => "If you want you can generate buttons here: <a href=\"http://css3buttongenerator.com/\" target=\"_blank\">css3buttongenerator.com</a> and paste in the codes. <a href='#' onclick=\"jQuery('.button_style_app_example').toggle(); return false;\"><b>CLICK HERE TO VIEW EXAMPLE</b></a><br><img class='button_style_app_example' src='". plugins_url() ."/woocommerce-woosale-converter/images/view-example1.jpg' style='display: none; width: 100%; max-width: 600px; height: auto;'>",
				),
				'app' => array(
					'name' => __( 'Custom button style with CSS', 'woocommerce-settings-tab-woosale-converter' ),
					'type' => 'textarea',
					'custom_attributes' => array(
						'placeholder' => __( 'Paste your button CSS styling code here...', 'woocommerce-settings-tab-woosale-converter' ),
					),
					'css' => 'width: 90%; height: 100px',
					'id' => 'GiWOO_button_style_app'
				),
				'button_style_app_hover' => array(
					'name' => __( 'Custom button style with CSS (HOVER state)', 'woocommerce-settings-tab-woosale-converter' ),
					'type' => 'textarea',
					'custom_attributes' => array(
						'placeholder' => __( 'Paste your button CSS styling code here...', 'woocommerce-settings-tab-woosale-converter' ),
					),
					'css' => 'width: 90%; height: 100px',
					'id' => 'GiWOO_button_style_app_hover'
				),
				"free_content_app" => array(
					'type' => 'free_content',
					'content' => "<br><br>",
				),
				'section_end_3' => array(
					'type' => 'sectionend',
					'id' => 'GiWOO_WooSales_Converter_section_end_3'
				),

				/********/

				'section_title_4' => array(
					'name' => __( 'Custom "buy now" button alongside your add to cart button on single product pages', 'woocommerce-settings-tab-woosale-converter' ),
					'type' => 'title',
					'desc' => __( '<hr>This button skips the shopping cart and goes directly to the checkout page.', 'woocommerce-settings-tab-woosale-converter' ),
					'id' => 'GiWOO_section_title_4'
				),
				'enable_bnb' => array(
					'name' => __( '', 'woocommerce-settings-tab-woosale-converter' ),
					'type' => 'checkbox',
					'desc' => __( 'Enable custom "buy now" button', 'woocommerce-settings-tab-woosale-converter' ),
					'id' => 'GiWOO_enable_bnb'
				),
				'button_name_bnb' => array(
					'name' => __( 'Buy now button text', 'woocommerce-settings-tab-woosale-converter' ),
					'type' => 'text',
					'id' => 'GiWOO_button_name_bnb'
				),
				"free_content_bnb_e" => array(
					'type' => 'free_content_2',
					'content_td' => "If you want you can generate buttons here: <a href=\"http://css3buttongenerator.com/\" target=\"_blank\">css3buttongenerator.com</a> and paste in the codes. <a href='#' onclick=\"jQuery('.button_style_bnb_example').toggle(); return false;\"><b>CLICK HERE TO VIEW EXAMPLE</b></a><br><img class='button_style_bnb_example' src='". plugins_url() ."/woocommerce-woosale-converter/images/view-example1.jpg' style='display: none; width: 100%; max-width: 600px; height: auto;'>",
				),
				'button_style_bnb' => array(
					'name' => __( 'Custom button style with CSS', 'woocommerce-settings-tab-woosale-converter' ),
					'type' => 'textarea',
					'custom_attributes' => array(
						'placeholder' => __( 'Paste your button CSS styling code here...', 'woocommerce-settings-tab-woosale-converter' ),
					),
					'css' => 'width: 90%; height: 100px',
					'id' => 'GiWOO_button_style_bnb'
				),
				'button_style_bnb_hover' => array(
					'name' => __( 'Custom button style with CSS (HOVER state)', 'woocommerce-settings-tab-woosale-converter' ),
					'type' => 'textarea',
					'custom_attributes' => array(
						'placeholder' => __( 'Paste your button CSS styling code here...', 'woocommerce-settings-tab-woosale-converter' ),
					),
					'css' => 'width: 90%; height: 100px',
					'id' => 'GiWOO_button_style_bnb_hover'
				),
				"free_content_bnb" => array(
					'type' => 'free_content',
					'content' => "<br><br>",
				),
				'section_end_4' => array(
					'type' => 'sectionend',
					'id' => 'GiWOO_WooSales_Converter_section_end_4'
				),

				/********/

				'section_title_4b' => array(
					'name' => __( 'Custom "buy now" button alongside your add to cart button on all other pages', 'woocommerce-settings-tab-woosale-converter' ),
					'type' => 'title',
					'desc' => __( '<hr>This button skips the shopping cart and goes directly to the checkout page', 'woocommerce-settings-tab-woosale-converter' ),
					'id' => 'GiWOO_section_title_4b'
				),
				'enable_bnb_a' => array(
					'name' => __( '', 'woocommerce-settings-tab-woosale-converter' ),
					'type' => 'checkbox',
					'desc' => __( 'Enable custom "buy now" button', 'woocommerce-settings-tab-woosale-converter' ),
					'id' => 'GiWOO_enable_bnb_a'
				),
				'button_name_bnb_a' => array(
					'name' => __( 'Buy now button text', 'woocommerce-settings-tab-woosale-converter' ),
					'type' => 'text',
					'id' => 'GiWOO_button_name_bnb_a'
				),
				"free_content_bnb_a_e" => array(
					'type' => 'free_content_2',
					'content_td' => "If you want you can generate buttons here: <a href=\"http://css3buttongenerator.com/\" target=\"_blank\">css3buttongenerator.com</a> and paste in the codes. <a href='#' onclick=\"jQuery('.button_style_bnb_a_example').toggle(); return false;\"><b>CLICK HERE TO VIEW EXAMPLE</b></a><br><img class='button_style_bnb_a_example' src='". plugins_url() ."/woocommerce-woosale-converter/images/view-example1.jpg' style='display: none; width: 100%; max-width: 600px; height: auto;'>",
				),
				'button_style_bnb_a' => array(
					'name' => __( 'Custom button style with CSS', 'woocommerce-settings-tab-woosale-converter' ),
					'type' => 'textarea',
					'custom_attributes' => array(
						'placeholder' => __( 'Paste your button CSS styling code here...', 'woocommerce-settings-tab-woosale-converter' ),
					),
					'css' => 'width: 90%; height: 100px',
					'id' => 'GiWOO_button_style_bnb_a'
				),
				'button_style_bnb_a_hover' => array(
					'name' => __( 'Custom button style with CSS (HOVER state)', 'woocommerce-settings-tab-woosale-converter' ),
					'type' => 'textarea',
					'custom_attributes' => array(
						'placeholder' => __( 'Paste your button CSS styling code here...', 'woocommerce-settings-tab-woosale-converter' ),
					),
					'css' => 'width: 90%; height: 100px',
					'id' => 'GiWOO_button_style_bnb_a_hover'
				),
				"free_content_bnb_a" => array(
					'type' => 'free_content',
					'content' => "<br><br>",
				),
				'section_end_4b' => array(
					'type' => 'sectionend',
					'id' => 'GiWOO_WooSales_Converter_section_end_4b'
				),

				/***************/

				'section_title_5' => array(
					'name' => __( 'Checkout page elements', 'woocommerce-settings-tab-woosale-converter' ),
					'type' => 'title',
					'desc' => '<hr>',
					'id' => 'GiWOO_section_title_5'
				),
				'enable_satisfaction_guarantee' => array(
					'name' => __( '', 'woocommerce-settings-tab-woosale-converter' ),
					'desc' => __( 'Enable satisfaction guarantee image below, or select your own<br>(Placed below payment form on the checkout page)', 'woocommerce-settings-tab-woosale-converter' ),
					'type' => 'checkbox',
					'id' => 'GiWOO_enable_satisfaction_guarantee'
				),
				"image_satisfaction_guarantee" => array (
					"name" => __( "Satisfaction guarantee image", 'woocommerce-settings-tab-woosale-converter' ),
					"label" => __( "Post Image", 'woocommerce-settings-tab-woosale-converter' ),
					"type" => "upload",
					"default_file" => plugins_url( 'images/satisfaction-guarantee.png', __FILE__ ),
					"desc" => "Upload file here…",
					"id" => 'GiWOO_image_satisfaction_guarantee'
				),

				"free_content_1" => array(
					'type' => 'free_content',
					'content' => "<hr>",
				),

				'enable_secure_checkout_image' => array(
					'name' => __( '', 'woocommerce-settings-tab-woosale-converter' ),
					'desc' => __( 'Enable secure checkout image below, or select your own<br>(Placed below payment form on the checkout page)', 'woocommerce-settings-tab-woosale-converter' ),
					'type' => 'checkbox',
					'id' => 'GiWOO_enable_secure_checkout_image'
				),
				"image_secure_checkout_image" => array (
					"name" => __( "Secure checkout image", 'woocommerce-settings-tab-woosale-converter' ),
					"label" => __( "Post Image", 'woocommerce-settings-tab-woosale-converter' ),
					"type" => "upload",
					"default_file" => plugins_url( 'images/secure-checkout.png', __FILE__ ),
					"desc" => __( "Upload file here…", 'woocommerce-settings-tab-woosale-converter' ),
					"id" => 'GiWOO_image_secure_checkout_image'
				),

				"free_content_2" => array(
					'type' => 'free_content',
					'content' => "<br><br>",
				),

				'section_end_5' => array(
					'type' => 'sectionend',
					'id' => 'GiWOO_WooSales_Converter_section_end_5'
				),

			);

			return apply_filters( 'GiWOO_WooSales_Converter_settings', $settings );
		}

	}

	GiWOO_WooSales_Converter::init();









	class GiWOO_Conversion_Tracking {

		/**
		* Bootstraps the class and hooks required actions & filters.
		*
		*/
		public static function init() {
			add_filter( 'woocommerce_settings_tabs_array', __CLASS__ . '::add_settings_tab', 50 );
			add_action( 'woocommerce_settings_tabs_settings_tab_conversion_tracking', __CLASS__ . '::settings_tab' );
			add_action( 'woocommerce_update_options_settings_tab_conversion_tracking', __CLASS__ . '::update_settings' );
		}
		/**
		* Add a new settings tab to the WooCommerce settings tabs array.
		*
		* @param array $settings_tabs Array of WooCommerce setting tabs & their labels, excluding the Subscription tab.
		* @return array $settings_tabs Array of WooCommerce setting tabs & their labels, including the Subscription tab.
		*/
		public static function add_settings_tab( $settings_tabs ) {
			$settings_tabs['settings_tab_conversion_tracking'] = __( 'Conversion tracking', 'woocommerce-settings-tab-woosale-converter' );
			return $settings_tabs;
		}


		/**
		* Uses the WooCommerce admin fields API to output settings via the @see woocommerce_admin_fields() function.
		*
		* @uses woocommerce_admin_fields()
		* @uses self::get_settings()
		*/
		public static function settings_tab() {
			woocommerce_admin_fields( self::get_settings() );
		}


		/**
		* Uses the WooCommerce options API to save settings via the @see woocommerce_update_options() function.
		*
		* @uses woocommerce_update_options()
		* @uses self::get_settings()
		*/
		public static function update_settings() {
			woocommerce_update_options( self::get_settings() );
		}


		/**
		* Get all the settings for this plugin for @see woocommerce_admin_fields() function.
		*
		* @return array Array of settings for @see woocommerce_admin_fields() function.
		*/
		public static function get_settings() {

			$settings = array(


				'section_title_6' => array(
					'name' => __( 'WooSale Conversion Tracking Pixel', 'woocommerce-settings-tab-woosale-converter' ),
					'type' => 'title',
					'desc' => __( '<hr>Insert your conversion tracking pixel below where you want.<br>You can get your conversion tracking code from integrations like Google Adwords, Facebook Ad system, or your own 3rd party tracking solutions:', 'woocommerce-settings-tab-woosale-converter' ),
					'id' => 'GiWOO_section_title_6'
				),
				/*'ws_conversion_tracking_position' => array(
				'name' => __( 'Code position', 'woocommerce-settings-tab-woosale-converter' ),
				'type' => 'select',
				'options' => array(
				'head' => __( 'Inside HEAD tag', 'woocommerce-settings-tab-woosale-converter' ),
				'footer' => __( 'In page footer', 'woocommerce-settings-tab-woosale-converter' ),
				),
				'desc' => __( 'Select where you want your code inserted', 'woocommerce-settings-tab-woosale-converter' ),
				'id' => 'GiWOO_ws_conversion_tracking_position'
				),*/
				"free_content_1" => array(
					'type' => 'free_content',
					'content' => "<h3>Shopping cart page script</h3>",
				),

				'ws_conversion_tracking_shopping_cart_h' => array(
					'name' => __( 'Header script', 'woocommerce-settings-tab-woosale-converter' ),
					'type' => 'textarea',
					'std' => '',
					'css' => 'width: 90%; height: 100px',
					'id' => 'GiWOO_ws_conversion_tracking_shopping_cart_h'
				),
				'ws_conversion_tracking_shopping_cart_f' => array(
					'name' => __( 'Footer script', 'woocommerce-settings-tab-woosale-converter' ),
					'type' => 'textarea',
					'std' => '',
					'css' => 'width: 90%; height: 100px',
					'id' => 'GiWOO_ws_conversion_tracking_shopping_cart_f'
				),

				"free_content_2_b" => array(
					'type' => 'free_content',
					'content' => "<br><h3>Checkout page script</h3>",
				),
				'ws_conversion_tracking_checkout_h' => array(
					'name' => __( 'Header script', 'woocommerce-settings-tab-woosale-converter' ),
					'type' => 'textarea',
					'css' => 'width: 90%; height: 100px',
					'id' => 'GiWOO_ws_conversion_tracking_checkout_h'
				),
				'ws_conversion_tracking_checkout_f' => array(
					'name' => __( 'Footer script', 'woocommerce-settings-tab-woosale-converter' ),
					'type' => 'textarea',
					'css' => 'width: 90%; height: 100px',
					'id' => 'GiWOO_ws_conversion_tracking_checkout_f'
				),

				"free_content_3" => array(
					'type' => 'free_content',
					'content' => "<br><h3>Thank you page (After a sale has taken place)</h3>",
				),
				'ws_conversion_tracking_thank_you_h' => array(
					'name' => __( 'Header script', 'woocommerce-settings-tab-woosale-converter' ),
					'type' => 'textarea',
					'css' => 'width: 90%; height: 100px',
					'id' => 'GiWOO_ws_conversion_tracking_thank_you_h'
				),
				'ws_conversion_tracking_thank_you_f' => array(
					'name' => __( 'Footer script', 'woocommerce-settings-tab-woosale-converter' ),
					'type' => 'textarea',
					'css' => 'width: 90%; height: 100px',
					'id' => 'GiWOO_ws_conversion_tracking_thank_you_f'
				),

				'section_end_6' => array(
					'type' => 'sectionend',
					'id' => 'GiWOO_WooSales_Converter_section_end_6'
				),

			);

			return apply_filters( 'GiWOO_Conversion_Tracking_settings', $settings );
		}

	}

	GiWOO_Conversion_Tracking::init();









	if($_GET['tab'] == 'settings_tab_conversion_tracking'){
		add_filter('wp_kses_allowed_html', 'filter_GiWOO_ws_conversion_tracking_shopping_cart', 10, 1);
		function filter_GiWOO_ws_conversion_tracking_shopping_cart($allowedposttags){
			$allowedposttags['script'] = array(
			'type' => true,
			'language' => true,
			'id' => true,
			'src' => true,
			);
			$allowedposttags['input'] = array(
			'name' => true,
			'class' => true,
			'id' => true,
			'type' => true,
			'value' => true,
			);
			return $allowedposttags;
		}
	}

	add_action('admin_menu', 'WooSales_Converter_menus', 60);
	function WooSales_Converter_menus(){
		add_submenu_page( 'woocommerce', 'WooSales Converter Settings',  'WooSales Settings', 'manage_woocommerce', 'admin.php?page=wc-settings&tab=settings_tab_woosales_converter', '' );
	}

	add_action('admin_menu', 'WooSales_conversion_tracking_menus', 60);
	function WooSales_conversion_tracking_menus(){
		add_submenu_page( 'woocommerce', 'Conversion tracking Settings',  'Conversion tracking', 'manage_woocommerce', 'admin.php?page=wc-settings&tab=settings_tab_conversion_tracking', '' );
	}




	function my_custom_admin_head(){
		if($_GET['tab'] == 'settings_tab_woosales_converter'){
		?>
		<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery('a').removeClass('current');
				jQuery('li').removeClass('current');
				jQuery('ul.wp-submenu li a[href$="settings_tab_woosales_converter"]').addClass('current').parent().addClass('current');
			})
		</script>
		<style type="text/css">
			.woocommerce #mainform h3:last-child {
				margin-top: 64px;
			}
		</style>
		<?php
		}elseif($_GET['tab'] == 'settings_tab_conversion_tracking'){
		?>
		<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery('a').removeClass('current');
				jQuery('li').removeClass('current');
				jQuery('ul.wp-submenu li a[href$="settings_tab_conversion_tracking"]').addClass('current').parent().addClass('current');
			})
		</script>
		<?php
		}
	}
	add_action('admin_head', 'my_custom_admin_head');




	function GiWOO_upload_field($value){

		$option_value 	= WC_Admin_Settings::get_option( $value['id'], $value['default'] );

		wp_enqueue_media();

		if(esc_attr( $option_value )){
			$img_src = $option_value;
		}elseif( $value['default_file']){
			$img_src = $value['default_file'];
		}else{
			$img_src = false;
		}

	?><tr valign="top">
		<th scope="row" class="titledesc">
			<label for="<?php echo esc_attr( $value['id'] ); ?>"><?php echo esc_html( $value['title'] ); ?></label>
			<?php echo $tip; ?>
		</th>
		<td class="forminp forminp-<?php echo sanitize_title( $value['type'] ) ?>">
			<input
				data-upload="upload_image"
				name="<?php echo esc_attr( $value['id'] ); ?>"
				id="<?php echo esc_attr( $value['id'] ); ?>"
				type="text"
				style="<?php echo esc_attr( $value['css'] ); ?>"
				value="<?php echo esc_attr( $option_value ); ?>"
				class="<?php echo esc_attr( $value['class'] ); ?>"
				<?php if(is_array($custom_attributes)){ echo implode( ' ', $custom_attributes ); } ?>
				/>
			<button id="<?php echo esc_attr( $value['id'] ); ?>_button">Select Image</button>
			<?php echo $description; ?>
			<?php if($img_src){ ?>
				<br><img style="max-width: 250px; height: auto" src='<?php echo $img_src; ?>'>
				<?php } ?>

		</td>
	</tr>
	<script type="text/javascript">
		jQuery(document).ready(function($){

			var custom_uploader;

			$('#<?php echo esc_attr( $value['id'] ); ?>_button').click(function(e) {

				e.preventDefault();

				//If the uploader object has already been created, reopen the dialog
				if (custom_uploader) {
					custom_uploader.open();
					return;
				}

				//Extend the wp.media object
				custom_uploader = wp.media.frames.file_frame = wp.media({
					title: 'Choose Image',
					button: {
						text: 'Choose Image'
					},
					multiple: false
				});

				//When a file is selected, grab the URL and set it as the text field's value
				custom_uploader.on('select', function() {
					attachment = custom_uploader.state().get('selection').first().toJSON();
					$('#<?php echo esc_attr( $value['id'] ); ?>').val(attachment.url);
				});

				//Open the uploader dialog
				custom_uploader.open();

			});


		});
	</script>
	<?php
	}
	add_action('woocommerce_admin_field_upload', 'GiWOO_upload_field', 10, 2);


	function GiWOO_free_content_field($value){
	?>
	<tr valign="top">
		<th scope="row" class="titledesc" colspan="2">
			<?php echo $value['content']; ?>
		</th>
	</tr>
	<?php
	}
	add_action('woocommerce_admin_field_free_content', 'GiWOO_free_content_field', 10, 2);


	function GiWOO_free_content_field_2($value){
	?>
	<tr valign="top">
		<th scope="row" class="titledesc">
			<?php echo $value['content_th']; ?>
		</th>
		<td><?php echo $value['content_td']; ?></td>
	</tr>
	<?php
	}
	add_action('woocommerce_admin_field_free_content_2', 'GiWOO_free_content_field_2', 10, 2);


	function GiWOO_WooSales_Converter_header_action(){
		global $wp_query;
		if(get_option('GiWOO_ws_conversion_tracking_shopping_cart_h')
		and $wp_query->post->ID == get_option('woocommerce_cart_page_id')){

			echo get_option('GiWOO_ws_conversion_tracking_shopping_cart_h'); // DSIPLAY HEADER TRACKING ON SHOPPING CART

		}elseif(get_option('GiWOO_ws_conversion_tracking_thank_you_h')
		and $wp_query->post->ID == get_option('woocommerce_checkout_page_id')
		and get_query_var('order-received') > 0
		){
			echo get_option('GiWOO_ws_conversion_tracking_thank_you_h'); // DSIPLAY HEADER TRACKING ON CHECKOUT

		}elseif(get_option('GiWOO_ws_conversion_tracking_checkout_h')
		and $wp_query->post->ID == get_option('woocommerce_checkout_page_id')){

			echo get_option('GiWOO_ws_conversion_tracking_checkout_h'); // DSIPLAY HEADER TRACKING ON CHECKOUT

		}

	?>
	<style type="text/css">
		<?php if(get_option('GiWOO_button_enable_app') == 'yes'){ ?>

			.woocommerce-page .products .add_to_cart_button {
				<?php echo get_option('GiWOO_button_style_app'); ?>
			}
			.woocommerce-page .products .add_to_cart_button:hover {
				<?php echo get_option('GiWOO_button_style_app_hover'); ?>
			}

			<?php } ?>
		<?php if(get_option('GiWOO_button_enable_spp') == 'yes'){ ?>

			.woocommerce-page .cart button.single_add_to_cart_button.alt {
				<?php echo get_option('GiWOO_button_style_spp'); ?>
			}
			.woocommerce-page .cart button.single_add_to_cart_button.alt:hover {
				<?php echo get_option('GiWOO_button_style_spp_hover'); ?>
			}

			<?php } ?>
		<?php if(get_option('GiWOO_enable_bnb') == 'yes'){ ?>

			/*.woocommerce-page .products .add_to_cart_button.buy_now_button,*/
			.woocommerce-page .cart button.single_add_to_cart_button.alt.buy_now_button {
				<?php echo get_option('GiWOO_button_style_bnb'); ?>
			}
			/*.woocommerce-page .products .add_to_cart_button.buy_now_button:hover,*/
			.woocommerce-page .cart button.single_add_to_cart_button.alt.buy_now_button:hover {
				<?php echo get_option('GiWOO_button_style_bnb_hover'); ?>
			}

			<?php } ?>

		<?php if(get_option('GiWOO_enable_bnb_a') == 'yes'){ ?>

			.woocommerce-page .products .add_to_cart_button.buy_now_button {
				<?php echo get_option('GiWOO_button_style_bnb_a'); ?>
			}
			.woocommerce-page .products .add_to_cart_button.buy_now_button:hover {
				<?php echo get_option('GiWOO_button_style_bnb_a_hover'); ?>
			}

			<?php } ?>
	</style>
	<?php


	}
	add_action('wp_head', 'GiWOO_WooSales_Converter_header_action', 99);



	if(get_option('GiWOO_ws_conversion_tracking_position') == 'footer'){
		function GiWOO_WooSales_Converter_footer_action(){
			global $wp_query;
			if(get_option('GiWOO_ws_conversion_tracking_shopping_cart_f')
			and $wp_query->post->ID == get_option('woocommerce_cart_page_id')){

				echo get_option('GiWOO_ws_conversion_tracking_shopping_cart_f'); // DSIPLAY HEADER TRACKING ON SHOPPING CART

			}elseif(get_option('GiWOO_ws_conversion_tracking_thank_you_f')
			and $wp_query->post->ID == get_option('woocommerce_checkout_page_id')
			and get_query_var('order-received') > 0
			){
				echo get_option('GiWOO_ws_conversion_tracking_thank_you_f'); // DSIPLAY HEADER TRACKING ON CHECKOUT

			}elseif(get_option('GiWOO_ws_conversion_tracking_checkout_f')
			and $wp_query->post->ID == get_option('woocommerce_checkout_page_id')){

				echo get_option('GiWOO_ws_conversion_tracking_checkout_f'); // DSIPLAY HEADER TRACKING ON CHECKOUT

			}
		}
		add_action('wp_footer', 'GiWOO_WooSales_Converter_footer_action', 99);
	}

	/* REDIRECT TO CHECKOUT PAGE */
	if(get_option('GiWOO_direct_checkout_enable') == 'yes' or $_REQUEST['direct_buy'] == 1){
		function custom_add_to_cart_redirect() {
			return get_permalink(get_option('woocommerce_checkout_page_id')); // Replace with the url of your choosing
		}
		add_filter('add_to_cart_redirect', 'custom_add_to_cart_redirect');
	}





	/*** CHANGE CART BUTTON ON SINGLE PRODUCT PAGE ************************/

	if(strlen(get_option('GiWOO_button_name_spp')) > 0 and get_option('GiWOO_button_enable_spp') == 'yes'){
		add_filter( 'add_to_cart_text', 'woo_custom_cart_button_text' ); // < 2.1
		add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text' ); // 2.1 +
		function woo_custom_cart_button_text($content) {
			return get_option('GiWOO_button_name_spp');
		}
	}

	/***END CHANGE CART BUTTON ON SINGLE PRODUCT PAGE *********************/



	/*** CHANGE CART BUTTON ON SINGLE PRODUCT PAGE ************************/

	if(strlen(get_option('GiWOO_button_name_app')) > 0 and get_option('GiWOO_button_enable_app') == 'yes'){
		add_filter( 'add_to_cart_text', 'woo_archive_custom_cart_button_text' ); // < 2.1
		add_filter( 'woocommerce_product_add_to_cart_text', 'woo_archive_custom_cart_button_text' ); // 2.1 +
		function woo_archive_custom_cart_button_text() {
			return get_option('GiWOO_button_name_app');
		}
	}
	/***END CHANGE CART BUTTON ON SINGLE PRODUCT PAGE *********************/



	/*** GiWOO_enable_bnb *************************/

	if(get_option('GiWOO_enable_bnb_a') == 'yes'){
		function woo_add_extra_buy_now_button($val){

			global $product;


			$val .=  sprintf( ' <a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="button %s product_type_%s buy_now_button">%s</a>',
				esc_url( $product->add_to_cart_url() . '&direct_buy=1' ),
				esc_attr( $product->id ),
				esc_attr( $product->get_sku() ),
				esc_attr( isset( $quantity ) ? $quantity : 1 ),
				$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
				esc_attr( $product->product_type ),
				esc_html( get_option('GiWOO_button_name_bnb_a') )
			);
			return $val;
		}
		add_filter( 'woocommerce_loop_add_to_cart_link', 'woo_add_extra_buy_now_button' ); 
	}


	if(get_option('GiWOO_enable_bnb') == 'yes'){
		function woo_add_extra_buy_now_button_sp(){
			global $product;
		?>
		<input type="hidden" id="direct_buy_hf" name="direct_buy" value="0">
		<button type="submit" class="single_add_to_cart_button button alt buy_now_button" onclick="jQuery('#direct_buy_hf').val(1)"><?php echo get_option('GiWOO_button_name_bnb'); ?></button>
		<?php
			return true;
		}
		add_action( 'woocommerce_after_add_to_cart_button', 'woo_add_extra_buy_now_button_sp' ); 
	}



	if(get_option('GiWOO_enable_secure_checkout_image') == 'yes' or get_option('GiWOO_enable_satisfaction_guarantee') == 'yes'){

		function woo_checkout_images(){
		?>
		<div class="checkout_page_footer">
			<?php if(get_option('GiWOO_enable_secure_checkout_image') == 'yes'){
					if(get_option('GiWOO_image_secure_checkout_image')){
						$img_src = get_option('GiWOO_image_secure_checkout_image');
					}else{
						$img_src = plugins_url( 'images/secure-checkout.png', __FILE__ );
					}
				?>
				<img src="<?php echo $img_src; ?>" alt="Secure checkout">
				<?php } ?>
			<?php if(get_option('GiWOO_enable_satisfaction_guarantee') == 'yes'){
					if(get_option('GiWOO_image_satisfaction_guarantee')){
						$img_src = get_option('GiWOO_image_satisfaction_guarantee');
					}else{
						$img_src = plugins_url( 'images/satisfaction-guarantee.png', __FILE__ );
					}
				?>
				<img src="<?php echo $img_src; ?>" alt="Secure checkout">
				<?php } ?>
		</div>
		<?php
		}
		add_action('woocommerce_after_checkout_form', 'woo_checkout_images');
	}



	if(get_option('GiWOO_direct_checkout_enable') == 'yes'){
		function GiWoo_check_direct_checkout_enable(){
			update_option('woocommerce_enable_ajax_add_to_cart', 'no');
		}
		add_action('woocommerce_settings_saved', GiWoo_check_direct_checkout_enable);
	}





	/*function echo_or_eval($val){
	$val = trim($val);
	if(substr($val, 0, 5) = '<?php' and substr($val, -2) = '?>'){
	eval(substr($val, 5, -2));
	}elseif(substr($val, 0, 2) = '<?' and substr($val, -2) = '?>'){
	eval(substr($val, 2, -2));
	}else{
	echo $val;
	}
}*/
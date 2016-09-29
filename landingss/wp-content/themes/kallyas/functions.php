<?php
//<editor-fold desc=">>> IMPORTANT. READ ME.">
	// This is the main file for this theme. This file is automatically loaded by WordPress when the
	// theme is active. Normally, you should never edit this file as it will be overridden by future updates.
	// All changes should be implemented in the child theme's functions.php file.
//</editor-fold desc=">>> IMPORTANT. READ ME.">


//<editor-fold desc=">>> CONSTANTS">

/*** INCLUDE THE NEW FRAMEWORK **/
global $zn_config;
require get_template_directory().'/framework/zn-framework.php'; // FRAMEWORK FILE

	/**
	 * Theme's constants
	 */
	define( 'OPTIONS', 'zn_kallyas_options' );

//</editor-fold desc=">>> CONSTANTS">


//<editor-fold desc=">>> GLOBAL VARIABLES">

/**
 * Set the content width.
 * @global
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1170;
}

//</editor-fold desc=">>> GLOBAL VARIABLES">


//<editor-fold desc=">>> LOAD CUSTOM CLASSES & WIDGETS & HOOKS">

	// Load helper functions
	include( THEME_BASE . '/wpk/function-vt-resize.php' );

	locate_template('wpk/wpk-functions.php', true, true); // can bo overridden in child themes
	include( THEME_BASE . '/wpk/WpkPageHelper.php' );
	include( THEME_BASE . '/wpk/wpk-notifications/wpk-notifications.php' );
	locate_template('theme-functions-override.php', true, true ); // can be overridden in child themes

	// Load Widgets
	include( THEME_BASE . '/template_helpers/widgets/widget-blog-categories.php' );
	include( THEME_BASE . '/template_helpers/widgets/widget-archive.php' );
	include( THEME_BASE . '/template_helpers/widgets/widget-menu.php' );
	include( THEME_BASE . '/template_helpers/widgets/widget-twitter.php');
	include( THEME_BASE . '/template_helpers/widgets/widget-contact-details.php' );
	include( THEME_BASE . '/template_helpers/widgets/widget-mailchimp.php' );
	include( THEME_BASE . '/template_helpers/widgets/widget-tag-cloud.php' );
	include( THEME_BASE . '/template_helpers/widgets/widget-latest_posts.php' );
	include( THEME_BASE . '/template_helpers/widgets/widget-social_buttons.php' );
	include( THEME_BASE . '/template_helpers/widgets/widget-flickr.php' );

	// Load shortcodes
	include( THEME_BASE . '/template_helpers/shortcodes/shortcodes.php' );

	// Actions
	locate_template('th-action-hooks.php', true, true);

	// Filters
	locate_template('th-filter-hooks.php', true, true);

	// Custom Hooks
	locate_template('th-custom-hooks.php', true, true);

//</editor-fold desc=">>> LOAD CUSTOM CLASSES & WIDGETS & HOOKS">


/**
 * Adjust content width
 * @uses global $content_width
 */
if ( ! isset( $content_width ) ) {
	$content_width = zget_option( 'zn_width', 'layout_options', false, '1170' );
}


/* TO BE MOVED ELSEWHERE */
function zn_get_sidebar_class( $type , $sidebar_pos = false ) {

	if ( !$sidebar_pos ){
		$sidebar_pos = get_post_meta( zn_get_the_id(), 'zn_page_layout', true );
	}

	if ( $sidebar_pos === 'default' || ! $sidebar_pos ) {
		$sidebar_data = zget_option( $type, 'unlimited_sidebars' , false , array('layout' => 'right_sidebar' , 'sidebar' => 'defaultsidebar' ) );
		$sidebar_pos = $sidebar_data['layout'];
	}

	if ( $sidebar_pos !== 'no_sidebar' ) {
		$sidebar_pos .= ' col-md-9 ';
	}
	else{
		$sidebar_pos = 'col-md-12';
	}

	return $sidebar_pos;
}

/*** JUST FOR DEBUGGING ***/
//add_action( 'admin_bar_menu', 'zn_show_convert_button', 999 );
//function zn_show_convert_button( $wp_admin_bar ){
//    /** @var $wp_admin_bar WP_Admin_Bar */
//	if ( is_singular() ) {
//		global $post;
//		$args = array(
//			'id'    => 'zn_edit_button_run_convert',
//			'title' => 'Run FULL CONVERT',
//			'href'  => add_query_arg( array('zn_run_convert' => true ), get_permalink( $post->ID ) ),
//			'meta'  => array( 'class' => 'zn_edit_button' )
//		);
//		$wp_admin_bar->add_node( $args );
//	}
//}
//add_action( 'init', 'zn_force_run_convert' );
//function zn_force_run_convert(){
//	if( isset( $_GET['zn_run_convert'] ) ){
//
//		// include necessary files
//		include( FW_PATH .'/classes/functions-backend.php' );
//		include( FW_PATH .'/classes/class-theme-setup.php' );
//		include( FW_PATH .'/classes/class-metaboxes.php' );
//
//		ZN()->theme_options = new Zn_Theme_Setup();
//		ZN()->metabox = new ZnMetabox();
//
//
//		// Setup variables
//		$theme_name = 'zn_'.ZN()->theme_data['theme_id'];
//		$theme_db_version = $theme_name.'_db_version';
//		$theme_version = ZN()->version;
//
//
//
//		$update_config = THEME_BASE .'/template_helpers/update/update_config.php';
//		if( file_exists($update_config) ){
//			require( $update_config );
//		}
//		else{
//			return false;
//		}
//
//		$current_db_version = '3.6.9';
//		$db_updates         = apply_filters( 'zn_theme_update_scripts', array() );
//
//		foreach ( $db_updates as $version => $updater ) {
//
//			if ( version_compare( $current_db_version, $version, '<' ) ) {
//				include( $updater['file'] );
//
//				zn_cnv_v4_convert_theme_options();
//				zn_cnv_remove_comments_options();
//				$posts_data = zn_cnv_v4_get_posts_to_convert( 0, 100000 );
//				zn_cnv_v4_convert_pb_data( false, $posts_data );
//
//				zn_cnv_v4_convert_widgets();
//
//				// Set the DB version to the current script - in case of errors, the updater will continue from the last script version
//				delete_option( $theme_db_version );
//				add_option( $theme_db_version, $version );
//			}
//		}
//
//		// Set the DB version to the current theme installed
//		delete_option( $theme_db_version );
//		add_option( $theme_db_version, $theme_version );
//	}
//	// zn_run_convert
//    return false;
//}

/** ADD PB ELEMENTS TO EMPTY PAGES  */
add_filter( 'znpb_empty_page_layout', 'znpb_add_kallyas_template', 10, 3 );
function znpb_add_kallyas_template( $current_layout, $post, $post_id ){
	// We will add the new elements here
	$textbox    = ZNPB()->add_module_to_layout( 'TH_TextBox', array( 'stb_title' => $post->post_title, 'stb_content' => $post->post_content ) );
	$column     = ZNPB()->add_module_to_layout( 'ZnColumn',  array() , array( $textbox ), 'col-sm-12' );
	$sections    = array( ZNPB()->add_module_to_layout( 'ZnSection', array() , array( $column ), 'col-sm-12' ) );

	return $sections;
}

if ( !session_id() )
	session_start();

add_action( 'init', 'ajaxSSL_func' );
function ajaxSSL_func(){
	
	global $woocommerce;
	global $post;

	// if(!is_admin() && $post->ID != 2300){
	// 	$quantity = $_REQUEST['billing_quantity'];
	// 	// get first item in cart dict
	// 	$array = WC()->cart->get_cart();
	// 	$cart_item_key = reset($array);

	// 	WC()->cart->set_quantity( $cart_item_key, $quantity, false );
	// }

	if(!is_admin() && $post->ID == 2300){
		if(isset($_SESSION['landing_data']) && sizeof($_SESSION['landing_data']) > 0){
			if(WC()->cart->get_cart_contents_count() == 0){
				$woocommerce->cart->add_to_cart(2300);
				
			}
		}
	}
	
	if(isset($_REQUEST['action']) && $_REQUEST['action'] == "submitlandingpage001"){
		//global $woocommerce;
		//$woocommerce->cart->add_to_cart(2300);
		$_SESSION['landing_data']=$_REQUEST;
		
		$my_post = array(
			'post_title'    => wp_strip_all_tags( "User Data ( ".$_REQUEST['fname'] . " " .$_REQUEST['lname']." ) " ),
			'post_content'  => "",
			'post_type'		=>'userdata',
			'post_status'   => 'publish'
		);
		$post_id = wp_insert_post( $my_post );
		
		update_post_meta($post_id,"fname",$_REQUEST['fname']);
		update_post_meta($post_id,"lname",$_REQUEST['lname']);
		update_post_meta($post_id,"address",$_REQUEST['address']);
		update_post_meta($post_id,"state",$_REQUEST['state']);
		update_post_meta($post_id,"city",$_REQUEST['city']);
		update_post_meta($post_id,"zip",$_REQUEST['zip']);
		update_post_meta($post_id,"phone",$_REQUEST['phone']);
		update_post_meta($post_id,"email",$_REQUEST['email']);
		
		header('Content-type: application/json');
		echo $_GET['jsoncallback'] . '(' . json_encode($data) . ');';	
		die();
	}
}

add_filter( 'default_checkout_state', 'change_default_checkout_state' );
add_filter( 'default_checkout_postcode', 'change_default_checkout_postcode' );

function change_default_checkout_state() {
	session_start();
	$landing_data=array();
	if(isset($_SESSION['landing_data']) && sizeof($_SESSION['landing_data']) > 0){	
		$landing_data = $_SESSION['landing_data'];
		$state=$landing_data['state'];
 		 return $state; // state code
	}
	return "";
}

function change_default_checkout_postcode(){
	session_start();
	$landing_data=array();
	if(isset($_SESSION['landing_data']) && sizeof($_SESSION['landing_data']) > 0){	
		$landing_data = $_SESSION['landing_data'];
		$zip=$landing_data['zip'];
 		 return $zip; // state code
	}
	return "";
}


add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
function custom_override_checkout_fields( $fields ) {
	$current_user = wp_get_current_user();
	global $woocommerce;
	session_start();
	$landing_data=array();
	if(isset($_SESSION['landing_data']) && sizeof($_SESSION['landing_data']) > 0){	
		$landing_data = $_SESSION['landing_data'];
		$fname=$landing_data['fname'];
		$lname=$landing_data['lname'];
		$address=$landing_data['address'];
		$state=$landing_data['state'];
		$city=$landing_data['city'];
		$zip=$landing_data['zip'];
		$phone=$landing_data['phone'];
		$email=$landing_data['email'];


	
		if ( 0 != $current_user->ID ) {
			update_user_meta($current_user->ID,"billing_first_name",$fname);
			update_user_meta($current_user->ID,"billing_last_name",$lname);
			update_user_meta($current_user->ID,"billing_phone",$phone);
			update_user_meta($current_user->ID,"billing_email",$email);
			update_user_meta($current_user->ID,"billing_address_1",$address);
			update_user_meta($current_user->ID,"billing_city",$city);
			update_user_meta($current_user->ID,"billing_state",$state);
			update_user_meta($current_user->ID,"billing_postcode",$zip);

		}else{
			 $fields['billing']['billing_first_name']['default'] = $fname;
			 $fields['billing']['billing_last_name']['default'] = $lname;
			 $fields['billing']['billing_phone']['default'] = $phone;
			 $fields['billing']['billing_email']['default'] = $email;
			 $fields['billing']['billing_address_1']['default'] = $address;
			 $fields['billing']['billing_city']['default'] = $city;		
		}
		
		
	}
	
	return $fields;
}
	
function wpchris_filter_gateways( $gateways ){

        global $woocommerce;

        foreach ($gateways as $gateway) {
            $gateway->chosen = 1;
        }

    return $gateways;
}
add_filter( 'woocommerce_available_payment_gateways', 'wpchris_filter_gateways', 1);



//add_action("th_display_site_header","lv_display_site_header");
function lv_display_site_header(){
	global $post;
	if(is_single() &&  $post->ID == 2300){
		?>
        	<style>
			.page_banner {
    margin-top: 105px;
}
			</style>
        <div class="page_banner">
        	<div class="container">
            	<div class="row">
            		<div class="col-md-12">
                    
        	<img src="<?php echo site_url();?>/wp-content/uploads/2016/07/checkout-header-1.jpg" />
            <p style="display: block; text-align: center; margin: 25px 0px 0px; font-size: 24px;">You get 6 teeth whitening pens and bonus blue light whitening booster.</p>
            		</div>
            	</div>
            </div>
        </div>
        <style>
		.site-content.shop_page{ margin-top:15px;}
		</style>
        <?php	
	}
}

function my_styles_method() {
	if(isset($_SESSION['landing_data']) && sizeof($_SESSION['landing_data']) > 0){	
        $custom_css = "<style>
                form.checkout #customer_details,
				form.checkout  #order_review_heading,
				.woocommerce-checkout-review-order-table{
                       display:none;
                }</style>";
        echo $custom_css;
	}
}
add_action( 'wp_head', 'my_styles_method' );


function lv_form( $atts ) {
	$atts = shortcode_atts( array(
		'foo' => 'no foo',
		'baz' => 'default baz'
	), $atts, 'bartag' );
	ob_start();
	?>
    <div class="lv_form_wrap">
            <form method="post" action="" id="lv_form">
            	<div class="lv_form form01	shadow01 ">
                            <span class="sprite legend minitablet"><span class="big">Tell us where to ship</span> Your Package</span>
                            <div class="form-container">
                                <div class="field">
                                    <input class="form-control placeholder required" id="fields_fname" placeholder="First Name" type="text" name="fname"> <i class="fa fa-user"></i> 
                                </div>
                                <div class="field">
                                    <input class="form-control placeholder required" id="fields_lname" placeholder="Last Name" type="text" name="lname"> <i class="fa fa-user"></i>
                                </div>
                                <div class="field">
                                    <input class="form-control placeholder required" id="fields_address1" placeholder="Address" type="text" name="address"> <i class="fa fa-building-o"></i>
                                </div>
                                <div class="field">
                                    <input class="form-control placeholder required" id="fields_city" placeholder="City" type="text" name="city"> <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="field">
                                    <select class="form-control placeholder required" name="state" id="fields_state" placeholder="State"><option value="">Select state</option><option value="AL">Alabama</option><option value="AK">Alaska</option><option value="AZ">Arizona</option><option value="AR">Arkansas</option><option value="CA">California</option><option value="CO">Colorado</option><option value="CT">Connecticut</option><option value="DE">Delaware</option><option value="DC">District Of Columbia</option><option value="FL">Florida</option><option value="GA">Georgia</option><option value="HI">Hawaii</option><option value="ID">Idaho</option><option value="IL">Illinois</option><option value="IN">Indiana</option><option value="IA">Iowa</option><option value="KS">Kansas</option><option value="KY">Kentucky</option><option value="LA">Louisiana</option><option value="ME">Maine</option><option value="MD">Maryland</option><option value="MA">Massachusetts</option><option value="MI">Michigan</option><option value="MN">Minnesota</option><option value="MS">Mississippi</option><option value="MO">Missouri</option><option value="MT">Montana</option><option value="NE">Nebraska</option><option value="NV">Nevada</option><option value="NH">New Hampshire</option><option value="NJ">New Jersey</option><option value="NM">New Mexico</option><option value="NY">New York</option><option value="NC">North Carolina</option><option value="ND">North Dakota</option><option value="OH">Ohio</option><option value="OK">Oklahoma</option><option value="OR">Oregon</option><option value="PA">Pennsylvania</option><option value="RI">Rhode Island</option><option value="SC">South Carolina</option><option value="SD">South Dakota</option><option value="TN">Tennessee</option><option value="TX">Texas</option><option value="UT">Utah</option><option value="VT">Vermont</option><option value="VA">Virginia</option><option value="WA">Washington</option><option value="WV">West Virginia</option><option value="WI">Wisconsin</option><option value="WY">Wyoming</option><option value="AA">Armed Forces (AA)</option><option value="AE">Armed Forces (AE)</option><option value="AP">Armed Forces (AP)</option><option value="AS">American Samoa</option><option value="GU">Guam</option><option value="MP">Northern Mariana Islands</option><option value="PR">Puerto Rico</option><option value="UM">US Minor Outlying Islands</option><option value="VI">US Virgin Islands</option></select>
                                </div>

                                <div class="field">
                                    <input class="form-control placeholder required_num" id="fields_zip" placeholder="Zip/Postal Code" type="text" inputmode="numeric" name="zip" /> <i class="fa fa-fax"></i>
                                </div>
                                <div class="field">
                                    <input class="form-control placeholder required_num" id="fields_phone" placeholder="Phone" type="text" inputmode="numeric" name="phone" > <i class="fa fa-phone"></i>
                                </div>
                                <div class="field">
                                    <input class="form-control placeholder required_email email" id="fields_email" placeholder="Email" type="text" name="email"> <i class="fa fa-envelope"></i>
                                </div><button class="button cta aligncenter" title="Rush My Order!" type="submit"><span>Rush My Order!</span></button><br>
                            </div>
                        </div>            
            </form>
            </div>
    <?php
	$output=ob_get_clean();
	return $output;
}
add_shortcode( 'lv_form', 'lv_form' );

function lv_codex_custom_init() {
    $args = array(
      'public' => true,
      'label'  => 'User Data',
	  'publicly_queryable' => false,
	  'capability_type'    => 'post',
	  'supports' => array('title')
    );
    register_post_type( 'userdata', $args );
}
add_action( 'init', 'lv_codex_custom_init' );

function disable_new_posts() {
// Hide sidebar link
global $submenu;
unset($submenu['edit.php?post_type=userdata'][10]);

// Hide link on listing page
if (isset($_GET['post_type']) && $_GET['post_type'] == 'userdata') {
    echo '<style type="text/css">
    #favorite-actions, .add-new-h2, .tablenav, a.page-title-action { display:none; }
    </style>';
}
}
add_action('admin_menu', 'disable_new_posts');

function lv_wpdocs_register_meta_boxes() {
    add_meta_box( 'meta-box-id', __( 'User Details', 'textdomain' ), 'lv_wpdocs_my_display_callback', 'userdata' );
}
add_action( 'add_meta_boxes', 'lv_wpdocs_register_meta_boxes' );
function lv_wpdocs_my_display_callback( $post ){
	$fname = get_post_meta($post->ID,"fname",true);
	$lname = get_post_meta($post->ID,"lname",true);
	$address = get_post_meta($post->ID,"address",true);
	$state = get_post_meta($post->ID,"state",true);
	$city = get_post_meta($post->ID,"city",true);
	$zip = get_post_meta($post->ID,"zip",true);
	$phone = get_post_meta($post->ID,"phone",true);
	$email = get_post_meta($post->ID,"email",true);

	
	?>
    <table width="100%" border="1" cellspacing="0" cellpadding="10">
  <tr>
    <td>First Name</td>
    <td><?php echo $fname;?></td>
  </tr>
  <tr>
    <td>Last Name</td>
    <td><?php echo $lname;?></td>
  </tr>
  <tr>
    <td>Address</td>
    <td><?php echo $address;?></td>
  </tr>
  <tr>
    <td>City</td>
    <td><?php echo $city;?></td>
  </tr>
  <tr>
    <td>State</td>
    <td><?php echo $state;?></td>
  </tr>
  <tr>
    <td>Zip/Postal Code</td>
    <td><?php echo $zip;?></td>
  </tr>
  <tr>
    <td>Phone</td>
    <td><?php echo $phone;?></td>
  </tr>
  <tr>
    <td>Email</td>
    <td><?php echo $email;?></td>
  </tr>
</table>

    <?php
}
add_filter( 'woocommerce_get_settings_general', 'wcslider_all_settings', 10, 2 );
function wcslider_all_settings( $settings, $current_section ) {
		// Add Title to the Settings
		$new_settings=array();
		
		$new_settings[] = array( 'name' => __( '', 'text-domain' ), 'type' => 'title', 'desc' => __( '', 'text-domain' ), 'id' => 'wcslider' );
		// Add first checkbox option
		$new_settings[] = array(
			'name'     => __( 'Enable Pre Checked Option', 'text-domain' ),
			'desc_tip' => __( 'automatically checked terms checkbox in final step', 'text-domain' ),
			'id'       => 'pre_checked',
			'type'     => 'checkbox',
			'css'      => 'min-width:300px;',
			'desc'     => __( 'Enable Pre Checked Option', 'text-domain' ),
		);
		foreach($settings as $v){
			$new_settings[]=$v;	
		}
		
		
		return $new_settings;

}

add_filter('woocommerce_terms_is_checked_default',"lv_woocommerce_terms_is_checked_default",10);
function lv_woocommerce_terms_is_checked_default($terms_is_checked){
	$pre_checked = get_option( 'pre_checked' );
	if($pre_checked == 'yes' ) return true;
	return false;
}
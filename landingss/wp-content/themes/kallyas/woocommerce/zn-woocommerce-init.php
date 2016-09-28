<?php

	/*--------------------------------------------------------------------------------------------------
		REMOVE UNWANTED ACTIONS
	--------------------------------------------------------------------------------------------------*/
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
	remove_action( 'woocommerce_pagination', 'woocommerce_catalog_ordering', 20 );
	remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

	//REMOVE WOOCOMMERCE ACTIONS
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10); // REMOVE SHPO SIDEBAR
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

	// Shop Catalog mode
	if ( zget_option( 'woo_catalog_mode', 'zn_woocommerce_options', false, 'yes' ) == 'yes' ) {
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

		// Add the read more button
		// Fixes #917
		add_action( 'woocommerce_after_shop_loop_item', 'zn_woocommerce_more_info' );
		function zn_woocommerce_more_info(){
			echo '<div class="actions kw-actions">';
				echo '<a class="actions-moreinfo" href="'.get_permalink().'">'. __( "MORE INFO", 'zn_framework' ).'</a>';
			echo '</div>';
		}

	}

	/* Check to see if we are allowed to show the add to cart button for visitors */
	$show_cart_to_visitors = zget_option( 'show_cart_to_visitors', 'zn_woocommerce_options', false, 'yes' );
   if( $show_cart_to_visitors == 'no' && !is_user_logged_in() ){
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
   }

	/* PRODUCT THUMBNAIL IN LOOP */
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
	add_action( 'woocommerce_before_shop_loop_item_title', 'zn_woocommerce_template_loop_product_thumbnail', 10 );

	/*--------------------------------------------------------------------------------------------------
		PRODUCTS PAGE - FILTER IMAGE
	--------------------------------------------------------------------------------------------------*/

	if ( ! function_exists( 'zn_woocommerce_template_loop_product_thumbnail' ) ) {

		function zn_woocommerce_template_loop_product_thumbnail()
		{
			echo zn_woocommerce_get_product_thumbnail();
		}
	}

	if ( ! function_exists( 'zn_woocommerce_get_product_thumbnail' ) ) {

		function zn_woocommerce_get_product_thumbnail( $size = 'shop_catalog', $placeholder_width = 0,
			$placeholder_height = 0 )
		{
			global $post, $product, $woocommerce;

			// Enable Lazy Load
			$lazyload = zget_option( 'woo_img_lazyload', 'zn_woocommerce_options', false, 'no' );

			if ( ! $placeholder_width ) {
				if ( function_exists( 'wc_get_image_size' ) ) {
					$placeholder_width = wc_get_image_size( 'shop_catalog_image_width' );
				}
				else {
					$placeholder_width = $woocommerce->get_image_size( 'shop_catalog_image_width' );
				}
			}
			if ( ! $placeholder_height ) {
				if ( function_exists( 'wc_get_image_size' ) ) {
					$placeholder_height = wc_get_image_size( 'shop_catalog_image_height' );
				}
				else {
					$placeholder_height = $woocommerce->get_image_size( 'shop_catalog_image_height' );
				}
			}

			$output = '<span class="image kw-prodimage">';

			$img2 = '';
			$woo_cat_image_size = zget_option( 'woo_cat_image_size', 'zn_woocommerce_options' );

			if ( has_post_thumbnail($post->ID) ) {
				$width  = 0;
				$height = 0;
				if ( ! empty( $woo_cat_image_size ) ) {
					$width  = ( !empty( $woo_cat_image_size['width'] ) ) ? $woo_cat_image_size['width'] : $width;
					$height = ( !empty( $woo_cat_image_size['height'] ) ) ? $woo_cat_image_size['height'] : $height;
				}

				$image = vt_resize( get_post_thumbnail_id( $post->ID ), '', $width, $height, true );
                $imageUrl = $image['url'];
                if(empty($imageUrl)){
                    $img = get_the_post_thumbnail($post->ID, $width, $height, array(
                        'title' => $post->post_title,
                        'alt' => $post->post_title,
                    ));
                }
                else {

                	$src = 'src="' . $imageUrl . '"';

                	// if lazyload enabled, do some fadin'
                	if($lazyload == 'yes'){
                		$src = 'data-src="' . $imageUrl . '"';
                	}

                	$img = '<img class="kw-prodimage-img" '.$src.' alt="'.esc_attr( $post->post_title ).'" title="'.esc_attr( $post->post_title ).'">';

                }

                $img = get_the_post_thumbnail($post->ID, 'shop_catalog', array(
                    'title' => $post->post_title,
                    'alt' => $post->post_title,
                ));

				$use_second_image = zget_option( 'zn_use_second_image', 'zn_woocommerce_options', false, 'yes' ) == 'yes';
                // Add Second image, if any
                $attachment_ids = $product->get_gallery_attachment_ids();
				if ( $attachment_ids && $use_second_image ) {
					$width2  = 0;
					$height2 = 0;
					$secondary_image_id = $attachment_ids['0'];

					if(!empty($secondary_image_id)){

						if ( ! empty( $woo_cat_image_size ) ) {
							$width2  = ( !empty( $woo_cat_image_size['width'] ) ) ? $woo_cat_image_size['width'] : $width;
							$height2 = ( !empty( $woo_cat_image_size['height'] ) ) ? $woo_cat_image_size['height'] : $height;
						}
						$image2 = vt_resize( $secondary_image_id, '', $width2, $height2, true );
						$image2Url = $image2['url'];

						if(!empty($image2Url)){
							$img2 = '<img class="kw-prodimage-img-secondary" src="'.$image2Url.'" alt="'.esc_attr( $post->post_title ).'" title="'.esc_attr( $post->post_title ).'">';
						}
					}

				}
			}
			else {

				$src = 'src="' . wc_placeholder_img_src() . '"';

            	// if lazyload enabled, do some fadin'
            	if($lazyload == 'yes'){
            		$src = 'data-src="' . wc_placeholder_img_src() . '"';
            	}

            	$img = '<img class="kw-prodimage-img kw-prodimage-placeholder" '.$src.' alt="Placeholder" width="' . $placeholder_width['width'] . '" height="' . $placeholder_height['height'] . '">';

			}

            //@k Display item in a link, regardless it has an image or not
            $output .= $img.$img2;

            $output .= '</span>';

			return $output;
		}
	}

	// Check to see if the page has a sidebar or not
	if (!function_exists('zn_check_sidebar')) {
		function zn_check_sidebar() {
			$layout = 'woo_single_sidebar';
			global $zn_config;
			if ( is_single() ) {
				$layout = 'woo_single_sidebar';
			}
			elseif( is_archive() ){
				$layout = 'woo_archive_sidebar';
			}

			$zn_config['force_sidebar'] = $layout;
			$main_class = zn_get_sidebar_class($layout);

			if( strpos( $main_class , 'right_sidebar' ) !== false || strpos( $main_class , 'left_sidebar' ) !== false ) {
				$zn_config['sidebar'] = true;
			} else {
				$zn_config['sidebar'] = false;
			}

			return $zn_config['sidebar'];
		}
	}

	// Change number or products per row to 3 (in case it has a sidebar)
	add_filter('loop_shop_columns', 'zn_woo_loop_columns' , 99);
	if (!function_exists('zn_woo_loop_columns')) {
		function zn_woo_loop_columns() {

			$check_sidebar = zn_check_sidebar();

			// 3 products per row if sidebar active, 4 if not
			return $check_sidebar ? 3 : 4;
		}
	}

	// Change number or related products per row to 3 (in case it has a sidebar)
	add_filter( 'woocommerce_output_related_products_args', 'zn_related_products_args' );
	if (!function_exists('zn_related_products_args')) {
		function zn_related_products_args( $args ) {

			$check_sidebar = zn_check_sidebar();
			$p_nr = $check_sidebar ? 3 : 4;

			$args['posts_per_page'] = $p_nr;
			$args['columns'] = $p_nr;
			return $args;
		}
	}



	/*--------------------------------------------------------------------------------------------------
		FILTER PRODUCT DESCRIPTION
	--------------------------------------------------------------------------------------------------*/
	function woo_short_desc_filter( $content )
	{
		if(!empty($content)){
			$content = '<div class="desc kw-details-desc">'. $content .'</div>';
		}

		return $content;
	}

	add_filter( 'woocommerce_short_description', 'woo_short_desc_filter' );

	/* UPDATE 3.5 */

	/*--------------------------------------------------------------------------------------------------
	REPLACE THE WOOCOMMERCE PAGINATION
	--------------------------------------------------------------------------------------------------*/
	remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );

	function zn_woocommerce_pagination()
	{
//		$pagination_args = array(
//			'previous_text' => __( 'Previous page', 'zn_framework' ),
//			'older_text' => __( 'Next page', 'zn_framework' ),
//		);
		zn_pagination();
	}

	add_action( 'woocommerce_after_shop_loop', 'zn_woocommerce_pagination', 10 );

	/**
	 * Set the number of products to be displayed per page in the shop
	 *
	 * @hooked to add_filter( 'loop_shop_per_page', 'wpkzn_woo_cat_posts_per_page', 100 );
	 * @wpk
	 * @since v3.6.5
	 *
	 * @return int|mixed|void
	 */
	function wpkzn_woo_show_posts_per_page(){
		return zget_option( 'woo_show_products_per_page', 'zn_woocommerce_options', false, get_option('posts_per_page') );
	}

	add_filter( 'loop_shop_per_page', 'wpkzn_woo_show_posts_per_page' );


/** Add specific WOOCOMMERCE OPTIONS **/
require( THEME_BASE.'/woocommerce/woo_options.php' );



/** REPLACE TEMAPLTE FILES WITH ACTIONS **/



add_action( 'woocommerce_before_main_content', 'zn_woocommerce_before_main_content_ss' );
add_action( 'woocommerce_after_main_content', 'zn_woocommerce_after_main_content_ss' );



function zn_woocommerce_before_main_content_75off(){

	// Set the product ID to remove
    $prod_to_remove = 2300;

    // Cycle through each product in the cart
    foreach( WC()->cart->cart_contents as $prod_in_cart ) {
        // Get the Variation or Product ID
        $prod_id = ( isset( $prod_in_cart['variation_id'] ) && $prod_in_cart['variation_id'] != 0 ) ? $prod_in_cart['variation_id'] : $prod_in_cart['product_id'];

        // Check to see if IDs match
        if( $prod_to_remove == $prod_id ) {
            // Get it's unique ID within the Cart
            $prod_unique_id = WC()->cart->generate_cart_id( $prod_id );
            // Remove it from the cart by un-setting it
            unset( WC()->cart->cart_contents[$prod_unique_id] );
        }
    }

	$args = array();
	if( ! is_single() ){

		// SHOW THE HEADER
		$args['title'] = zget_option( 'woo_arch_page_title', 'zn_woocommerce_options' );
		$args['subtitle'] = zget_option( 'woo_arch_page_subtitle', 'zn_woocommerce_options' );
		if( empty( $args['title'] ) ){
			//** Put the header with title and breadcrumb
			$args['title'] = __( 'Shop', 'zn_framework' );
		}

		if( is_shop() ){
			$headerClass = zget_option( 'woo_sub_header', 'zn_woocommerce_options', false, 'zn_def_header_style' );
			if( $headerClass != 'zn_def_header_style' ) {
				$headerClass = 'uh_'.$headerClass;
			}
			$args['headerClass'] = $headerClass;
		}

		if(is_product_category() || is_product_tag())
		{
			global $wp_query;
			$tax = $wp_query->get_queried_object();
			$args['title'] = $tax->name;
			$args['subtitle'] = ''; // Reset the subtitle for categories and tags
		}
	}

	WpkPageHelper::zn_get_subheader( $args );

	// Check to see if the page has a sidebar or not
	global $zn_config;
	$sidebar_pos = false;
	if ( is_single() ) {
		$layout = 'woo_single_sidebar';
	}
	elseif( is_shop() ){
		$sidebar_pos = get_post_meta( get_option( 'woocommerce_shop_page_id' ), 'zn_page_layout', true );
		$zn_config['forced_sidebar_id'] = get_post_meta( get_option( 'woocommerce_shop_page_id' ), 'zn_sidebar_select', true );
		$layout = 'woo_archive_sidebar';
	}
	elseif( is_archive() ){
		$layout = 'woo_archive_sidebar';
	}

	$zn_config['force_sidebar'] = $layout;
	$main_class = zn_get_sidebar_class($layout, $sidebar_pos);
	if( strpos( $main_class , 'right_sidebar' ) !== false || strpos( $main_class , 'left_sidebar' ) !== false ) { $zn_config['sidebar'] = true; } else { $zn_config['sidebar'] = false; }
	$zn_config['size'] = $zn_config['sidebar'] ? 'col-sm-9' : 'col-sm-12';

	global $post;

	?>
	<style type="text/css">
		.product-type-simple { display: none; }
		.elOrderProductOptinProductName { width: 100%; }
		.elOrderProductOptinProductName label { display: inline; }
		.lv_checkout_header { display: none; }
		#customer_details, #order_review_heading, #order_review {height: 0; overflow: hidden;}
		#header {background: #f00; position: static;}
		.elOrderProductOptinProducts label {
		    font-weight: normal;
		}
		.elOrderProductOptinProducts {
		    padding: 5px;
		}
		body {
		    font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
		    font-size: 13px;
		    line-height: 1.7;
		    color: #535353;
		    background-color: #f5f5f5;
		}
		body #page_wrapper, body.boxed #page_wrapper {
    		background-color: transparent !important;
    	}
	</style>
	<section id="content" class="site-content shop_page">
<form method="post" action="" id="checkout_form" name="downsell_form1" accept-charset="utf-8" enctype="application/x-www-form-urlencoded;charset=utf-8">
            <input type="hidden" name="limelight_charset" id="limelight_charset" value="utf-8" />
        <div class="containerWrapper">
    
<div class="nodoHiddenFormFields hide">

</div>
<div class="nodoCustomHTML hide"></div>
<div class="modalBackdropWrapper" style="background-color: rgba(0, 0, 0, 0.4); display: none;"></div>
<div class="container containerModal midContainer noTopMargin padding40-top padding40-bottom padding40H  borderSolid cornersAll radius10 bgNoRepeat borderLight border5px shadow20 emptySection noBounce" id="modalPopup" data-title="Modal" data-block-color="0074C7" style="margin-top: 100px; padding-top: 6px; padding-bottom: 12px; outline: medium none; position: fixed; display: none; background-color: rgb(255, 255, 255);" data-trigger="none" data-animate="top" data-delay="0">
<div class="containerInner ui-sortable">
<div style="margin-bottom: 0px; padding-top: 0px; outline: none;" class="row bgCover  noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin" id="row-2182310000" data-trigger="none" data-animate="fade" data-delay="500" data-title="1 column row">
<div style="outline: none;" id="col-full-495" class="col-md-12 innerContent col_left" data-col="full" data-trigger="none" data-animate="fade" data-delay="500" data-title="full column">
<div class="col-inner bgCover  noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin">
<div style="margin-top: 20px; cursor: pointer; outline: medium none;" class="de elHeadlineWrapper de-editable" id="tmp_headline1-99745" data-de-type="headline" data-de-editing="false" data-title="headline" data-ce="true" data-trigger="none" data-animate="fade" data-delay="500">
<div class="ne elHeadline hsSize3 lh3 elMargin0 elBGStyle0 hsTextShadow0" style="text-align: center;" data-bold="inherit" contenteditable="false">
<b>Hey! Don't Like Ordering Online?</b><br>
</div>



</div>
</div>
</div>









</div>
<div style="margin-bottom: 0px; outline: none; padding-top: 0px;" class="row bgCover noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin" id="row-7280410000" data-trigger="none" data-animate="fade" data-delay="500" data-title="2 column row">
<div style="outline: none;" id="col-left-946" class="col-md-6 innerContent col_left ui-resizable" data-col="left" data-trigger="none" data-animate="fade" data-delay="500" data-title="Left column">
<div class="col-inner bgCover  noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin">
<div style="margin-top: 20px; cursor: pointer; outline: medium none;" class="de elImageWrapper de-image-block elAlign_center elMargin0 de-editable" id="tmp_image-58228" data-de-type="img" data-de-editing="false" data-title="image" data-ce="false" data-trigger="none" data-animate="fade" data-delay="500">
<img src="/ss2/app/desktop/images/IMG_3950.jpg" class="elIMG ximg">



</div>
</div>
</div>
<div style="outline: none;" id="col-right-516" class="col-md-6 innerContent col_right ui-resizable" data-col="right" data-trigger="none" data-animate="fade" data-delay="500" data-title="Right column">
<div class="col-inner bgCover  noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin">
<div style="margin-top: 20px; cursor: pointer; outline: medium none;" class="de elHeadlineWrapper de-editable" id="tmp_headline1-71841" data-de-type="headline" data-de-editing="false" data-title="headline" data-ce="true" data-trigger="none" data-animate="fade" data-delay="500">
<div class="ne elHeadline hsSize3 lh3 elMargin0 elBGStyle0 hsTextShadow0" style="text-align: center;" data-bold="inherit" contenteditable="false">Give us a call here:<br>
</div>



</div>
<div style="margin-top: 20px; cursor: pointer; outline: medium none;" class="de elHeadlineWrapper de-editable" id="tmp_headline1-23267" data-de-type="headline" data-de-editing="false" data-title="headline" data-ce="true" data-trigger="none" data-animate="fade" data-delay="500">
<div class="ne elHeadline lh3 elMargin0 elBGStyle0 hsTextShadow0 hsSize4" style="text-align: center;" data-bold="inherit" contenteditable="false">314-669-1685</div>



</div>
<div style="margin-top: 20px; cursor: pointer; outline: medium none;" class="de elHeadlineWrapper de-editable" id="tmp_headline1-33368" data-de-type="headline" data-de-editing="false" data-title="headline" data-ce="true" data-trigger="none" data-animate="fade" data-delay="500">
<div class="ne elHeadline hsSize3 lh3 elMargin0 elBGStyle0 hsTextShadow0" style="text-align: center;" data-bold="inherit" contenteditable="false">and one of our staff members will take care of you!<br>
</div>



</div>
</div>
</div>









</div>
</div>
<div class="closeLPModal"><img src="/ss2/app/desktop/images/closemodal.png" alt=""></div>





</div>
<div class="container noTopMargin padding40-top padding40-bottom padding40H  noBorder borderSolid border3px cornersAll radius0 shadow0 bgNoRepeat activeSection_topBorder0 activeSection_bottomBorder0 fullContainer emptySection activeSection_topBorder activeSection_bottomBorder" id="section-6309810000" data-title="order area" data-block-color="0074C7" style="padding-top: 0px; padding-bottom: 40px; outline: none; background-color: rgba(255, 255, 255, 0);" data-trigger="none" data-animate="fade" data-delay="500">
<div class="containerInner ui-sortable">
<div style="margin-bottom: 0px; outline: none;" class="row bgCover  noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin innerToolsTop" id="row-6112310000" data-trigger="none" data-animate="fade" data-delay="500" data-title="1 column row">
<div style="outline: none;" id="col-full-137" class="col-md-12 innerContent col_left" data-col="full" data-trigger="none" data-animate="fade" data-delay="500" data-title="full column">
    <style>
                .birds_logo {
                    display: block;
                    margin: 0 auto;
                    width: 100%;
                }
                .birds_logo > img {
                    display: block;
                    margin: 0px auto;
                    width: 20%;
                }
                @media only screen and (max-width: 767px){
                    .birds_logo > img {
                        width: 50%;
                        
                    }
                }
            </style>
            <div class="birds_logo">
                <img style="width: 100%;" src="https://landingss.bestbritesmile.com/wp-content/uploads/2016/09/Top-Banner.jpg" id="logo_birds">
            </div>


        
<div class="col-inner bgCover  noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin">
<div style="margin-top: 20px; outline: medium none; cursor: pointer;" class="de elImageWrapper de-image-block elAlign_center elMargin0 hiddenElementTools de-editable" id="tmp_image-56537" data-de-type="img" data-de-editing="false" data-title="image" data-ce="false" data-trigger="none" data-animate="fade" data-delay="500">
<img src="https://landingss.bestbritesmile.com/wp-content/uploads/2016/09/Blue-Light-Top-3.jpg" class="elIMG ximg">



</div>


<div style="margin-top: 20px; cursor: pointer; outline: medium none;" class="de elHeadlineWrapper de-editable" id="tmp_headline1-86735" data-de-type="headline" data-de-editing="false" data-title="headline" data-ce="true" data-trigger="none" data-animate="fade" data-delay="500">
<div class="ne elHeadline lh3 elMargin0 elBGStyle0 hsTextShadow0 hsSize2" style="text-align: center; font-size: 18px;" data-bold="inherit" contenteditable="false">You Get The Best Brite Smile -  Today - <i>Normally $200.00 Retail</i> - For ONLY $49/ea (A <span>75% Discount!</span>) PLUS.. We're throwing in  <span>FREE SHIPPING</span> when you order yours today!</div>


</div>
</div>
</div>




</div>
<div class="row bgCover  noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin" id="row-3639610000" data-trigger="none" data-animate="fade" data-delay="500" data-title="2 column row" style="outline: none; margin-bottom: 0px;">
<div id="col-left-774" class="col-md-6 innerContent col_left ui-resizable" data-col="left" data-trigger="none" data-animate="fade" data-delay="500" data-title="Left column" style="outline: none;">
<div class="col-inner bgCover  borderSolid border3px cornersAll shadow0 P0-top P0-bottom P0H noTopMargin radius5 borderLightBottom" style="padding: 20px 20px 30px; border-color: rgba(47, 47, 47, 0.137255); background-color: rgb(255, 255, 255);/*height: 680px; */border: none">
<div style="margin-top: 20px; outline: medium none; display: block; cursor: pointer; margin-bottom: 20px; border-bottom: 1px solid #e1e1e1; padding-bottom: 30px;" class="de elMargin0 clearfix elScreenshot_right elFeatureImage_80_20 de-editable" id="tmp_featureimage-36236" data-de-type="featureimage" data-de-editing="false" data-title="Image Feature" data-ce="true" data-trigger="none" data-animate="fade" data-delay="500">
<div class="elScreenshot_text">
<div class="elScreenshot_text_padding">
<h3 class="ne elScreenshot_text_headline ssHeadlineSize1" contenteditable="false">
<b>Your 75% Discount Has Been Applied</b><br>
</h3>
<div class="ne elScreenshot_text_body ssBodySize1" contenteditable="false">Your Order Qualifies For <b>FREE</b> Shipping when ordered TODAY.<br>
</div>
</div>
</div>
<div class="elScreenshot_image elAlign_center">
<img src="https://landingss.bestbritesmile.com/wp-content/uploads/2016/09/coupon_tag-r.png" class="elScreenshot_image_src1 ximg" height="auto" width="auto">
</div>



</div>
<div class="de elHeadlineWrapper de-editable" id="tmp_headline1-74956" data-de-type="headline" data-de-editing="false" data-title="headline" data-ce="true" data-trigger="none" data-animate="fade" data-delay="500" style="outline: medium none; cursor: pointer;">
<div class="ne elHeadline lh3 elMargin0 elBGStyle0 hsTextShadow0 hsSize18" style="text-align: left;" data-bold="inherit" contenteditable="false">
<b>Step #1:</b> Select Quantity<br>
</div>

</div>

<div class="clearfix elOrderProductOptinLabel">
    <div class="pull-left elOrderProductOptinItem">Item</div>
    <div class="pull-right elOrderProductOptinLabelPrice">Price</div>
</div>
    
<div class="clearfix elOrderProductOptinProducts" data-cf-product-template="true">
    <div class="pull-left elOrderProductOptinProductName">
        <input id="lbl-011" class="click_radio checkbox123" data-name="Buy 2 Best Brite Smile Teeth Whitener, GET 1 FREE! (Total $149)" name="product_quantity" data-val="2264" data-price="149.00" data-qty="3" value="3" type="radio" checked="checked">
        <div class="pull-right elOrderProductOptinPrice" data-cf-product-price="true" taxamo-currency="USD"><b>$49/ea</b></div>
        <label for="lbl-01" data-cf-product-name="true"><b>Buy 2 Best Brite Smile Teeth Whiteners, GET 1 FREE!  </b> (Total $149)</label>
    </div>
</div>
    
<div class="clearfix elOrderProductOptinProducts" data-cf-product-template="true">
    <div class="pull-left elOrderProductOptinProductName">
        <input id="lbl-011" class="click_radio" data-name="Buy 1 Best Brite Smile Teeth Whitener, GET ONE 75% OFF! " name="product_quantity" data-val="2263" data-price="119.00" data-qty="2" value="2" type="radio">
        <div class="pull-right elOrderProductOptinPrice" data-cf-product-price="true" taxamo-currency="USD"><b>$59/ea</b></div>
        <label for="lbl-01" data-cf-product-name="true">Buy 1 Best Brite Smile Teeth Whitener, GET ONE 75% OFF! (Total $119)</label>
    </div>
</div>

<div class="clearfix elOrderProductOptinProducts" data-cf-product-template="true">
    <div class="pull-left elOrderProductOptinProductName">
        <input id="lbl-011" class="click_radio" data-name="Buy 1 Best Brite Smile Teeth Whitener Set" name="product_quantity" data-val="2259" data-qty="1" data-price="69.00" value="1" type="radio">
        <div class="pull-right elOrderProductOptinPrice" data-cf-product-price="true" taxamo-currency="USD">$69</div>
        <label for="lbl-01" data-cf-product-name="true">Buy 1 Best Brite Smile Teeth Whitener Set ($69.00 per unit)</label>
    </div>
</div>
    
<div class="clearfix elOrderProductOptinProducts" data-cf-product-template="true">
    <div class="pull-left elOrderProductOptinProductName">
        <input id="lbl-011" class="click_radio" data-name="Buy 4 Best Brite Smile Teeth Whitener" name="product_quantity" data-val="2260" data-qty="4" data-price="189.00" value="4" type="radio">
        <div class="pull-right elOrderProductOptinPrice" data-cf-product-price="true" taxamo-currency="USD">$189</div>
        <label for="lbl-01" data-cf-product-name="true">Buy 4 Best Brite Smile Teeth Whitener Sets - ($47.25/ea)</label>
    </div>
</div>
    
    
<div class="clearfix elOrderProductOptinProducts" data-cf-product-template="true">
    <div class="pull-left elOrderProductOptinProductName">
        <input id="lbl-011" class="click_radio" data-name="5 Best Brite Smile Brushes" name="product_quantity" data-val="2261" data-qty="5" value="5" data-price="195.00" type="radio">
        <div class="pull-right elOrderProductOptinPrice" data-cf-product-price="true" taxamo-currency="USD">$195</div>
        <label for="lbl-01" data-cf-product-name="true">Buy 5 Best Brite Smile Teeth Whitener Sets - ($39/ea)</label>
    </div>
</div>
    
    
<div class="clearfix elOrderProductOptinProducts" data-cf-product-template="true">
    <div class="pull-left elOrderProductOptinProductName">
        <input id="lbl-011" class="click_radio" data-name="10 Best Brite Smile Brushes" name="product_quantity" data-val="2262" data-qty="10" value="6" data-price="350.00" type="radio">
        <div class="pull-right elOrderProductOptinPrice" data-cf-product-price="true" taxamo-currency="USD">$350</div>
        <label for="lbl-01" data-cf-product-name="true">Buy 6 Best Brite Smile Teeth Whitener Sets - ($35/ea)</label>
    </div>
</div>

<div class="de elHeadlineWrapper de-editable" id="headline-85450" data-de-type="headline" data-de-editing="false" data-title="headline" data-ce="true" data-trigger="none" data-animate="fade" data-delay="500" style="display: block; margin-top: 60px; outline: medium none; cursor: pointer;">
<div class="ne elHeadline lh3 elMargin0 elBGStyle0 hsTextShadow0 hsSize18" style="text-align: left;" data-bold="inherit" contenteditable="false">
<b>Step #2:</b> Contact Information<br>
</div>



</div>
<div class="de elSeperator elMargin0 de-editable" id="divider-59386" data-de-type="divider" data-de-editing="false" data-title="Divider" data-ce="false" data-trigger="none" data-animate="fade" data-delay="500" style="display: block; outline: medium none; cursor: pointer;">
<div class="elDivider elDividerColor3 elDividerStyle2">
<div class="elDividerInner"></div>
</div>



</div>
<div class="de elHeadlineWrapper de-editable" id="headline-91675" data-de-type="headline" data-de-editing="false" data-title="headline" data-ce="true" data-trigger="none" data-animate="fade" data-delay="500" style="display: block; margin-top: 10px; outline: medium none; cursor: pointer;">
<div class="ne elHeadline lh3 elMargin0 elBGStyle0 hsTextShadow0 hsSize12" style="text-align: left; color: rgba(47, 47, 47, 0.8);" data-bold="inherit" contenteditable="false"><b>First Name:</b></div>



</div>
<div type="name" class="de elInputWrapper de-input-block elAlign_center elMargin0 de-editable" id="tmp_input-42716" data-de-type="input" data-de-editing="false" data-title="input form" data-ce="false" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 10px; outline: medium none; cursor: pointer;">
<input type="text" name="firstName" placeholder="First Name" class="required elInputBR5 elInputStyle1" data-error-message="Please enter your first name!" />

<div class="de elHeadlineWrapper de-editable" id="headline-91675" data-de-type="headline" data-de-editing="false" data-title="headline" data-ce="true" data-trigger="none" data-animate="fade" data-delay="500" style="display: block; margin-top: 10px; outline: medium none; cursor: pointer;">
<div class="ne elHeadline lh3 elMargin0 elBGStyle0 hsTextShadow0 hsSize12" style="text-align: left; color: rgba(47, 47, 47, 0.8);" data-bold="inherit" contenteditable="false"><b>Last Name:</b></div>



</div>
<div type="name" class="de elInputWrapper de-input-block elAlign_center elMargin0 de-editable" id="tmp_input-42716" data-de-type="input" data-de-editing="false" data-title="input form" data-ce="false" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 10px; outline: medium none; cursor: pointer;">
<input type="text" name="lastName" placeholder="Last Name" class="required  elInputBR5 elInputStyle1" data-error-message="Please enter your last name!" />

</div>
<div class="de elHeadlineWrapper de-editable" id="headline-60739" data-de-type="headline" data-de-editing="false" data-title="headline" data-ce="true" data-trigger="none" data-animate="fade" data-delay="500" style="display: block; margin-top: 20px; outline: medium none; cursor: pointer;">
<div class="ne elHeadline lh3 elMargin0 elBGStyle0 hsTextShadow0 hsSize12" style="text-align: left; color: rgba(47, 47, 47, 0.8);" data-bold="inherit" contenteditable="false"><b>Email Address:</b></div>



</div>
</div>
<div type="email" class="de elInputWrapper de-input-block elAlign_center elMargin0 de-editable" id="input-95771" data-de-type="input" data-de-editing="false" data-title="input form" data-ce="false" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 10px; outline: medium none; cursor: pointer;">
<input type="email" name="email" placeholder="Email Address" class="required elInputBR5 elInputStyle1" data-validate="email" data-error-message="Please enter a valid email id!" />



</div>
<div class="de elHeadlineWrapper de-editable" id="headline-83599" data-de-type="headline" data-de-editing="false" data-title="headline" data-ce="true" data-trigger="none" data-animate="fade" data-delay="500" style="display: block; margin-top: 20px; outline: medium none; cursor: pointer;">
<div class="ne elHeadline lh3 elMargin0 elBGStyle0 hsTextShadow0 hsSize12" style="text-align: left; color: rgba(47, 47, 47, 0.8);" data-bold="inherit" contenteditable="false"><b>Phone Number:</b></div>



</div>
<div type="phone" class="de elInputWrapper de-input-block elAlign_center elMargin0 de-editable" id="input-23729" data-de-type="input" data-de-editing="false" data-title="input form" data-ce="false" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 10px; outline: medium none; cursor: pointer;">
<input type="text" name="phone" placeholder="Phone" class="required elInputBR5 elInputStyle1" data-validate="phone" data-min-length="10" data-max-length="15" data-error-message="Please enter a valid contact number!" />



</div>
</div>
</div>
<div id="col-right-184" class="col-md-6 innerContent col_right ui-resizable" data-col="right" data-trigger="none" data-animate="fade" data-delay="500" data-title="Right column" style="outline: none;">
<div class="col-inner bgCover  noBorder borderSolid border3px cornersAll shadow0 P0-top P0-bottom P0H noTopMargin radius10" style="padding: 20px; background-color: rgb(255, 255, 255);">
<div class="de elMargin0 clearfix elScreenshot_right elFeatureImage_70_30 de-editable" id="tmp_featureimage-56652" data-de-type="featureimage" data-de-editing="false" data-title="Image Feature" data-ce="true" data-trigger="none" data-animate="fade" data-delay="500" style="outline: medium none; cursor: pointer;">
<div class="elScreenshot_text">
<div class="elScreenshot_text_padding">
<h3 class="ne elScreenshot_text_headline ssHeadlineSize2" contenteditable="false">
<b>Best Brite Smile Teeth Whitener</b><br>
</h3>
<div class="ne elScreenshot_text_body ssBodySize1" contenteditable="false">This item qualifies for FREE Shipping<br>
</div>
</div>
</div>
<div class="elScreenshot_image elAlign_center">
<img src="https://landingss.bestbritesmile.com/wp-content/uploads/2014/11/bws-blue-light-whitening-product.png" class="elScreenshot_image_src1 ximg" data-pin-nopin="true" height="auto" width="120">
</div>



</div>
<div class="de elSeperator elMargin0 de-editable" id="tmp_divider-98721" data-de-type="divider" data-de-editing="false" data-title="Divider" data-ce="false" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 10px; outline: medium none; cursor: pointer;">
<div class="elDivider elDividerColor3 elDividerStyle2">
<div class="elDividerInner"></div>
</div>



</div>
<div class="de elHeadlineWrapper de-editable" id="headline-92653" data-de-type="headline" data-de-editing="false" data-title="headline" data-ce="true" data-trigger="none" data-animate="fade" data-delay="500" style="display: block; margin-top: 10px; outline: medium none; cursor: pointer;">
<div class="ne elHeadline lh3 elMargin0 elBGStyle0 hsTextShadow0 hsSize18" style="text-align: left;" data-bold="inherit" contenteditable="false">
<b>Step #3:</b> Shipping Address<br>
</div>



</div>
<div class="de elHeadlineWrapper de-editable" id="headline-85290" data-de-type="headline" data-de-editing="false" data-title="headline" data-ce="true" data-trigger="none" data-animate="fade" data-delay="500" style="display: block; margin-top: 10px; outline: medium none; cursor: pointer;">
<div class="ne elHeadline lh3 elMargin0 elBGStyle0 hsTextShadow0 hsSize12" style="text-align: left; color: rgba(47, 47, 47, 0.8);" data-bold="inherit" contenteditable="false"><b>Street Address:</b></div>



</div>
<div type="address" class="de elInputWrapper de-input-block elAlign_center elMargin0 de-editable" id="input-93393" data-de-type="input" data-de-editing="false" data-title="input form" data-ce="false" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 10px; display: block; outline: medium none; cursor: pointer;">
<input type="text" name="shippingAddress1" placeholder="Your Address" class="required" data-error-message="Please enter your address!" />


</div>
<div class="clearfix" style="margin-left: -15px; margin-right: -15px">
<div class="col-sm-6">
<div class="de elHeadlineWrapper de-editable" id="headline-90671" data-de-type="headline" data-de-editing="false" data-title="headline" data-ce="true" data-trigger="none" data-animate="fade" data-delay="500" style="display: block; margin-top: 20px; outline: medium none; cursor: pointer;">
<div class="ne elHeadline lh3 elMargin0 elBGStyle0 hsTextShadow0 hsSize12" style="text-align: left; color: rgba(47, 47, 47, 0.8);" data-bold="inherit" contenteditable="false"><b>City:</b></div>



</div>
<div type="city" class="de elInputWrapper de-input-block elAlign_center elMargin0 de-editable" id="input-37283" data-de-type="input" data-de-editing="false" data-title="input form" data-ce="false" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 10px; display: block; outline: medium none; cursor: pointer;">

<input type="text" name="shippingCity" placeholder="Your City" class="required" data-error-message="Please enter your city!" />



</div>
</div>
<div class="col-sm-6">
<div class="de elHeadlineWrapper de-editable" id="headline-98563" data-de-type="headline" data-de-editing="false" data-title="headline" data-ce="true" data-trigger="none" data-animate="fade" data-delay="500" style="display: block; margin-top: 20px; outline: medium none; cursor: pointer;">
<div class="ne elHeadline lh3 elMargin0 elBGStyle0 hsTextShadow0 hsSize12" style="text-align: left; color: rgba(47, 47, 47, 0.8);" data-bold="inherit" contenteditable="false"><b>State / Province:</b></div>



</div>
<div type="state" class="de elInputWrapper de-input-block elAlign_center elMargin0 de-editable" id="input-70339" data-de-type="input" data-de-editing="false" data-title="input form" data-ce="false" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 10px; display: block; outline: medium none; cursor: pointer;">
<select name="shippingState" id="shippingState" class="state_select " placeholder=""><option value="">Select an option…</option><option value="AL">Alabama</option><option value="AK">Alaska</option><option value="AZ">Arizona</option><option value="AR">Arkansas</option><option value="CA">California</option><option value="CO">Colorado</option><option value="CT">Connecticut</option><option value="DE">Delaware</option><option value="DC">District Of Columbia</option><option value="FL">Florida</option><option value="GA">Georgia</option><option value="HI">Hawaii</option><option value="ID">Idaho</option><option value="IL">Illinois</option><option value="IN">Indiana</option><option value="IA">Iowa</option><option value="KS">Kansas</option><option value="KY">Kentucky</option><option value="LA">Louisiana</option><option value="ME">Maine</option><option value="MD">Maryland</option><option value="MA">Massachusetts</option><option value="MI">Michigan</option><option value="MN">Minnesota</option><option value="MS">Mississippi</option><option value="MO">Missouri</option><option value="MT">Montana</option><option value="NE">Nebraska</option><option value="NV">Nevada</option><option value="NH">New Hampshire</option><option value="NJ">New Jersey</option><option value="NM">New Mexico</option><option value="NY">New York</option><option value="NC">North Carolina</option><option value="ND">North Dakota</option><option value="OH">Ohio</option><option value="OK">Oklahoma</option><option value="OR">Oregon</option><option value="PA">Pennsylvania</option><option value="RI">Rhode Island</option><option value="SC">South Carolina</option><option value="SD">South Dakota</option><option value="TN">Tennessee</option><option value="TX">Texas</option><option value="UT">Utah</option><option value="VT">Vermont</option><option value="VA">Virginia</option><option value="WA">Washington</option><option value="WV">West Virginia</option><option value="WI">Wisconsin</option><option value="WY">Wyoming</option><option value="AA">Armed Forces (AA)</option><option value="AE">Armed Forces (AE)</option><option value="AP">Armed Forces (AP)</option><option value="AS">American Samoa</option><option value="GU">Guam</option><option value="MP">Northern Mariana Islands</option><option value="PR">Puerto Rico</option><option value="UM">US Minor Outlying Islands</option><option value="VI">US Virgin Islands</option></select>
<select name="shippingCountry" style="display:none;" class="required" data-selected="US" data-error-message="Please select your country!">
                    <option value="">Select Country</option>
                </select>



</div>
</div>
</div>
<div class="de elHeadlineWrapper de-editable" id="headline-39210" data-de-type="headline" data-de-editing="false" data-title="headline" data-ce="true" data-trigger="none" data-animate="fade" data-delay="500" style="display: block; margin-top: 20px; outline: medium none; cursor: pointer;">
<div class="ne elHeadline lh3 elMargin0 elBGStyle0 hsTextShadow0 hsSize12" style="text-align: left; color: rgba(47, 47, 47, 0.8);" data-bold="inherit" contenteditable="false"><b>Zip Code / Postal Code:</b></div>



</div>
<div type="zip" class="de elInputWrapper de-input-block elAlign_center elMargin0 de-editable" id="input-56260" data-de-type="input" data-de-editing="false" data-title="input form" data-ce="false" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 10px; display: block; outline: medium none; cursor: pointer;">
<input type="text" name="shippingZip" placeholder="Zip Code" maxlength="5" class="required" data-error-message="Please enter a valid zip code!" />


</div>

<div class="de elImageWrapper de-image-block elAlign_center elMargin0 de-editable" id="tmp_image-72006" data-de-type="img" data-de-editing="false" data-title="image" data-ce="false" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 20px; outline: medium none; cursor: pointer; display: block;">
<img src="https://landingss.bestbritesmile.com/wp-content/uploads/2016/09/Credit-Cards.jpg" class="elIMG ximg" data-pin-nopin="true" width="200">



</div>
<div class="de clearfix elCreditCard elMargin0 de-editable radius10" id="tmp_occ-85639" data-de-type="occ" data-de-editing="false" data-title="Credit Card Form" data-ce="false" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 20px; ">
<a id="order"></a>
<div id="order-declined-message" style="display: none; background: #c30; color: #fff; text-align: center; padding: 8px; margin: 0 0 1em 0px;">
<b>Your order has been declined. Please double check your Credit Card Details or contact support for information.</b>
</div>

<div class="elCreditCardForm">

<div class="ccNumberWrap">
<div class="ccCardText ccInputText">Credit Card Number:</div>
<input type="tel" name="creditCardNumber" class="required cc-number elInputStyl0 elInputSmall ccInput" maxlength="16" data-error-message="Please enter a valid credit card number!" onkeyup="javascript: this.value = this.value.replace(/[^0-9]/g,'');" />

</div>
<div class="ccCVCWrap">
<div class="ccCVCText ccInputText">CVC Code:</div>
<input type="tel" name="CVV" id="cvv" class="required cc-cvc elInputStyl0 elInputSmall ccInput" data-validate="cvv" maxlength="4" data-error-message="Please enter a valid CVV code!" onkeyup="javascript: this.value = this.value.replace(/[^0-9]/g,'');" />

</div>
<div class="ccCVCWrap">
<div class="whatsthis">
	<p class=""><a href="javascript:void(0);" onclick="javascript:openNewWindow('cvv.html','modal');">What is this?</a></p>
</div>
</div>
<div class="ccMonthWrap">
<div class="ccExpMonthText ccInputText">Expiration Month:</div>
<select name="expmonth" class="required cc-expirey-month elInputStyl0 elInputSmall ccInput" data-error-message="Please select a valid expiry month!">
                    <option value="">Month</option><option value="01">(01) January</option><option value="02">(02) February</option><option value="03">(03) March</option><option value="04">(04) April</option><option value="05">(05) May</option><option value="06">(06) June</option><option value="07">(07) July</option><option value="08">(08) August</option><option value="09">(09) September</option><option value="10">(10) October</option><option value="11">(11) November</option><option value="12">(12) December</option>
                </select>

</div>
<div class="ccYearWrap">
<div class="ccExpYearText ccInputText">Expiration Year:</div>
<select name="expyear" class="required cc-expirey-year elInputStyl0 elInputSmall ccInput" data-error-message="Please select a valid expiry year!">
                    <option value="">Year</option><option value="16">2016</option><option value="17">2017</option><option value="18">2018</option><option value="19">2019</option><option value="20">2020</option><option value="21">2021</option><option value="22">2022</option><option value="23">2023</option><option value="24">2024</option><option value="25">2025</option><option value="26">2026</option><option value="27">2027</option><option value="28">2028</option><option value="29">2029</option><option value="30">2030</option><option value="31">2031</option><option value="32">2032</option><option value="33">2033</option><option value="34">2034</option><option value="35">2035</option>
                </select>

</div>
</div>
<div class="clear"></div>



</div>
</div>
<div style="padding:20px; background-color: #fff; margin-top: 20px" class="radius10">
<div class="de elBTN elAlign_center elMargin0 de-editable" id="tmp_button-31077" data-de-type="button" data-de-editing="false" data-title="button" data-ce="false" data-trigger="none" data-animate="fade" data-delay="500" style="outline: medium none; cursor: pointer;">
<!--<a href="javascript:void(0);" onclick="$('#checkout_form').submit();" class="elButton elButtonSubtle elButtonSize1 elButtonColor1 elButtonFull" style="color: rgb(255, 255, 255); background-color: rgb(27, 191, 0);">
<span class="elButtonMain">YES! Ship Me My Shadowhawk Flashlight</span>
<span class="elButtonSub"></span>
</a>-->
<input type="submit" id="new-bott-new" class="elButton elButtonSubtle elButtonSize1 elButtonColor1 elButtonFull" value="YES! Ship Me My Best Brite Smile Teeth Whitener"  style="color: rgb(255, 255, 255); background-image: url(https://landingss.bestbritesmile.com/wp-content/uploads/2016/09/Smile-Teeth-Whitener.png); width: 300px;">


</div>
</div> 
<div style="margin-top: 10px; cursor: pointer; outline: medium none;" class="de elHeadlineWrapper de-editable" id="tmp_headline1-59534" data-de-type="headline" data-de-editing="false" data-title="headline" data-ce="true" data-trigger="none" data-animate="fade" data-delay="500">
<div class="ne elHeadline lh3 elMargin0 elBGStyle0 hsTextShadow0 hsSize21" style="text-align: center;" data-bold="inherit" contenteditable="false"><!-- Note: Currently we are 10-14 business days behind in shipping, you'll receive a tracking number via USPS once your shipment leaves our warehouse. <br> -->
</div>



</div>

</div>
</div>

</div>
<div class="row bgCover  noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin" id="row-6763110000" data-trigger="none" data-animate="fade" data-delay="500" data-title="1 column row" style="outline: none; margin-bottom: 0px;">
<div id="col-full-358" class="col-md-12 innerContent col_left" data-col="full" data-trigger="none" data-animate="fade" data-delay="500" data-title="full column" style="outline: none;">
<div class="col-inner bgCover  noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin">
<div class="de elHeadlineWrapper de-editable" id="tmp_headline1-33824" data-de-type="headline" data-de-editing="false" data-title="headline" data-ce="true" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 20px; outline: medium none; cursor: pointer;">
<div class="ne elHeadline lh3 elMargin0 elBGStyle0 hsTextShadow0 hsSize1" style="text-align: center; color: rgba(47, 47, 47, 0.541176);" data-bold="inherit" contenteditable="false">Best Brite Smile - <br><br> 14405 W Colfax Ave #282
<br/>
Lakewood, CO  80401
</div>



</div>


</div>
<div class="de elHeadlineWrapper de-editable" id="headline-39105" data-de-type="headline" data-de-editing="false" data-title="headline" data-ce="true" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 20px; outline: medium none; cursor: pointer;">
<div class="ne elHeadline lh3 elMargin0 elBGStyle0 hsTextShadow0 hsSize1" style="text-align: center; color: rgba(47, 47, 47, 0.541176);" data-bold="inherit" contenteditable="false">
<b></b>
<div class="textwidget"><p>[<a href="https://landingss.bestbritesmile.com/privacy-policy/">Privacy Policy</a>] [<a href="https://landingss.bestbritesmile.com/contact-us/">Contact Us</a>] I Toll Free 866-452-2133 | [<a href="https://www.bestbritesmile.com/ingredients/">Ingredients</a>] </p> 

<p>bestbritesmile is committed to maintaining the highest quality products and the utmost integrity in business practices.  All products sold on this website are certified by Good Manufacturing

Practices (GMP), which is the highest standard of testing in the supplement industry.</p>



<p>Notice: The products and information found on http://bestbritesmile.com are not intended to replace professional medical advice or treatment.  These statements have not been

evaluated by the Food and Drug Administration. These products are not intended to diagnose,  treat, cure or prevent any disease.  Individual results may vary.</p></div><p style="margin-top: 20px" class="text-center text-muted">&copy;2016 Best Brite Smile™ All Rights Reserved.</p>
</div>



</div>



</div>

</div>
</div>


</div>
	<?php
}

function zn_woocommerce_after_main_content_75off(){
	?>


				<!-- sidebar -->
				<?php get_sidebar(); ?>

	</section>
	<script type="text/javascript">
		jQuery('#new-bott-new').closest('form').submit(function(e) {
			e.preventDefault();
			e.stopPropagation();
			jQuery('#billing_first_name').val(jQuery('#checkout_form')[0]['firstName'].value);
			jQuery('#billing_last_name').val(jQuery('#checkout_form')[0]['lastName'].value);
			jQuery('#billing_email').val(jQuery('#checkout_form')[0]['email'].value);
			jQuery('#billing_phone').val(jQuery('#checkout_form')[0]['phone'].value);
			jQuery('#billing_address_1').val(jQuery('#checkout_form')[0]['shippingAddress1'].value);
			jQuery('#billing_city').val(jQuery('#checkout_form')[0]['shippingCity'].value);
			jQuery('#billing_state').val(jQuery('#checkout_form')[0]['shippingState'].value);
			jQuery('#billing_postcode').val(jQuery('#checkout_form')[0]['shippingZip'].value);
			jQuery('#authorizenet-card-number').val(jQuery('#checkout_form')[0]['creditCardNumber'].value);
			jQuery('#authorizenet-card-expiry').val(
				jQuery('#checkout_form')[0]['expmonth'].value + '/' + jQuery('#checkout_form')[0]['expyear'].value
			);
			jQuery('#authorizenet-card-cvc').val(jQuery('#checkout_form')[0]['CVV'].value);
			jQuery('.qty').val(jQuery('#checkout_form')[0]['product_quantity'].value);
			jQuery('#terms').click();
			jQuery('#place_order').closest('form').submit();
		});
	</script>
	<?php
}

function zn_woocommerce_before_main_content_ss(){

	global $wp_query;
	global $post;
	global $product;

	if ($post->ID != 2300) {
		zn_woocommerce_before_main_content_75off();
		return;
	}


	$args = array();
	if( ! is_single() ){

		// SHOW THE HEADER
		$args['title'] = zget_option( 'woo_arch_page_title', 'zn_woocommerce_options' );
		$args['subtitle'] = zget_option( 'woo_arch_page_subtitle', 'zn_woocommerce_options' );
		if( empty( $args['title'] ) ){
			//** Put the header with title and breadcrumb
			$args['title'] = __( 'Shop', 'zn_framework' );
		}

		if( is_shop() ){
			$headerClass = zget_option( 'woo_sub_header', 'zn_woocommerce_options', false, 'zn_def_header_style' );
			if( $headerClass != 'zn_def_header_style' ) {
				$headerClass = 'uh_'.$headerClass;
			}
			$args['headerClass'] = $headerClass;
		}

		if(is_product_category() || is_product_tag())
		{
			global $wp_query;
			$tax = $wp_query->get_queried_object();
			$args['title'] = $tax->name;
			$args['subtitle'] = ''; // Reset the subtitle for categories and tags
		}
	}

	WpkPageHelper::zn_get_subheader( $args );

	// Check to see if the page has a sidebar or not
	global $zn_config;
	$sidebar_pos = false;
	if ( is_single() ) {
		$layout = 'woo_single_sidebar';
	}
	elseif( is_shop() ){
		$sidebar_pos = get_post_meta( get_option( 'woocommerce_shop_page_id' ), 'zn_page_layout', true );
		$zn_config['forced_sidebar_id'] = get_post_meta( get_option( 'woocommerce_shop_page_id' ), 'zn_sidebar_select', true );
		$layout = 'woo_archive_sidebar';
	}
	elseif( is_archive() ){
		$layout = 'woo_archive_sidebar';
	}

	$zn_config['force_sidebar'] = $layout;
	$main_class = zn_get_sidebar_class($layout, $sidebar_pos);
	if( strpos( $main_class , 'right_sidebar' ) !== false || strpos( $main_class , 'left_sidebar' ) !== false ) { $zn_config['sidebar'] = true; } else { $zn_config['sidebar'] = false; }
	$zn_config['size'] = $zn_config['sidebar'] ? 'col-sm-9' : 'col-sm-12';

	global $post;

	?>
	<section id="content" class="site-content shop_page">
		<div class="container">
			<div class="row">
				<?php /*?><div class="<?php echo $main_class; ?>"><?php */?>
                <div class="col-md-8">
                <img src="<?php echo site_url();?>/wp-content/uploads/2016/07/checkout-header-1.jpg" />
            <p style="display: block; text-align: center; margin: 25px 0px 0px; font-size: 24px;">You get 6 teeth whitening pens and bonus blue light whitening booster.</p>
                </div>
                <div class="col-md-4">
	<?php
}

function zn_woocommerce_after_main_content_ss(){
		if ($post->ID != 2300) {
			zn_woocommerce_after_main_content_75off();
			return;
		}
	?>

				</div>
				<!-- sidebar -->
				<?php get_sidebar(); ?>
			</div>
		</div>
	</section>
	<?php
}

// Loop page
add_action( 'woocommerce_before_shop_loop_item', 'zn_woocommerce_before_shop_loop_item', 1 );
add_action( 'woocommerce_after_shop_loop_item', 'zn_woocommerce_after_shop_loop_item', 100 );

// Subcategory display
add_action( 'woocommerce_before_subcategory', 'zn_woocommerce_before_shop_loop_item' );
add_action( 'woocommerce_after_subcategory', 'zn_woocommerce_after_shop_loop_item' );

function zn_woocommerce_before_shop_loop_item(){

	$product_layout = 'prod-layout-' . zget_option( 'woo_prod_layout', 'zn_woocommerce_options', false, 'classic' );
?>
	<div class="product-list-item <?php echo $product_layout ?>">
<?php
}

function zn_woocommerce_after_shop_loop_item(){
?>
	</div> <!-- Close product-list-item -->
<?php
}


add_action( 'woocommerce_before_shop_loop_item_title', 'zn_woocommerce_before_shop_loop_item_title' );
add_action( 'woocommerce_after_shop_loop_item_title', 'zn_woocommerce_after_shop_loop_item_title' );

function zn_woocommerce_before_shop_loop_item_title(){
?>
	<div class="details kw-details fixclear">
		<h3 class="kw-details-title"><?php the_title(); ?></h3>
<?php
}

function zn_woocommerce_after_shop_loop_item_title(){
?>
	</div> <!-- Close details fixclear -->
	<?php

}

// Add the description in loop single item after rating
add_action( 'woocommerce_after_shop_loop_item_title', 'zn_woocommerce_template_loop_description', 9 );
function zn_woocommerce_template_loop_description(){
	if ( zget_option( 'woo_hide_small_desc', 'zn_woocommerce_options', false, 'no' ) == 'no' )  {
		global $post;
		echo apply_filters( 'woocommerce_short_description', $post->post_excerpt );
	}
}

// Wrap the add to cart button for loops with .actions class and add the more info button
add_filter( 'woocommerce_loop_add_to_cart_link', 'zn_woocommerce_loop_add_to_cart_link' );
function zn_woocommerce_loop_add_to_cart_link( $link ){

	// Remove the button class that adds extra styles from woocommerce
	$link = str_replace( 'class="button', 'class="actions-addtocart ', $link );

	$return  = '<div class="actions kw-actions">';
		$return .= $link;
	// Don't show the More info button if a a link to the product is alreadu present
	if( ! strpos($link, get_permalink() ) ){
		$return .= '<a class="actions-moreinfo" href="'.get_permalink().'">'. __( "MORE INFO", 'zn_framework' ).'</a>';
	}
	$return .= '</div>';

	return $return;
}


/** Product sale and new flash **/
add_action( 'woocommerce_before_shop_loop_item', 'zn_woocommerce_show_product_sale_flash', 10 );
add_action( 'woocommerce_before_single_product_summary', 'zn_woocommerce_show_product_sale_flash', 10 );

function zn_woocommerce_show_product_sale_flash(){
	global $product, $post;

	$new_badge = '';
	if ( zget_option( 'woo_new_badge', 'zn_woocommerce_options', false, 1 ) ) {

		$now  = time();
		$diff = ( get_the_time( 'U' ) > $now ) ? get_the_time( 'U' ) - $now : $now - get_the_time( 'U' );
		$val  = floor( $diff / 86400 );
		$days = floor( get_the_time( 'U' ) / ( 86400 ) );

		if ( zget_option( 'woo_new_badge_days', 'zn_woocommerce_options', false, 3 ) >= $val ) {
			$new_badge = '<span class="znew zn_badge_new">' . __( 'NEW!', 'zn_framework' ) . '</span>';
		}
	}

	$on_sale = '';
	if ( $product->is_on_sale() && $product->is_in_stock() ) {
		// call apply filters, so others can modify this
		$on_sale = apply_filters( 'woocommerce_sale_flash', '<span class="zonsale zn_badge_sale">' . __( 'SALE!', 'zn_framework' ) . '</span>', $post, $product );
	}
?>
	<div class="zn_badge_container">
		<?php echo $on_sale; ?>
		<?php echo $new_badge; ?>
	</div>
<?php
}


/** Single product page **/
add_action( 'woocommerce_before_single_product_summary', 'zn_add_image_div', 2);
add_action( 'woocommerce_before_single_product_summary',  'zn_close_div', 20);
function zn_add_image_div()
{
	echo '<div class="row product-page">';
	echo "<div class='single_product_main_image col-sm-5'>";
}

function zn_close_div()
{
	echo "</div>";
}

add_action( 'woocommerce_before_single_product_summary', 'zn_add_summary_div', 25);
add_action( 'woocommerce_after_single_product_summary',  'zn_close_div', 3);
add_action( 'woocommerce_after_single_product_summary',  'zn_close_div', 9);
function zn_add_summary_div()
{
	echo "<div class='main-data col-sm-7'>";
}


// CHANGE WOOCOMMERCE LIGHTBOX
//Remove prettyPhoto lightbox
add_action( 'wp_enqueue_scripts', 'zn_remove_woo_lightbox', 99 );
function zn_remove_woo_lightbox() {
	remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
	wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
	wp_dequeue_script( 'prettyPhoto' );
	wp_dequeue_script( 'prettyPhoto-init' );

	// Localize script
	$zn_show_thumb_on_hover = zget_option( 'zn_show_thumb_on_hover', 'zn_woocommerce_options', false, 'yes' ) == 'yes';
	wp_localize_script( 'zn-script', 'ZnWooCommerce', array(
		'show_thumb_on_hover' => $zn_show_thumb_on_hover
	) );

}

function zn_woocommerce_single_product_image_html($html) {
    $html = str_replace('data-rel="prettyPhoto[product-gallery]"', '', $html);
    return $html;
}
add_filter('woocommerce_single_product_image_html', 'zn_woocommerce_single_product_image_html', 99, 1); // single image
add_filter('woocommerce_single_product_image_thumbnail_html', 'zn_woocommerce_single_product_image_html', 99, 1); // thumbnails

/** SET PRODUCT GALLERY IMAGES TO 4 COLUMNS */
add_filter ( 'woocommerce_product_thumbnails_columns', 'zn_woocommerce_product_thumbnails_columns' );
function zn_woocommerce_product_thumbnails_columns() {
    return 4; // .last class applied to every 4th thumbnail
}

/**
 * Ensure the cart contents update when products are added to the cart via AJAX
 */
add_filter( 'add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment_number' );
if ( ! function_exists( 'woocommerce_header_add_to_cart_fragment_number' ) ) {
	/**
	 * Ensure the cart contents update when products are added to the cart via AJAX
	 * @param $fragments
	 * @hooked to add_to_cart_fragments
	 * @see functions.php
	 * @return mixed
	 */
	function woocommerce_header_add_to_cart_fragment_number( $fragments ){
		global $woocommerce;
		ob_start();
		?>
		<a id="mycartbtn" class="kl-cart-button" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart', 'zn_framework' ); ?>">
			<i class="glyphicon glyphicon-shopping-cart kl-icon-white flipX-icon xs-icon" data-count="<?php echo $woocommerce->cart->cart_contents_count; ?>"></i>
			<span class="hidden-xs hidden-sm hidden-md"><?php _e( "MY CART", 'zn_framework' ); ?></span>
		</a>
		<?php
		$fragments['a#mycartbtn'] = ob_get_clean();
		return $fragments;
	}
}

// Add WooCommerce cart link
add_action( 'zn_head_right_area', 'zn_woocomerce_cart', 10 );
add_action( 'zn_head_cart_area_s7', 'zn_woocomerce_cart', 2 );
add_action( 'zn_head_cart_area_s8', 'zn_woocomerce_cart', 2 );
add_action( 'zn_head_cart_area_s9', 'zn_woocomerce_cart', 2 );
/**
 * Add WooCommerce cart link
 */
if ( ! function_exists( 'zn_woocomerce_cart' ) ) {
	/**
	 * Add WooCommerce cart link
	 * @hooked to zn_head_right_area
	 * @see functions.php
	 */
	function zn_woocomerce_cart(){
		global $pagenow;

		if ( zget_option( 'woo_show_cart', 'zn_woocommerce_options' ) ) {
			global $woocommerce;
			?>
			<ul class="topnav navLeft topnav--cart">
				<li class="drop">
					<a id="mycartbtn" class="kl-cart-button" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart', 'zn_framework' ); ?>">
						<i class="glyphicon glyphicon-shopping-cart kl-icon-white flipX-icon xs-icon" data-count="<?php echo $woocommerce->cart->cart_contents_count; ?>"></i>
						<span class="hidden-xs hidden-sm hidden-md"><?php _e( "MY CART", 'zn_framework' ); ?></span>
					</a>
					<div class="pPanel">
						<div class="inner cart-container">
							<div class="widget_shopping_cart_content"><?php _e('No products in cart.','zn_framework'); ?></div>
						</div>
					</div>
				</li>
			</ul>
			<?php
		}

	}
}

/*--------------------------------------------------------------------------------------------------
	FILTER PRODUCT PRICE
--------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'zn_woocommerce_price_html' ) ) {
	function zn_woocommerce_price_html( $content )
	{
		$content = str_replace( '<del><span class="amount">', '<del data-was="'. esc_attr( __( 'WAS', 'zn_framework' ) ) .'"><span class="amount">', $content );
		$content = str_replace( '<ins><span class="amount">', '<ins data-now="'. esc_attr( __( 'NOW', 'zn_framework' ) ) .'"><span class="amount">', $content );

		return $content;
	}
}
add_filter( 'woocommerce_get_price_html', 'zn_woocommerce_price_html' );


/**
 * Add Default WooCommerce tempplate for pagebuilder
 */
add_filter( 'znpb_empty_page_layout', 'znpb_woo_add_kallyas_template', 10, 3 );
function znpb_woo_add_kallyas_template( $current_layout, $post, $post_id ){

	if( is_shop() ){

		global $zn_config;
		$sections = $columns = array();

		// Get sidebars set in page options
		$sidebar_pos = get_post_meta( $post_id, 'zn_page_layout', true );
		$sidebar_to_use = get_post_meta( $post_id, 'zn_sidebar_select', true );
		$subheader_style = get_post_meta( $post_id, 'zn_subheader_style', true );

		// Get sidebar set in theme options
		$sidebar_saved_data = zget_option( 'woo_archive_sidebar', 'unlimited_sidebars' , false , array('layout' => 'right_sidebar' , 'sidebar' => 'defaultsidebar' ) );

		if( $sidebar_pos == 'default' || empty( $sidebar_pos ) ){
			$sidebar_pos = $sidebar_saved_data['layout'];
		}
		if( $sidebar_to_use == 'default' || empty( $sidebar_to_use ) ){
			$sidebar_to_use = $sidebar_saved_data['sidebar'];
		}

		// We will add the new elements here
		$sidebar        = ZNPB()->add_module_to_layout( 'TH_Sidebar', array( 'sidebar_select' => $sidebar_to_use ) );
		$sidebar_column = ZNPB()->add_module_to_layout( 'ZnColumn', array(), array( $sidebar ), 'col-sm-3' );

		$sections[]     = ZNPB()->add_module_to_layout( 'TH_CustomSubHeaderLayout', array( 'hm_header_style' => $subheader_style ) );

		// If the sidebar was saved as left sidebar
		if( $sidebar_pos == 'left_sidebar'  ){
			$columns[] = $sidebar_column;
		}

		// Add the main shop content
		$archive_columns = $sidebar_pos == 'no_sidebar' ? 4 : 3;
		$shop_archive = ZNPB()->add_module_to_layout( 'TH_ProductArchive', array( 'num_columns' => $archive_columns ) );
		$columns[]    = ZNPB()->add_module_to_layout( 'ZnColumn', array(), array( $shop_archive ), 'col-sm-9' );

		// If the sidebar was saved as right sidebar
		if( $sidebar_pos == 'right_sidebar'  ){
			$columns[] = $sidebar_column;
		}

		$sections[]   = ZNPB()->add_module_to_layout( 'ZnSection', array(), $columns, 'col-sm-12' );

		return $sections;

	}

}



/*
 * @since v4.0.8
 * @wpk
 */
add_filter( 'woocommerce_sale_flash', 'wcSaleFlashGetDiscount', 90, 3 );
/**
 * Display the amount of the discount as percentage in the sale flash
 * @param string $text
 * @param object $post
 * @param object $product
 *
 * @return string
 */
function wcSaleFlashGetDiscount( $text, $post, $product )
{
	if(zget_option( 'woo_show_sale_flash_discount', 'zn_woocommerce_options' )){
		$discount = 0;
		if( $product->is_on_sale() ){
			if ($product->product_type == 'variable' ) {
				$available_variations = $product->get_available_variations();
				for ( $i = 0; $i < count( $available_variations ); ++$i ) {
					$variation_id = $available_variations[$i]['variation_id'];
					$variable_product1 = new WC_Product_Variation( $variation_id );
					$regular_price = $variable_product1->regular_price;
					$sales_price = $variable_product1->sale_price;
					$percentage = round( ( ( ( $regular_price - $sales_price ) / $regular_price ) * 100 ), 1 );
					if ( $percentage > $discount ) {
						$discount = $percentage;
					}
				}
			}
			elseif ( $product->product_type == 'simple' ) {
				$discount = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
			}

			if ( $discount ) {
				$discount = "-{$discount}%";
			}
			else { $discount  =''; }
			$text = '<span class="zonsale zn_badge_sale">' . sprintf(__( 'Sale! %s', 'zn_framework' ), $discount).'</span>';
		}
	}

	return $text;
}

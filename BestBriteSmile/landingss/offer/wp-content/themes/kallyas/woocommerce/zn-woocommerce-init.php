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
add_action( 'woocommerce_before_main_content', 'zn_woocommerce_before_main_content' );
add_action( 'woocommerce_after_main_content', 'zn_woocommerce_after_main_content' );
function zn_woocommerce_before_main_content(){

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

function zn_woocommerce_after_main_content(){
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

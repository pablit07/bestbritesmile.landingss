<?php if(! defined('ABSPATH')){ return; }
/*
 Name: WooCommerce archive
 Description: Create and display the current post content
 Class: TH_ProductArchive
 Category: content
 Level: 3
 Dependency_class: WooCommerce
*/

/**
 * Class TH_ProductArchive
 *
 * Create and display the current page content
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_ProductArchive extends ZnElements
{
	public static function getName(){
		return __( "WooCommerce archive", 'zn_framework' );
	}

	function zn_woo_loop_columns(){
		return $this->opt( 'num_columns', '4' );
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{

		// Check if this is a normal page or the Shop archive page
		if( ! is_shop()  ){

			global $paged;

			$wc_query = new WC_Query();

			// Get the proper page - this resolves the pagination on static frontpage
			if( get_query_var('paged') ){ $paged = get_query_var('paged'); }
			elseif( get_query_var('page') ){ $paged = get_query_var('page'); }
			else{ $paged = 1; }

			$ordering = $wc_query->get_catalog_ordering_args();

			$queryArgs = array(
				'post_type' => 'product',
				'paged' => $paged,
				'orderby' => $ordering['orderby'],
				'order' => $ordering['order'],
			);


			if ( isset( $ordering['meta_key'] ) ) {
				$queryArgs['meta_key'] = $ordering['meta_key'];
			}

			query_posts($queryArgs);
		}

		// Change the number of columns
		add_filter('loop_shop_columns', array( &$this,'zn_woo_loop_columns') , 999);

		$sidebar_tweak = $this->opt( 'num_columns', '4' ) == 3 ? 'left_sidebar' : '';

		echo '<div class="zn_woo_archive_elemenent woocommerce '.$this->data['uid'].' '.$sidebar_tweak.' '.$this->opt('css_class','').'">';
?>

		<?php if ( $this->opt( 'show_page_title', 'yes' ) == 'yes' ) : ?>
			<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
		<?php endif; ?>

		<?php
		/**
		 * woocommerce_archive_description hook
		 *
		 * @hooked woocommerce_taxonomy_archive_description - 10
		 * @hooked woocommerce_product_archive_description - 10
		 */
		do_action( 'woocommerce_archive_description' );
		?>

		<?php if ( have_posts() ) : ?>

		<?php
		/**
		 * woocommerce_before_shop_loop hook
		 *
		 * @hooked woocommerce_result_count - 20
		 * @hooked woocommerce_catalog_ordering - 30
		 */
		do_action( 'woocommerce_before_shop_loop' );
		?>

		<?php woocommerce_product_loop_start(); ?>

		<?php woocommerce_product_subcategories(); ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'product' ); ?>

		<?php endwhile; // end of the loop. ?>

		<?php woocommerce_product_loop_end(); ?>

		<?php
		/**
		 * woocommerce_after_shop_loop hook
		 *
		 * @hooked woocommerce_pagination - 10
		 */
		do_action( 'woocommerce_after_shop_loop' );
		?>

	<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

		<?php wc_get_template( 'loop/no-products-found.php' ); ?>

	<?php endif; ?>

<?php
wp_reset_postdata();
wp_reset_query();

		echo '</div>';
	}

	 /**
	  * This method is used to display the output of the element.
	  * @return void
	  */
	 function element_edit()
	 {
	     echo '<div class="zn-pb-notification">This element will be rendered only in View Page Mode and not in PageBuilder Edit Mode.</div>';
	 }

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(
					array(
						"name" => __("Number of columns", 'zn_framework'),
						"description" => __("Please choose how many columns you want to use.", 'zn_framework'),
						"id" => "num_columns",
						"std" => "4",
						"options" => array(
							'3' => __('3', 'zn_framework'),
							'4' => __('4', 'zn_framework'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Show page title ?", 'zn_framework'),
						"description" => __("Choose if you want to show the page title.", 'zn_framework'),
						"id" => "show_page_title",
						"std" => "yes",
						"type" => "toggle2",
						"value" => "yes",
					),
				),
			),

			'other' => array(
			    'title' => 'Other Options',
			    'options' => array(

			        array(
			            'id'          => 'css_class',
			            'name'        => 'CSS class',
			            'description' => 'Enter a css class that will be applied to this element. You can than edit the custom css, either in the Page builder\'s CUSTOM CSS (which is loaded only into that particular page), or in Kallyas options > Advanced > Custom CSS which will load the css into the entire website.',
			            'type'        => 'text',
			            'std'         => '',
			        ),

			    ),
			),

			'help' => array(
	            'title' => '<span class="dashicons dashicons-editor-help"></span> HELP',
	            'options' => array(

	                array (
	                    "name"        => __( 'Video Tutorial', 'zn_framework' ),
	                    "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#a6Cr0PG3TFQ" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
	                    "id"          => "video_link",
	                    "std"         => "",
	                    "type"        => "zn_title",
	                    "class"       => "zn_full zn_nomargin"
	                ),

	                // array (
	                //     "name"        => __( 'Written Documentation', 'zn_framework' ),
	                //     "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
	                //     "id"          => "docs_link",
	                //     "std"         => "",
	                //     "type"        => "zn_title",
	                //     "class"       => "zn_full zn_nomargin"
	                // ),

	                array (
	                    "name"        => sprintf(__( '<span data-clipboard-text="%s" data-tooltip="Click to copy ID to clipboard">Unique ID: %s</span> ', 'zn_framework' ), $uid, $uid),
	                    "description" => __( 'In case you need some custom styling use as a css class selector <span class="u-code" data-clipboard-text=".'.$uid.' {  }" data-tooltip="Click to copy CSS class to clipboard">.'.$uid.'</span> .', 'zn_framework' ),
	                    "id"          => "id_element",
	                    "std"         => "",
	                    "type"        => "zn_title",
	                    "class"       => "zn_full zn_nomargin"
	                ),

	                array (
	                    "name"        => __( '<a href="http://support.hogash.com/support/forum/wordpress-themes/kallyas-wordpress-theme/" target="_blank">Support Forums</a> &nbsp; | &nbsp; <a href="http://support.hogash.com/kallyas-help/" target="_blank">Kallyas Video Tutorials & Documentation</a> &nbsp; | &nbsp; <a href="http://themeforest.net/downloads?sort_by=Recent+Updates&filter_by=themeforest.net#item-4091658" target="_blank" class="stars-yellow">Rate Kallyas <span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></a>', 'zn_framework' ),
	                    "id"          => "otherlinks",
	                    "std"         => "",
	                    "type"        => "zn_title",
	                    "class"       => "zn_full zn-custom-title-sm zn_nomargin"
	                ),
	            ),
			),
		);
		return $options;
	}


}

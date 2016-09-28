<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Blog Archive
 Description: Create and display the current post content
 Class: TH_BlogArchive
 Category: content
 Level: 3
*/

/**
 * Class TH_BlogArchive
 *
 * Create and display the current page content
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_BlogArchive extends ZnElements
{
	public static function getName(){
		return __( "Blog archive", 'zn_framework' );
	}

	/**
	 * Load dependant resources
	 */
	function scripts(){
		/*
		 * Load resources in footer
		 */
		wp_enqueue_script('isotope', THEME_BASE_URI.'/js/jquery.isotope.min.js',array ( 'jquery' ), ZN_FW_VERSION, true);

	}



	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{

		global $zn_config, $query_string, $wp_query, $paged;

		// Get the proper page - this resolves the pagination on static frontpage
		if( get_query_var('paged') ){ $paged = get_query_var('paged'); }
		elseif( get_query_var('page') ){ $paged = get_query_var('page'); }
		else{ $paged = 1; }

		$zn_config['blog_columns'] = $this->opt( 'blog_columns', '1' );
		$category = $this->opt('category') ? $this->opt('category') : '';
		$count = $this->opt('count')  ? $this->opt('count') : '4';

		$args = array(
			'posts_per_page' => ( int )$count,
			'post_status' => 'publish',
			'paged' => $paged
		);

        if( !empty( $category ) ){
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'id',
                    'terms' => $category
                ),
            );
        }


		// PERFORM THE QUERY
		query_posts( $args );

		echo '<div class="zn_blog_archive_element '.$this->data['uid'].' '.$this->opt('css_class','').'">';
			if ( $zn_config['blog_columns'] > 1 ) {
				get_template_part( 'blog', 'columns' );
			}
			else {
				get_template_part( 'blog', 'default' );
			}
		echo '</div>';
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_query();
	}

	// TODO : Uncomment this if JS errors appears because of clients shortcodes/plugins
	// /**
	//  * This method is used to display the output of the element.
	//  * @return void
	//  */
	// function element_edit()
	// {
	//     echo '<div class="zn-pb-notification">This element will be rendered only in View Page Mode and not in PageBuilder Edit Mode.</div>';
	// }

	function options() {

		$args = array(
			'type' => 'post'
		);

		$post_categories = get_categories($args);

		$option_post_cat = array();

		foreach ($post_categories as $category) {
			$option_post_cat[$category->cat_ID] = $category->cat_name;
		}

		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(
					array(
						'id'          => 'blog_columns',
						'name'        => 'Blog columns',
						'description' => 'Select the number of columns to use',
						'type'        => 'select',
						'std'		  => '1',
						'options'        => array(
							'1' => '1 column',
							'2' => '2 column',
							'3' => '3 column',
							'4' => '4 column',
						),
					),
					array(
						'id'          => 'category',
						'name'        => 'Categories',
						'description' => 'Select your desired categories for post items to be displayed.',
						'type'        => 'select',
						'options'	  => $option_post_cat,
						'multiple'	  => true
						),
					array(
						'id'          => 'count',
						'name'        => 'Number of items per page',
						'description' => 'Please choose the desired number of items that will be shown on a page',
						'type'        => 'slider',
						'std'		  => '4',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '1',
							'max' => '50',
							'step' => '1'
						),
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
	                    "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#2dkIHxjdCG4" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
	                    "id"          => "video_link",
	                    "std"         => "",
	                    "type"        => "zn_title",
	                    "class"       => "zn_full zn_nomargin"
	                ),

	                array (
	                    "name"        => __( 'Written Documentation', 'zn_framework' ),
	                    "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/blog-archive/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
	                    "id"          => "docs_link",
	                    "std"         => "",
	                    "type"        => "zn_title",
	                    "class"       => "zn_full zn_nomargin"
	                ),

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

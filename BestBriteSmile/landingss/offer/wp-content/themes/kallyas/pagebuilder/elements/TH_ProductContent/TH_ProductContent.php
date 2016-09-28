<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Product item content
 Description: Create and display the current post content
 Class: TH_ProductContent
 Category: content, post
 Level: 3
 Dependency_class: WooCommerce
*/

/**
 * Class TH_ProductContent
 *
 * Create and display the current page content
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_ProductContent extends ZnElements
{
	public static function getName(){
		return __( "Portfolio item content", 'zn_framework' );
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{

		// Prevent the elemnt from being accessible on other pages
		if( ! is_singular( 'product' ) ){
			echo '<div class="zn-pb-notification">This element only works on single product pages created with WooCommerce. Please delete it.</div>';
			return false;
		}

		echo '<div class="zn_post_content_elemenent '.$this->data['uid'].' '.$this->opt('css_class','').'">';
			wc_get_template_part( 'content', 'single-product' );
		echo '</div>';
	}

	function options(){
		$uid = $this->data['uid'];
		$options = array(
            'has_tabs'  => true,
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
     //        'help' => array(
     //            'title' => '<span class="dashicons dashicons-editor-help"></span> HELP',
     //            'options' => array(
					// array (
		   //                  "name"        => __( 'Video Tutorial', 'zn_framework' ),
		   //                  "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
		   //                  "id"          => "video_link",
		   //                  "std"         => "",
		   //                  "type"        => "zn_title",
		   //                  "class"       => "zn_full zn_nomargin"
		   //              ),

		   //              array (
		   //                  "name"        => __( 'Written Documentation', 'zn_framework' ),
		   //                  "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
		   //                  "id"          => "docs_link",
		   //                  "std"         => "",
		   //                  "type"        => "zn_title",
		   //                  "class"       => "zn_full zn_nomargin"
		   //              ),

		   //              array (
		   //                  "name"        => sprintf(__( '<span data-clipboard-text="%s" data-tooltip="Click to copy ID to clipboard">Unique ID: %s</span> ', 'zn_framework' ), $uid, $uid),
		   //                  "description" => __( 'In case you need some custom styling use as a css class selector <span class="u-code" data-clipboard-text=".'.$uid.' {  }" data-tooltip="Click to copy CSS class to clipboard">.'.$uid.'</span> .', 'zn_framework' ),
		   //                  "id"          => "id_element",
		   //                  "std"         => "",
		   //                  "type"        => "zn_title",
		   //                  "class"       => "zn_full zn_nomargin"
		   //              ),

		   //              array (
		   //                  "name"        => __( '<a href="http://support.hogash.com/support/forum/wordpress-themes/kallyas-wordpress-theme/" target="_blank">Support Forums</a> &nbsp; | &nbsp; <a href="http://support.hogash.com/kallyas-help/" target="_blank">Kallyas Video Tutorials & Documentation</a> &nbsp; | &nbsp; <a href="http://themeforest.net/downloads?sort_by=Recent+Updates&filter_by=themeforest.net#item-4091658" target="_blank" class="stars-yellow">Rate Kallyas <span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></a>', 'zn_framework' ),
		   //                  "id"          => "otherlinks",
		   //                  "std"         => "",
		   //                  "type"        => "zn_title",
		   //                  "class"       => "zn_full zn-custom-title-sm zn_nomargin"
		   //              ),
					// ),
	    //         ),
	        );
	        return $options;
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

}

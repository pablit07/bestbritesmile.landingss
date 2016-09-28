<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Call Out Banner
 Description: Create and display a Call Out Banner element
 Class: TH_CallOutBanner
 Category: content
 Level: 3
*/
/**
 * Class TH_CallOutBanner
 *
 * Create and display a Call Out Banner element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    3.8.0
 */
class TH_CallOutBanner extends ZnElements
{
	public static function getName(){
		return __( "Call Out Banner", 'zn_framework' );
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];

		if( empty( $options ) ) { return; }

		$button   = false;
		$div_size = 'col-sm-12';

		if ( ! empty ( $options['cab_button_text'] ) ) {
			$button   = true;
			$div_size = 'col-sm-10';
		}

		echo '<div class="callout-banner clearfix '.$this->data['uid'].' '.$this->opt('css_class','').'">';
			echo '<div class="row">';

			if ( ! empty ( $options['cab_main_title'] ) || ! empty ( $options['cab_sec_title'] ) ) {

				echo '<div class="' . $div_size . '">';

				if ( ! empty ( $options['cab_main_title'] ) ) {
					echo '<h3 class="m_title">' . $options['cab_main_title'] . '</h3>';
				}

				if ( ! empty ( $options['cab_sec_title'] ) ) {
					echo '<p>' . $options['cab_sec_title'] . '</p>';
				}

				echo '</div>';
			}

			if ( $button ) {

				$target = $options['cab_button_link']['target'];
				$link_target = '';
                if($target == '_blank' || $target == '_self'){
                    $link_target .= ' target="' . $target  . '"';
                } else if($target == 'modal'){
                    $link_target .= ' data-lightbox="image"';
                } else if($target == 'modal_iframe'){
                    $link_target .= ' data-lightbox="iframe"';
                } else if($target == 'modal_inline'){
                    $link_target .= ' data-lightbox="inline"';
                } else if($target == 'smoothscroll'){
                    $link_target .= ' data-target="smoothscroll"';
                }

				echo '<div class="col-sm-2">';
					echo '<a href="' . $options['cab_button_link']['url'] . '"
							class="circlehover with-symbol '.$this->opt( 'calloutbox_style', 'style1' ).'"
							data-size=""
							data-position="top-left"
							data-align="right"
							' . $link_target . '>';
						echo '<span class="text">' . $options['cab_button_text'] . '</span>';
						if ( ! empty ( $options['cab_button_image'] ) ) {
							echo '<span class="symbol"><img src="' . $options['cab_button_image'] . '" alt=""></span>';
						}
						else {
							echo '<span class="symbol"><img src="' . THEME_BASE_URI . '/images/ok.png" alt=""></span>';
						}
						echo '<div class="triangle"><span class="play-icon"></span></div>';
					echo '</a>';
				echo '</div>';
			}
			echo '</div>';
		echo '</div>';
	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$uid = $this->data['uid'];

		$options = array (
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(
					array (
						"name"        => __( "Style", 'zn_framework' ),
						"description" => __( "Please select the style you want to use.", 'zn_framework' ),
						"id"          => "calloutbox_style",
						"std"         => "style1",
						"options"     => array (
							'style1'     => __( 'Style 1', 'zn_framework' ),
							'style2'    => __( 'Style 2 (since v4.0)', 'zn_framework' ),
							'style3'    => __( 'Style 3 (since v4.0)', 'zn_framework' )
						),
						"type"        => "select",
						'live'        => array(
							'type'      => 'class',
							'css_class' => '.'.$this->data['uid'] .' .circlehover'
						),
					),
					array (
						"name"        => __( "Main Title", 'zn_framework' ),
						"description" => __( "Enter a title for your Call Out Banner element", 'zn_framework' ),
						"id"          => "cab_main_title",
						"std"         => "",
						"type"        => "textarea",
					),
					array (
						"name"        => __( "Secondary Title", 'zn_framework' ),
						"description" => __( "Enter a secondary title for your Call Out Banner element", 'zn_framework' ),
						"id"          => "cab_sec_title",
						"std"         => "",
						"type"        => "textarea",
					),
				),
			),
			'button' => array(
				'title' => 'Button options',
				'options' => array(
					array (
						"name"        => __( "Button Text", 'zn_framework' ),
						"description" => __( "Please enter a text that will appear on the right button.", 'zn_framework' ),
						"id"          => "cab_button_text",
						"std"         => "",
						"type"        => "text",
					),
					array (
						"name"        => __( "Button Hover Image", 'zn_framework' ),
						"description" => __( "Please select an image that will appear when
											hovering the mouse over the button. If no image is chosen , the default OK image will be used", 'zn_framework' ),
						"id"          => "cab_button_image",
						"std"         => "",
						"type"        => "media",
					),
					array (
						"name"        => __( "Button link", 'zn_framework' ),
						"description" => __( "Please choose the link you want to use for your button.", 'zn_framework' ),
						"id"          => "cab_button_link",
						"std"         => "",
						"type"        => "link",
						"options"     => array (
							'_self'     => __( "Same window", 'zn_framework' ),
							'_blank'    => __( "New window", 'zn_framework' ),
							'modal'     => __( "Modal Image", 'zn_framework' ),
							'modal_iframe'     => __( "Modal Iframe", 'zn_framework' ),
							'modal_inline'     => __( "Modal Inline content", 'zn_framework' ),
							'smoothscroll' => __( "Smooth Scroll to Anchor", 'zn_framework' )
						)
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
	                    "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#q-5UZku-5Jk" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
	                    "id"          => "video_link",
	                    "std"         => "",
	                    "type"        => "zn_title",
	                    "class"       => "zn_full zn_nomargin"
	                ),

	                array (
	                    "name"        => __( 'Written Documentation', 'zn_framework' ),
	                    "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/call-out-banner/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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

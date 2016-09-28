<?php if(! defined('ABSPATH')){ return; }
/*
Name: Action Box
Description: Create and display an Action Box element
Class: TH_ActionBox
Category: header
Level: 3
*/
/**
 * Class TH_ActionBox
 *
 * Create and display an Action Box element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author Team Hogash
 * @since 3.8.0
 */
class TH_ActionBox extends ZnElements
{
	public static function getName(){
		return __( "Action Box", 'zn_framework' );
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];

		if( empty( $options ) ) { return; }

		$style = $this->opt( 'ac_style', 'style1' );

		echo '<div class="action_box '.$style.' '.$this->data['uid'].' '.$this->opt('css_class','').'" data-arrowpos="center">';

			echo '<div class="action_box_inner">';

				echo '<div class="action_box_content">';
					// Title
					$hasTitle = (isset($options['page_ac_title']) && ! empty ($options['page_ac_title']));
					$hasSubtitle = (isset($options['page_ac_subtitle']) && ! empty ($options['page_ac_subtitle']));

					if($hasTitle || $hasSubtitle){
						echo '<div class="ac-content-text">';
					}
						if($hasTitle){
							echo '<h4 class="text">' . do_shortcode( $options['page_ac_title'] ) . '</h4>';
						}
						if($hasSubtitle){
							echo '<h5 class="ac-subtitle">' . do_shortcode( $options['page_ac_subtitle'] ) . '</h5>';
						}
					if($hasTitle || $hasSubtitle){
						echo '</div>';
					}

					// LINK
					$hasButton1 = (isset ( $options['page_ac_b_link']['url'] ) && !empty($options['page_ac_b_link']['url']) && !empty ($options['page_ac_b_text']));
					$hasButton2 = (isset ( $options['page_ac_b_link2']['url'] ) && !empty($options['page_ac_b_link2']['url']) && !empty ($options['page_ac_b_text2']));

					if($hasButton1 || $hasButton2){
						echo '<div class="ac-buttons">';
					}
						if($hasButton1){

							$link_target = '';
							$target = $options['page_ac_b_link']['target'];
							if($target == '_blank' || $target == 'self'){
								$link_target = 'target="' . $target  . '"';
							} else if($target == 'modal_image'){
								$link_target = 'data-lightbox="image"';
							} else if($target == 'modal_iframe'){
								$link_target = 'data-lightbox="iframe"';
							} else if($target == 'modal_inline'){
								$link_target = 'data-lightbox="inline"';
							} else if($target == 'smoothscroll'){
								$link_target = 'data-target="smoothscroll"';
							}

							echo '<a class="btn btn-lined ac-btn" href="' . $options['page_ac_b_link']['url'] . '" '.$link_target.'>' . $options['page_ac_b_text'] . '</a>';
						}
						if($hasButton2){

							$link_target_2 = '';
							$target_2 = $options['page_ac_b_link2']['target'];
							if($target_2 == '_blank' || $target_2 == 'self'){
								$link_target_2 = 'target="' . $target_2  . '"';
							} else if($target_2 == 'modal_image'){
								$link_target_2 = 'data-lightbox="image"';
							} else if($target_2 == 'modal_iframe'){
								$link_target_2 = 'data-lightbox="iframe"';
							} else if($target_2 == 'modal_inline'){
								$link_target_2 = 'data-lightbox="inline"';
							} else if($target_2 == 'smoothscroll'){
								$link_target_2 = 'data-target="smoothscroll"';
							}

							echo '<a class="btn btn-fullwhite ac-btn" href="' . $options['page_ac_b_link2']['url'] . '" ' . $link_target_2 . '>' . $options['page_ac_b_text2'] . '</a>';
						}

					if($hasButton1 || $hasButton2){
						echo '</div>';
					}

				echo '</div>';
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
	                    "name"        => sprintf(__( '<span data-clipboard-text="%s" data-tooltip="Click to copy ID to clipboard">Unique ID: %s</span> ', 'zn_framework' ), $uid, $uid),
	                    "description" => __( 'In case you need some custom styling use as a css class selector <span class="u-code" data-clipboard-text=".'.$uid.' {  }" data-tooltip="Click to copy CSS class to clipboard">.'.$uid.'</span> .', 'zn_framework' ),
	                    "id"          => "ibstg_uid",
	                    "std"         => "",
	                    "type"        => "zn_title",
	                    "class"       => "zn_full zn_nomargin"
	                ),

					array (
						"name"        => __( "Element Style", 'zn_framework' ),
						"description" => __( "Please select the style you want to use.", 'zn_framework' ),
						"id"          => "ac_style",
						"std"         => "style1",
						"options"     => array (
							'style1' => __( 'Style 1', 'zn_framework' ),
							'style2' => __( 'Style 2', 'zn_framework' ),
							'style3' => __( 'Style 3', 'zn_framework' ),
						),
						"type"        => "select",
						'live' => array(
							'type'		=> 'class',
							'css_class' => '.'.$this->data['uid']
						)
					),
					array (
						"name"        => __( "Action Box Title", 'zn_framework' ),
						"description" => __( "Enter a title for your action box", 'zn_framework' ),
						"id"          => "page_ac_title",
						"std"         => "",
						"type"        => "textarea"
					),
					array (
						"name"        => __( "Action Box Subtitle", 'zn_framework' ),
						"description" => __( "Enter a subtitle for the action box", 'zn_framework' ),
						"id"          => "page_ac_subtitle",
						"std"         => "",
						"type"        => "textarea"
					),
				),
			),
			'buttons' => array(
				'title' => 'Button options',
				'options' => array(
					array (
						"name"        => __( "Action Box Button Text", 'zn_framework' ),
						"description" => __( "Please enter a text that will appear inside your action box button.", 'zn_framework' ),
						"id"          => "page_ac_b_text",
						"std"         => "",
						"type"        => "text"
					),
					array (
						"name"        => __( "Action Box link", 'zn_framework' ),
						"description" => __( "Please choose the link you want to use for your action box button.", 'zn_framework' ),
						"id"          => "page_ac_b_link",
						"std"         => "",
						"type"        => "link",
						"options"     => array (
							'_blank' => __( "New window", 'zn_framework' ),
							'_self'  => __( "Same window", 'zn_framework' ),
							'modal_image'  => __( "Modal Image", 'zn_framework' ),
							'modal_iframe'  => __( "Modal Iframe", 'zn_framework' ),
							'modal_inline'  => __( "Modal Inline (#custom_link)", 'zn_framework' ),
							'smoothscroll' => __( "Smooth Scroll to Anchor", 'zn_framework' )
						)
					),
					array (
						"name"        => __( "Action Box Secondary Button Text", 'zn_framework' ),
						"description" => __( "Please enter a text that will appear inside your action box secondary button.", 'zn_framework' ),
						"id"          => "page_ac_b_text2",
						"std"         => "",
						"type"        => "text"
					),
					array (
						"name"        => __( "Action Box Secondary link", 'zn_framework' ),
						"description" => __( "Please choose the link you want to use for your action box secondary button.", 'zn_framework' ),
						"id"          => "page_ac_b_link2",
						"std"         => "",
						"type"        => "link",
						"options"     => array (
							'_blank' => __( "New window", 'zn_framework' ),
							'_self'  => __( "Same window", 'zn_framework' ),
							'modal_image'  => __( "Modal Image", 'zn_framework' ),
							'modal_iframe'  => __( "Modal Iframe", 'zn_framework' ),
							'modal_inline'  => __( "Modal Inline (#custom_link)", 'zn_framework' ),
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
	                    "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#PMwI-Jsy1Ck&list" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
	                    "id"          => "video_link",
	                    "std"         => "",
	                    "type"        => "zn_title",
	                    "class"       => "zn_full zn_nomargin"
	                ),

	                array (
	                    "name"        => __( 'Written Documentation', 'zn_framework' ),
	                    "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/action-box/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
	                    "id"          => "docs_link",
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

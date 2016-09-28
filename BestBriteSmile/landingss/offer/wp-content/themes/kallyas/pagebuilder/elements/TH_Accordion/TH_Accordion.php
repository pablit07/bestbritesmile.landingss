<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Accordion
 Description: Create and display an Accordion element
 Class: TH_Accordion
 Category: content
 Level: 3
 Multiple: true
*/
/**
 * Class HT_Accordion
 *
 * Create and display an Accordion element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author Team Hogash
 * @since 3.8.0
 */
class TH_Accordion extends ZnElements
{
	public static function getName(){
		return __( "Accordion", 'zn_framework' );
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{

		$GLOBALS['options'] = array(
			'accordion' => $this->data['options']
		);
		include( 'inc/ui.inc.php' );
	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$extra_options = array (
			"name"           => __( "Accordions", 'zn_framework' ),
			"description"    => __( "Here you can create your desired accordions.", 'zn_framework' ),
			"id"             => "accordion_single",
			"std"            => "",
			"type"           => "group",
			"group_sortable" => true,
			"element_title" => "acc_single_title",
			"subelements"    => array (
				array (
					"name"        => __( "Title", 'zn_framework' ),
					"description" => __( "Please enter a title for this accordion.", 'zn_framework' ),
					"id"          => "acc_single_title",
					"std"         => "",
					"type"        => "text"
				),
				array (
					"name"        => __( "Auto Colapsed", 'zn_framework' ),
					"description" => __( "Select yes if you want this accordion to be visible on page load.", 'zn_framework' ),
					"id"          => "acc_colapsed",
					"std"         => "no",
					"options"     => array (
						'yes' => __( 'Yes', 'zn_framework' ),
						'no'  => __( 'No', 'zn_framework' )
					),
					"type"        => "select"
				)
			)
		);

		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(

					array (
						"name"        => __( "Title", 'zn_framework' ),
						"description" => __( "Enter a title for your Accordion element", 'zn_framework' ),
						"id"          => "acc_title",
						"std"         => "",
						"type"        => "text",
					),
					array (
						"name"        => __( "Accordion Style", 'zn_framework' ),
						"description" => __( "Please select the style you want to use.", 'zn_framework' ),
						"id"          => "acc_style",
						"std"         => "default-style",
						"options"     => array (
							'default-style' => __( 'Style 1', 'zn_framework' ),
							'style2'        => __( 'Style 2', 'zn_framework' ),
							'style3'        => __( 'Style 3', 'zn_framework' ),
							'style4'        => __( 'Style 4', 'zn_framework' ),
						),
						"type"        => "select",
						'live' => array(
	                            'multiple' => array(
	                                array(
										'type'        => 'class',
										'css_class' => '.' . $this->data['uid'],
										'val_prepend'   => 'zn-acc--',
	                                ),
	                                array(
										'type'        => 'class',
										'css_class' => '.' . $this->data['uid'] . ' .panel-group',
										'val_prepend'   => 'acc--',
	                                ),
	                            )
	                        )
					),
					array (
						"name"        => __( "Collapse Behaviour", 'zn_framework' ),
						"description" => __( "Select the behaviour of the collapsible panels. Upon click, Accordion Functionality will close other panels, while toggle just opens/closes the current clicked panel.", 'zn_framework' ),
						"id"          => "acc_behaviour",
						"std"         => "tgg",
						"options"     => array (
							'tgg' => __( 'Toggle', 'zn_framework' ),
							'acc'  => __( 'Accordion', 'zn_framework' )
						),
						"type"        => "select"
					),
					$extra_options,
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
	                    "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#gIrgHl-BrLQ" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
	                    "id"          => "video_link",
	                    "std"         => "",
	                    "type"        => "zn_title",
	                    "class"       => "zn_full zn_nomargin"
	                ),

	                array (
	                    "name"        => __( 'Written Documentation', 'zn_framework' ),
	                    "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/accordion/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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

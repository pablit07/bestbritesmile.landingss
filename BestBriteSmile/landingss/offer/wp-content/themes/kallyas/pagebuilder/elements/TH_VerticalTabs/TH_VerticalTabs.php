<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Vertical Tabs
 Description: Create and display a Vertical Tabs element
 Class: TH_VerticalTabs
 Category: content
 Level: 3
 Multiple: true
*/

/**
 * Class TH_VerticalTabs
 *
 * Create and display a Vertical Tabs element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_VerticalTabs extends ZnElements
{
	public static function getName(){
		return __( "Vertical Tabs", 'zn_framework' );
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];
		$uid = $this->data['uid'];
		$vtabsStyle = $this->opt('vtabs_style', 'kl-style-2');

		$single_tabs = $this->opt('single_vertical_tab', array() );
		$tabsListCount = count($single_tabs);

		if( empty ( $single_tabs ) ){
			return;
		}

		// Begin render
		echo '<div class="vertical_tabs ' . $vtabsStyle . ' '.$uid.' '.$this->opt('css_class','').' clearfix">';
			echo '<div class="tabbable">';

				echo '<ul class="nav fixclear">';

				$content = '';

				for ($i = 0; $i < $tabsListCount; $i++ ){
					$cls  = '';
					$icon = '';

					if ( $i == 0 ) {
						$cls = 'active';
					}

					$uniq_name = $uid.'_'.$i;

					// ICON CHECK
					if ( ! empty ( $single_tabs[$i]['vts_tab_icon'] ) ) {
						$iconHolder = $single_tabs[$i]['vts_tab_icon'];
						$icon = !empty( $iconHolder['family'] )  ? '<span '.zn_generate_icon( $single_tabs[$i]['vts_tab_icon'] ).'></span>' : '';
					}

					// Tab Handle
					echo '<li class="' . $cls . '">';
						echo '<a href="#tabs_v2-pane' . $uniq_name . '" data-toggle="tab">';
						echo $icon;
						echo $single_tabs[$i]['vts_tab_title'];
					echo '</a>';

					echo '</li>';

				}

				echo '</ul>';

				echo '<div class="tab-content">';

					// foreach ( $single_tabs as $tab )
					for ($i = 0; $i < $tabsListCount; $i++ )
					{
						$cls = $content = '';
						$uniq_name = $uid.'_'.$i;
						if ( $i === 0 ) {
							$cls = 'active';
						}

                        // Convert the old content to PB elements
                        if( empty( $this->data['content'][$i] ) && ( ! empty( $single_tabs[$i]['vts_tab_c_title'] ) || ! empty( $single_tabs[$i]['vts_tab_c_content'] ) ) ){
                            $textbox = ZNPB()->add_module_to_layout( 'TH_TextBox', array( 'stb_title' => $single_tabs[$i]['vts_tab_c_title'], 'stb_content' => $single_tabs[$i]['vts_tab_c_content'], 'stb_title_heading' => 'h4' ) );
                            $column = ZNPB()->add_module_to_layout( 'ZnColumn', array() , array( $textbox ), 'col-sm-12' );
                            $this->data['content'][$i] = array ( $column );
                        }

						echo '<div class="tab-pane fade in ' . $cls . ' row zn_columns_container zn_content" data-droplevel="1" id="tabs_v2-pane' . $uniq_name . '">';

                            if ( empty( $this->data['content'][$i] ) ) {
                                $column = ZNPB()->add_module_to_layout( 'ZnColumn', array() , array(), 'col-sm-12' );
                                $this->data['content'][$i] = array ( $column );
                            }

                            if ( !empty( $this->data['content'][$i] ) ) {
                                ZNPB()->zn_render_content( $this->data['content'][$i] );
                            }

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
		$extra_options = array (
			"name"           => __( "Tabs", 'zn_framework' ),
			"description"    => __( "Here you can add your desired tabs.", 'zn_framework' ),
			"id"             => "single_vertical_tab",
			"std"            => "",
			"type"           => "group",
			"add_text"       => __( "Tab", 'zn_framework' ),
			"remove_text"    => __( "Tab", 'zn_framework' ),
			"group_sortable" => true,
            "element_title" => "vts_tab_title",
			"subelements"    => array (
				array (
					"name"        => __( "Tab Title", 'zn_framework' ),
					"description" => __( "Please enter the desired title that will appear as tab.", 'zn_framework' ),
					"id"          => "vts_tab_title",
					"std"         => "",
					"type"        => "text"
				),
				array (
					"name"        => __( "Tab icon", 'zn_framework' ),
					"description" => __( "Select your desired icon that will appear on the left side of the tab title.", 'zn_framework' ),
					"id"          => "vts_tab_icon",
					"std"         => "",
					"type"        => "icon_list",
					'class'       => 'zn_full',
				),
			)
		);
		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(
					array (
						"name"        => __( "Select style", 'zn_framework' ),
						"description" => __( "Select the desired style for this element", 'zn_framework' ),
						"id"          => "vtabs_style",
						"type"        => "select",
						"std"         => "kl-style-2",
						"options"     => array (
							'kl-style-1' => __( 'Style 1', 'zn_framework' ),
							'kl-style-2' => __( 'Style 2', 'zn_framework' ),
						),
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
	                    "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#dSJi2pegFow" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
	                    "id"          => "video_link",
	                    "std"         => "",
	                    "type"        => "zn_title",
	                    "class"       => "zn_full zn_nomargin"
	                ),

	                array (
	                    "name"        => __( 'Written Documentation', 'zn_framework' ),
	                    "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/vertical-tabs/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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

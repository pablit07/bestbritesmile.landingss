<?php
/*
	Name: Custom Container
	Description: This element will generate a custom container in which you can add elements
	Class: ZnCustomContainer
	Category: Layout
	Level: 3
    Style: true
*/

	class ZnCustomContainer extends ZnElements {

	function options() {
		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'background' => array(
				'title' => 'Style options',
				'options' => array(
					array(
						'id'          => 'background_color',
						'name'        => 'Background color',
						'description' => 'Here you can choose a custom background color for this container.',
						'type'        => 'colorpicker',
						'std'         => '',
						'live'        => array(
							'type'		=> 'css',
							'css_class' => '.'.$this->data['uid'],
							'css_rule'	=> 'background-color',
							'unit'		=> ''
						)
					),
					array(
                        'id'          => 'background_color_opacity',
                        'name'        => 'Background Color\'s opacity.',
                        'description' => 'Overlay background colors opacity level.',
                        'type'        => 'slider',
                        'std'         => '100',
                        "helpers"     => array (
                            "step" => "1",
                            "min" => "1",
                            "max" => "100"
                        ),
                    ),
					array(
						'id'          => 'background_image',
						'name'        => 'Background image',
						'description' => 'Please choose a background image for this section.',
						'type'        => 'background',
						'options' => array( "repeat" => true , "position" => true , "attachment" => true, "size" => true ),
						'class'		  => 'zn_full'
					),
				)
			),
			'padding' => array(
				'title' => 'Padding options',
				'options' => array(
					array(
						'id'          => 'pad_type',
						'name'        => 'Equaliser padding',
						'description' => "Equalizer padding should only be used inside a full-width container and will help to display a proper alignment of the element's left or right edge in context to the site's container left and/or right boundries.<br> Make sure you select 'First' only if the column is the first in the row. Select 'Last' if the element is on the last column from the row.",
						'type'        => 'select',
						'std'        => '',
						'options' => array(
							"" => 'Disabled',
							"eq_first" => 'First Column Equalizer',
							"eq_last" => 'Last Column Equalizer'
						)
					),

					array(
						'id'          => 'top_padding',
						'name'        => 'Top padding',
						'description' => 'Select the top padding (in percent) for this container.',
						'type'        => 'slider',
						'std'		  => '1',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '0',
							'max' => '100',
							'step' => '1'
						),
						'live' => array(
							'type'		=> 'css',
							'css_class' => '.'.$this->data['uid'],
							'css_rule'	=> 'padding-top',
							'unit'		=> '%'
						)
					),
					array(
						'id'          => 'right_padding',
						'name'        => 'Right padding',
						'description' => 'Select the right padding (in percent) for this container.',
						'type'        => 'slider',
						'std'		  => '0',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '0',
							'max' => '100',
							'step' => '1'
						),
						'live' => array(
							'type'		=> 'css',
							'css_class' => '.'.$this->data['uid'],
							'css_rule'	=> 'padding-right',
							'unit'		=> '%'
						),
                		"dependency"  => array( 'element' => 'pad_type' , 'value'=> array('','eq_first') ),
					),
					array(
						'id'          => 'bottom_padding',
						'name'        => 'Bottom padding',
						'description' => 'Select the bottom padding (in percent) for this container.',
						'type'        => 'slider',
						'std'		  => '0',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '0',
							'max' => '100',
							'step' => '1'
						),
						'live' => array(
							'type'		=> 'css',
							'css_class' => '.'.$this->data['uid'],
							'css_rule'	=> 'padding-bottom',
							'unit'		=> '%'
						)
					),
					array(
						'id'          => 'left_padding',
						'name'        => 'Left padding',
						'description' => 'Select the left padding (in percent) for this container.',
						'type'        => 'slider',
						'std'		  => '0',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '0',
							'max' => '100',
							'step' => '1'
						),
						'live' => array(
							'type'		=> 'css',
							'css_class' => '.'.$this->data['uid'],
							'css_rule'	=> 'padding-left',
							'unit'		=> '%'
						),
		                "dependency"  => array( 'element' => 'pad_type' , 'value'=> array('','eq_last') ),
					),
				)
			),
			'border' => array(
				'title' => 'Border options',
				'options' => array(
					array (
							'id'          => 'border_style',
							'name'        => 'Border style',
							'description' => 'Select a border style you wish to use for this container.',
							'type'        => 'select',
							'options'	  => array( 'none'		=> 'None',
													'solid'		=> 'Solid',
													'dotted'	=> 'Dotted',
													'dashed'	=> 'Dashed',
													'double'	=> 'Double',
													'groove'	=> 'Groove',
													'ridge'		=> 'Ridge',
													'inset'		=> 'Inset',
													'outset'	=> 'Outset'),
							'live' => array(
								'type'		=> 'css',
								'css_class' => '.'.$this->data['uid'],
								'css_rule'	=> 'border-style',
								'unit'		=> ''
							)
						),
					array(
						'id'          => 'border_width',
						'name'        => 'Border width',
						'description' => 'Select the border width you wish to use for this container.',
						'type'        => 'slider',
						'std'		  => '0',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '0',
							'max' => '100',
							'step' => '1'
						),
						'live' => array(
							'type'		=> 'css',
							'css_class' => '.'.$this->data['uid'],
							'css_rule'	=> 'border-width',
							'unit'		=> 'px'
						)
					),
					array(
						'id'          => 'border_color',
						'name'        => 'Border color',
						'description' => 'Here you can override the background color for this section.',
						'type'        => 'colorpicker',
						'std'         => '',
						'live'        => array(
												'type'		=> 'css',
												'css_class' => '.'.$this->data['uid'],
												'css_rule'	=> 'border-color',
												'unit'		=> ''
											)
					),
					array(
						'id'          => 'corner_radius',
						'name'        => 'Corner radius',
						'description' => 'Select a corner radius (in pixels) for this container.',
						'type'        => 'slider',
						'std'		  => '0',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '0',
							'max' => '400',
							'step' => '1'
						),
						'live' => array(
							'type'		=> 'css',
							'css_class' => '.'.$this->data['uid'],
							'css_rule'	=> 'border-radius',
							'unit'		=> 'px'
						)
					),
				)
			),
			'advanced' => array(
				'title' => 'Advanced',
				'options' => array(
					array(
                        'id'          => 'gutter_size',
                        'name'        => 'Gutter Size',
                        'description' => 'Select the gutter distance between columns',
                        "std"         => "",
                        "type"        => "select",
                        "options"     => array (
                            '' => __( 'Default (15px)', 'zn_framework' ),
                            'gutter-xs' => __( 'Extra Small (5px)', 'zn_framework' ),
                            'gutter-sm' => __( 'Small (10px)', 'zn_framework' ),
                            'gutter-md' => __( 'Medium (25px)', 'zn_framework' ),
                            'gutter-lg' => __( 'Large (40px)', 'zn_framework' ),
                            'gutter-0' => __( 'No distance - 0px', 'zn_framework' ),
                        ),
                        'live' => array(
                            'type'      => 'class',
                            'css_class' => '.'.$this->data['uid']
                        )
                    ),
					array(
					    'id'          => 'css_class',
					    'name'        => 'CSS class',
					    'description' => 'Enter a css class that will be applied to this element. You can than edit the custom css, either in the Page builder\'s CUSTOM CSS (which is loaded only into that particular page), or in Kallyas options > Advanced > Custom CSS which will load the css into the entire website.',
					    'type'        => 'text',
					    'std'         => '',
					),
				)
			),
			'help' => array(
	            'title' => '<span class="dashicons dashicons-editor-help"></span> HELP',
	            'options' => array(

	                array (
	                    "name"        => __( 'Video Tutorial', 'zn_framework' ),
	                    "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#Dg_OJQDUZoI" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
	                    "id"          => "video_link",
	                    "std"         => "",
	                    "type"        => "zn_title",
	                    "class"       => "zn_full zn_nomargin"
	                ),

	                array (
	                    "name"        => __( 'Written Documentation', 'zn_framework' ),
	                    "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/custom-container/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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

	function element() {

		$pad_type = $this->opt('pad_type','');
		$pt_class = !empty($pad_type) ? 'zn_col_'.$pad_type : '';

	?>
	<div class="row zn_columns_container zn_content zn_custom_container <?php echo $this->data['uid']; ?> <?php echo $pt_class; ?> <?php echo $this->opt('gutter_size','') ?> <?php echo $this->opt('css_class',''); ?>" data-droplevel="1">
	<?php
		if ( empty( $this->data['content']) ) {
			$column = ZN()->pagebuilder->add_module_to_layout( 'ZnColumn', array() , array(), 'col-sm-12' );
			$this->data['content'] = array ( $column );
		}
		if ( !empty( $this->data['content'] ) ) {
            ZN()->pagebuilder->zn_render_content( $this->data['content'] );
        }
	?>

	</div>


	<?php
	}

	function css(){

		//print_z($this);
		$uid = $this->data['uid'];
		$pad_type = $this->opt('pad_type','');

		$tpadding = $this->opt('top_padding') || $this->opt('top_padding') === '0' ? 'padding-top : '.$this->opt('top_padding').'%;' : 'padding-top:1%;';
		$rpadding = $this->opt('right_padding') && $pad_type != 'eq_last' ? 'padding-right : '.$this->opt('right_padding').'%;' : '';
		$bpadding = $this->opt('bottom_padding') ? 'padding-bottom:'.$this->opt('bottom_padding').'%;' : '';
		$lpadding = $this->opt('left_padding') && $pad_type != 'eq_first' ? 'padding-left:'.$this->opt('left_padding').'%;' : '';

		$stored_background = $this->opt('background_image', false);
		$background_color = $this->opt('background_color', '');
		$background_color_opacity = $this->opt('background_color_opacity', '100');

		//** Set the background image for the container
		$background_image = '';
		if ( $stored_background && !empty( $stored_background['image'] ) ){
			$background_image = "background-image: url('".$stored_background['image']."');";
			$background_image .= 'background-repeat:'. $stored_background['repeat'].';';
			$background_image .= 'background-position:'. $stored_background['position']['x'].' '.$stored_background['position']['y'].';';
			$background_image .= 'background-attachment:'. $stored_background['attachment'].';';
			$background_image .= 'background-size:'. $stored_background['size'].';';
		}

		//** Set the background color for the container
		$bkg_color = '';
		if (!empty($background_color))
		{
			$bkg_color = " background-color:".zn_hex2rgba_str($background_color, $background_color_opacity)." !important; ";
		}

		//** Set the border for the container
		$border = "";
		$border_style = $this->opt('border_style','none');
		if ($border_style !== 'none') {
			$border_width = $this->opt('border_width',0);
			$border_color = $this->opt('border_color','transparent');
			$border = " border-style:$border_style; border-width:{$border_width}px; border-color:$border_color;";
		}

		//** Set the corner radius
		$border_radius = "";
		$corner_radius = $this->opt('corner_radius','');
		if (!empty($corner_radius))
		{
			$border_radius =  "-moz-border-radius:{$corner_radius}px; -webkit-border-radius:{$corner_radius}px; border-radius:{$corner_radius}px;";
		}

		$css = ".$uid { $tpadding $rpadding $bpadding $lpadding $background_image $bkg_color $border $border_radius } ";

		return $css;
	}

}

?>

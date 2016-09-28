<?php
/*
	Name: Separator
	Description: This element will generate a separator line
	Class: ZnSeparator
	Category: Content, Fullwidth
	Level: 3
*/

class ZnSeparator extends ZnElements {

	function options() {

		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(
					array(
						'id'          => 'top_margin',
						'name'        => 'Top margin',
						'description' => 'Select the top margin (in pixels).',
						'type'        => 'slider',
						'std'		  => '0',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '0',
							'max' => '500',
							'step' => '1'
						),
						'live' => array(
							'type'		=> 'css',
							'css_class' => '.'.$this->data['uid'],
							'css_rule'	=> 'margin-top',
							'unit'		=> 'px'
						)
					),
					array(
						'id'          => 'bottom_margin',
						'name'        => 'Bottom margin',
						'description' => 'Select the bottom margin (in pixels).',
						'type'        => 'slider',
						'std'		  => '35',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '0',
							'max' => '500',
							'step' => '1'
						),
						'live' => array(
							'type'		=> 'css',
							'css_class' => '.'.$this->data['uid'],
							'css_rule'	=> 'margin-bottom',
							'unit'		=> 'px'
						)
					),
	                array(
						'id'          => 'color',
						'name'        => 'Separator color',
						'description' => 'Select the color for separator line.',
						'type'        => 'colorpicker',
						'std'		  => '', // zget_option( 'default_text_color' , 'style_options' ),
	                    'live' => array(
	                        'type'		=> 'css',
	                        'css_class' => '.'.$this->data['uid'],
	                        'css_rule'	=> 'border-top-color',
	                        'unit'		=> ''
	                    )
					),
	                array(
						'id'          => 'height',
						'name'        => 'Separator height',
						'description' => 'Select the separator line height (in pixels).',
						'type'        => 'slider',
						'std'		  => '1',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '0',
							'max' => '15',
							'step' => '1'
						),
						'live' => array(
							'type'		=> 'css',
							'css_class' => '.'.$this->data['uid'],
							'css_rule'	=> 'border-top-width',
							'unit'		=> 'px'
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
	                    "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#D_3o10kKikk" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
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

	/**
	 * Output the element
	 * IMPORTANT : The UID needs to be set on the top parent container
	 */
	function element() {
		?>
			<div class="zn_separator clearfix <?php echo $this->data['uid']; ?> <?php echo $this->opt('css_class',''); ?>"></div>
		<?php
	}


	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){

		$tmargin = $this->opt('top_margin')  || $this->opt('top_margin') === '0' ? 'margin-top : '.$this->opt('top_margin').'px;' : '';
		$bmargin = $this->opt('bottom_margin') || $this->opt('bottom_margin') === '0' ? 'margin-bottom:'.$this->opt('bottom_margin').'px;' : 'margin-bottom:35px;';
		$height = $this->opt('height') || $this->opt('height') === '0' ? 'border-top-width:'.$this->opt('height').'px;' : 'border-top-width:1px;';
        $color = $this->opt('color') ? 'border-top-color:'.$this->opt('color').';' : 'border-top-color:transparent;';
		$uid = $this->data['uid'];

		$css = ".$uid {
				$tmargin
				$bmargin
                $height
                $color
		}";

		return $css;
	}

}

?>
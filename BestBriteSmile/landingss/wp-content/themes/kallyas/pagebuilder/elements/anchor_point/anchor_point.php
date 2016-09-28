<?php
/*
	Name: Anchor Point
	Description: This element will generate an empty element with an unique ID that can be used as an achor point
	Class: ZnAnchorPoint
	Category: content
	Level: 3

*/

	class ZnAnchorPoint extends ZnElements {

    function options() {

    	$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(

					array (
						'id'          => 'id',
						'name'        => 'ID',
						'description' => 'Please enter an id for this anchor point. You can use this #id for an anchor href.',
                        'std'         => $this->data['uid'],
						'type'        => 'text'
					),

				),
			),

	        'help' => array(
	            'title' => '<span class="dashicons dashicons-editor-help"></span> HELP',
	            'options' => array(

	                array (
	                    "name"        => __( 'Video Tutorial', 'zn_framework' ),
	                    "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#GAiAelvoOg4" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
	                    "id"          => "video_link",
	                    "std"         => "",
	                    "type"        => "zn_title",
	                    "class"       => "zn_full zn_nomargin"
	                ),

	                array (
	                    "name"        => __( 'Written Documentation', 'zn_framework' ),
	                    "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/anchor-point-element/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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

		);

		return $options;

	}

	function element(){
         $element_id = $this->opt('id') ? $this->opt('id') : $this->data['uid'];
			echo '<div id="'.esc_attr( $element_id ).'" class="zn_anchor_point '.$this->opt('css_class','').'"></div>';
	}


	function element_edit() {

		$element_id = $this->opt('id') ? $this->opt('id') : $this->data['uid'];
		echo '<div id="'.esc_attr( $element_id ).'" class="zn_anchor_point '.$this->opt('css_class','').'">'.$element_id.'</div>';

	}
	}

?>
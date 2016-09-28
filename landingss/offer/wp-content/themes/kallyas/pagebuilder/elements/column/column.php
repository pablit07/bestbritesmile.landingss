<?php
/*
	Name: Column
	Description: This element will generate a column in which you can add elements
	Class: ZnColumn
	Category: Layout
	Level: 2
	Flexible: true
    Style: true
*/

	class ZnColumn extends ZnElements {

	function options() {

		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(
					array(
						'id'          => 'column_offset',
						'name'        => 'Column offset',
						'description' => 'Here you can define an offset for this column',
						'type'        => 'select',
						'options'        => array(
								'' => 'No offset',
								'col-sm-offset-1' => '1 offset',
								'col-sm-offset-2' => '2 offset',
								'col-sm-offset-3' => '3 offset',
								'col-sm-offset-4' => '4 offset',
								'col-sm-offset-5' => '5 offset',
								'col-sm-offset-6' => '6 offset',
								'col-sm-offset-7' => '7 offset',
								'col-sm-offset-8' => '8 offset',
								'col-sm-offset-9' => '9 offset',
								'col-sm-offset-10' => '10 offset',
								'col-sm-offset-11' => '11 offset'
							),
						'live' => array(
							'type'		=> 'class',
							'css_class' => '.zn_pb_el_container[data-uid="'.$this->data['uid'].'"]'
						)
					),
					array(
						'id'          => 'size_large',
						'name'        => 'Control Size on Large screens',
						'description' => 'Select a size for this column on large devices (Desktops)(>= 1200px). By default the md/sm column sizes are applied to large screens too, this option only forces another column width on large screens.',
						'type'        => 'select',
						'std'        => '',
						'options'        => array(
								'' => 'Default',
								'col-lg-1' => '1/12',
								'col-lg-2' => '2/12',
								'col-lg-3' => '3/12',
								'col-lg-4' => '4/12',
								'col-lg-5' => '5/12',
								'col-lg-6' => '6/12',
								'col-lg-7' => '7/12',
								'col-lg-8' => '8/12',
								'col-lg-9' => '9/12',
								'col-lg-10' => '10/12',
								'col-lg-11' => '11/12',
								'col-lg-12' => '12/12',
								'col-lg-1-5' => '1/5',
							)
					),
					array(
						'id'          => 'size_small',
						'name'        => 'Size on small screens',
						'description' => 'Select a size for this column on small devices (Tablets)(>= 768px)',
						'type'        => 'select',
						'options'        => array(
								'' => 'Default',
								'col-sm-1' => '1/12',
								'col-sm-2' => '2/12',
								'col-sm-3' => '3/12',
								'col-sm-4' => '4/12',
								'col-sm-5' => '5/12',
								'col-sm-6' => '6/12',
								'col-sm-7' => '7/12',
								'col-sm-8' => '8/12',
								'col-sm-9' => '9/12',
								'col-sm-10' => '10/12',
								'col-sm-11' => '11/12',
								'col-sm-12' => '12/12',
								'col-sm-1-5' => '1/5',
							)
					),
					array(
						'id'          => 'size_xsmall',
						'name'        => 'Size on extra small screens',
						'description' => 'Select a size for this column on extra small devices (Phones)(<768px)',
						'type'        => 'select',
						'options'        => array(
								'' => 'Default',
								'col-xs-1' => '1/12',
								'col-xs-2' => '2/12',
								'col-xs-3' => '3/12',
								'col-xs-4' => '4/12',
								'col-xs-5' => '5/12',
								'col-xs-6' => '6/12',
								'col-xs-7' => '7/12',
								'col-xs-8' => '8/12',
								'col-xs-9' => '9/12',
								'col-xs-10' => '10/12',
								'col-xs-11' => '11/12',
								'col-xs-12' => '12/12',
								'col-xs-1-5' => '1/5',
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
	                    "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#hBPFBT437_M" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
	                    "id"          => "video_link",
	                    "std"         => "",
	                    "type"        => "zn_title",
	                    "class"       => "zn_full zn_nomargin"
	                ),

	                array (
	                    "name"        => __( 'Written Documentation', 'zn_framework' ),
	                    "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/column/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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

		$column_offset = ( $this->opt('column_offset') && !ZN()->pagebuilder->is_active_editor ) ? ' '.$this->opt('column_offset').' ' : '';
		$width = ( $this->data['width'] ) ? $this->data['width'] : 'col-md-12';
		$size_small = $this->opt('size_small', str_replace("md","sm",$width));
		$size_xsmall = $this->opt('size_xsmall','');
		$size_large = $this->opt('size_large','');
	?>

		<div class="<?php echo $this->data['uid']; ?> <?php echo $column_offset.' '.$width.' '.$size_small.' '.$size_xsmall.' '.$size_large.' '.$this->opt('css_class',''); ?> zn_sortable_content zn_content " data-droplevel="2">
			<?php ZN()->pagebuilder->zn_render_content( $this->data['content'] ); ?>
		</div>
	<?php
	}

}

?>
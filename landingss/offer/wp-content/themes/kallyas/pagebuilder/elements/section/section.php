<?php
/*
	Name: Section
	Description: This element will generate a section in which you can add elements
	Class: ZnSection
	Category: Layout, Fullwidth
	Level: 1
	Style: true

*/

class ZnSection extends ZnElements {

	function options() {

        $uid = $this->data['uid'];

		$options = array(
            'has_tabs'  => true,
            'general' => array(
                'title' => 'General options',
                'options' => array(
					array(
						'id'          => 'top_padding',
						'name'        => 'Top padding',
						'description' => 'Select the top padding ( in pixels ) for this section.',
						'type'        => 'slider',
						'std'		  => '35',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '0',
							'max' => '400',
							'step' => '1'
						),
						'live' => array(
							'type'		=> 'css',
							'css_class' => '.'.$uid,
							'css_rule'	=> 'padding-top',
							'unit'		=> 'px'
						)
					),
					array(
						'id'          => 'bottom_padding',
						'name'        => 'Bottom padding',
						'description' => 'Select the bottom padding ( in pixels ) for this section.',
						'type'        => 'slider',
						'std'		  => '35',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '0',
							'max' => '400',
							'step' => '1'
						),
						'live' => array(
							'type'		=> 'css',
							'css_class' => '.'.$uid,
							'css_rule'	=> 'padding-bottom',
							'unit'		=> 'px'
						)
					),
					array (
						'id'          => 'size',
						'name'        => 'Section Size',
						'description' => 'Select the desired size for this section.',
						'type'        => 'select',
						'options'	  => array( 'container' => 'Fixed width' , 'full_width' => 'Full width' ),
						'live' => array(
							'type'		=> 'class',
							'css_class' => '.'.$uid.' .zn_section_size'
						)
					),

                    array(
                        'id'            => 'enable_ov_hidden',
                        'name'          => 'Enable Overflow Hidden',
                        'description'   => 'Select if you want to set overflow hidden for this section',
                        'type'          => 'toggle2',
                        'std'           => '',
                        'value'         => 'yes'
                    ),

                    array(
                        'id'          => 'css_class',
                        'name'        => 'Css class',
                        'description' => 'Enter a css class that will be applied to this element',
                        'type'        => 'text',
                        'std'         => '',
                    ),

					// array (
					// 	'id'          => 'ustyle',
					// 	'name'        => 'Color Style',
					// 	'description' => 'Using this option you can add a style that was created using the custom colors option from the theme options panel.',
					// 	'type'        => 'select',
					// 	'options'	  => ZN()->unlimited_styles,
					// 	'live' => array(
					// 		'type'		=> 'class',
					// 		'css_class' => '.'.$uid
					// 	)
					// ),
                )
            ),

            'background' => array(
                'title' => 'Background & Styles Options',
                'options' => array(
					array(
						'id'          => 'background_color',
						'name'        => 'Background color',
						'description' => 'Here you can override the background color for this section.',
						'type'        => 'colorpicker',
						'std'         => '',
						'live'        => array(
							'type'		=> 'css',
							'css_class' => '.'.$uid,
							'css_rule'	=> 'background-color',
							'unit'		=> ''
						)
					),

	                // Background image/video or youtube
	                array (
	                    "name"        => __( "Background Source Type", 'zn_framework' ),
	                    "description" => __( "Please select the source type of the background.", 'zn_framework' ),
	                    "id"          => "source_type",
	                    "std"         => "",
	                    "type"        => "select",
	                    "options"     => array (
	                        ''  => __( "None (Will just rely on the background color (if any) )", 'zn_framework' ),
	                        'image'  => __( "Image", 'zn_framework' ),
	                        'video_self' => __( "Self Hosted Video", 'zn_framework' ),
	                        'video_youtube' => __( "Youtube Video", 'zn_framework' ),
                            'embed_iframe' => __( "Embed Iframe (Vimeo etc.)", 'zn_framework' )
	                    )
	                ),

					array(
						'id'          => 'background_image',
						'name'        => 'Background image',
						'description' => 'Please choose a background image for this section.',
						'type'        => 'background',
						'options' => array( "repeat" => true , "position" => true , "attachment" => true, "size" => true ),
						'class'		  => 'zn_full',
						'dependency' => array( 'element' => 'source_type' , 'value'=> array('image') )
					),

					array(
						'id'            => 'enable_parallax',
						'name'          => 'Enable Scrolling Parallax effect',
						'description'   => 'Select if you want to enable parallax scrolling effect on background image.',
						'type'          => 'toggle2',
						'std'           => '',
						'value'         => 'yes',
                        'dependency' => array( 'element' => 'source_type' , 'value'=> array('image') )
					),
                    array (
                        "name"        => __( "Skewed Shaped background?", 'zn_framework' ),
                        "description" => __( "Please select wether you want the background image or color to be skewed.", 'zn_framework' ),
                        "id"          => "skewed_bg",
                        "std"         => "no",
                        "type"        => "select",
                        "options"     => array (
                            'no'  => __( "No", 'zn_framework' ),
                            'skewed'  => __( "Skewed", 'zn_framework' ),
                            'skewed-flipped' => __( "Skewed Flipped", 'zn_framework' )
                        ),
                        'live' => array(
                           'type'        => 'class',
                           'css_class' => '.'.$this->data['uid'],
                           'val_prepend'   => 'section--',
                        ),
                        'dependency' => array( 'element' => 'source_type' , 'value'=> array('image', '') )
                    ),

                    // Youtube video
                    array (
                        "name"        => __( "Slide Video Youtube ID", 'zn_framework' ),
                        "description" => __( "Add an Youtube ID", 'zn_framework' ),
                        "id"          => "source_vd_yt",
                        "std"         => "",
                        "type"        => "text",
                        "placeholder" => "ex: tR-5AZF9zPI",
                        "dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_youtube') )
                    ),
                    // Embed Iframe
                    array (
                        "name"        => __( "Embed Iframe link", 'zn_framework' ),
                        "description" => __( "Add a link", 'zn_framework' ),
                        "id"          => "source_vd_embed_iframe",
                        "std"         => "",
                        "type"        => "text",
                        "placeholder" => "ex: https://vimeo.com/17874452",
                        "dependency"  => array( 'element' => 'source_type' , 'value'=> array('embed_iframe') )
                    ),
                    /* LOCAL VIDEO */
                    array(
                        'id'          => 'source_vd_self_mp4',
                        'name'        => 'Mp4 video source',
                        'description' => 'Add the MP4 video source for your local video',
                        'type'        => 'media_upload',
                        'std'         => '',
                        'data'  => array(
                            'type' => 'video/mp4',
                            'button_title' => 'Add / Change mp4 video',
                        ),
                        "dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self') )
                    ),
                    array(
                        'id'          => 'source_vd_self_ogg',
                        'name'        => 'Ogg/Ogv video source',
                        'description' => 'Add the OGG video source for your local video',
                        'type'        => 'media_upload',
                        'std'         => '',
                        'data'  => array(
                            'type' => 'video/ogg',
                            'button_title' => 'Add / Change ogg video',
                        ),
                        "dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self') )
                    ),
                    array(
                        'id'          => 'source_vd_self_webm',
                        'name'        => 'Webm video source',
                        'description' => 'Add the WEBM video source for your local video',
                        'type'        => 'media_upload',
                        'std'         => '',
                        'data'  => array(
                            'type' => 'video/webm',
                            'button_title' => 'Add / Change webm video',
                        ),
                        "dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self') )
                    ),
                    array(
                        'id'          => 'source_vd_vp',
                        'name'        => 'Video poster',
                        'description' => 'Using this option you can add your desired video poster that will be shown on unsuported devices.',
                        'type'        => 'media',
                        'std'         => '',
                        'class'       => 'zn_full',
                        "dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self','video_youtube') )
                    ),
                    array(
                        'id'          => 'source_vd_autoplay',
                        'name'        => 'Autoplay video?',
                        'description' => 'Enable autoplay for video?',
                        'type'        => 'select',
                        'std'         => 'yes',
                        "dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self','video_youtube') ),
                        "options"     => array (
                            "yes" => __( "Yes", 'zn_framework' ),
                            "no"  => __( "No", 'zn_framework' )
                        ),
                        "class"       => "zn_input_xs"
                    ),
                    array(
                        'id'          => 'source_vd_loop',
                        'name'        => 'Loop video?',
                        'description' => 'Enable looping the video?',
                        'type'        => 'select',
                        'std'         => 'yes',
                        "dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self','video_youtube') ),
                        "options"     => array (
                            "yes" => __( "Yes", 'zn_framework' ),
                            "no"  => __( "No", 'zn_framework' )
                        ),
                        "class"       => "zn_input_xs"
                    ),
                    array(
                        'id'          => 'source_vd_muted',
                        'name'        => 'Start mute?',
                        'description' => 'Start the video with muted audio?',
                        'type'        => 'select',
                        'std'         => 'yes',
                        "dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self','video_youtube') ),
                        "options"     => array (
                            "yes" => __( "Yes", 'zn_framework' ),
                            "no"  => __( "No", 'zn_framework' )
                        ),
                        "class"       => "zn_input_xs"
                    ),
                    array(
                        'id'          => 'source_vd_controls',
                        'name'        => 'Video controls',
                        'description' => 'Enable video controls?',
                        'type'        => 'select',
                        'std'         => 'yes',
                        "dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self','video_youtube') ),
                        "options"     => array (
                            "yes" => __( "Yes", 'zn_framework' ),
                            "no"  => __( "No", 'zn_framework' )
                        ),
                        "class"       => "zn_input_xs"
                    ),
                    array(
                        'id'          => 'source_vd_controls_pos',
                        'name'        => 'Video controls position',
                        'description' => 'Video controls position in the slide',
                        'type'        => 'select',
                        'std'         => 'bottom-right',
                        "dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self','video_youtube') ),
                        "options"     => array (
                            "top-right" => __( "top-right", 'zn_framework' ),
                            "top-left" => __( "top-left", 'zn_framework' ),
                            "top-center"  => __( "top-center", 'zn_framework' ),
                            "bottom-right"  => __( "bottom-right", 'zn_framework' ),
                            "bottom-left"  => __( "bottom-left", 'zn_framework' ),
                            "bottom-center"  => __( "bottom-center", 'zn_framework' ),
                            "middle-right"  => __( "middle-right", 'zn_framework' ),
                            "middle-left"  => __( "middle-left", 'zn_framework' ),
                            "middle-center"  => __( "middle-center", 'zn_framework' )
                        ),
                        "class"       => "zn_input_sm"
                    ),

                    array(
                        'id'          => 'source_overlay',
                        'name'        => 'Background colored overlay',
                        'description' => 'Add slide color overlay over the image or video to darken or enlight?',
                        'type'        => 'select',
                        'std'         => '0',
                        "options"     => array (
                            "1" => __( "Yes (Normal color)", 'zn_framework' ),
                            "2" => __( "Yes (Horizontal gradient)", 'zn_framework' ),
                            "3" => __( "Yes (Vertical gradient)", 'zn_framework' ),
                            "0"  => __( "No", 'zn_framework' )
                        )
                    ),

                    array(
                        'id'          => 'source_overlay_color',
                        'name'        => 'Overlay background color',
                        'description' => 'Pick a color',
                        'type'        => 'colorpicker',
                        'std'         => '#353535',
                        "dependency"  => array( 'element' => 'source_overlay' , 'value'=> array('1', '2', '3') ),
                    ),
                    array(
                        'id'          => 'source_overlay_opacity',
                        'name'        => 'Overlay\'s opacity.',
                        'description' => 'Overlay background colors opacity level.',
                        'type'        => 'slider',
                        'std'         => '30',
                        "helpers"     => array (
                            "step" => "5",
                            "min" => "0",
                            "max" => "100"
                        ),
                        "dependency"  => array( 'element' => 'source_overlay' , 'value'=> array('1', '2', '3') ),
                    ),

                    array(
                        'id'          => 'source_overlay_color_gradient',
                        'name'        => 'Overlay Gradient 2nd Bg. Color',
                        'description' => 'Pick a color',
                        'type'        => 'colorpicker',
                        'std'         => '#353535',
                        "dependency"  => array( 'element' => 'source_overlay' , 'value'=> array('2', '3') ),
                    ),
                    array(
                        'id'          => 'source_overlay_color_gradient_opac',
                        'name'        => 'Gradient Overlay\'s 2nd Opacity.',
                        'description' => 'Overlay gradient 2nd background color opacity level.',
                        'type'        => 'slider',
                        'std'         => '30',
                        "helpers"     => array (
                            "step" => "5",
                            "min" => "0",
                            "max" => "100"
                        ),
                        "dependency"  => array( 'element' => 'source_overlay' , 'value'=> array('2', '3') ),
                    ),

                    array(
                        'id'            => 'source_overlay_gloss',
                        'name'          => 'Enable Gloss Overlay',
                        'description'   => 'Display a gloss over the background',
                        'type'          => 'toggle2',
                        'std'           => '',
                        'value'         => '1'
                    ),

                    // Bottom masks
                    array (
                        "name"        => __( "Bottom masks override", 'zn_framework' ),
                        "description" => __( "The new masks are svg based, vectorial and color adapted. <br> <strong>Disclaimer:</strong> may now work perfectly for all elements!", 'zn_framework' ),
                        "id"          => "hm_header_bmasks",
                        "std"         => "none",
                        "type"        => "select",
                        "options"     => array (
                            'none' => __( 'None, just rely on Background style.', 'zn_framework' ),
                            'shadow_simple' => __( 'Shadow Up', 'zn_framework' ),
                            'shadow_simple_down' => __( 'Shadow Down', 'zn_framework' ),
                            'shadow' => __( 'Shadow Up (with border and small arrow)', 'zn_framework' ),
                            'shadow_ud' => __( 'Shadow Up and down', 'zn_framework' ),
                            'mask1' => __( 'Raster Mask 1 (Old, not recommended)', 'zn_framework' ),
                            'mask2' => __( 'Raster Mask 2 (Old, not recommended)', 'zn_framework' ),
                            'mask3' => __( 'Vector Mask 3 CENTER (New! From v4.0)', 'zn_framework' ),
                            'mask3 mask3l' => __( 'Vector Mask 3 LEFT (New! From v4.0)', 'zn_framework' ),
                            'mask3 mask3r' => __( 'Vector Mask 3 RIGHT (New! From v4.0)', 'zn_framework' ),
                            'mask4' => __( 'Vector Mask 4 CENTER (New! From v4.0)', 'zn_framework' ),
                            'mask4 mask4l' => __( 'Vector Mask 4 LEFT (New! From v4.0)', 'zn_framework' ),
                            'mask4 mask4r' => __( 'Vector Mask 4 RIGHT (New! From v4.0)', 'zn_framework' ),
                            'mask5' => __( 'Vector Mask 5 (New! From v4.0)', 'zn_framework' ),
                            'mask6' => __( 'Vector Mask 6 (New! From v4.0)', 'zn_framework' ),
                        ),
                    ),
                ),
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
                            'css_class' => '.'.$uid.' > .zn_section_size > .row.zn_columns_container'
                        )
                    ),

                    array(
                        'id'            => 'enable_inlinemodal',
                        'name'          => 'Enable INLINE Modal Window',
                        'description'   => 'If you enable this, this section <strong>will be hidden in View mode (non-pagebuilder)</strong> and will contain any elements you want that will be displayed as a <em>modal window</em>, linked by an url from the page. <br><br> In order to properly link to this modal, copy the unique ID and paste it into the button link field, with a hash in front, for example <em>"#this_unique_id"</em> . ',
                        'type'          => 'toggle2',
                        'std'           => '',
                        'value'         => 'yes'
                    ),

                    array(
                        'id'          => 'window_size',
                        'name'        => 'Window Size (inline modal)',
                        'description' => 'Select the modal window width size in px. Default 1200px',
                        "std"         => "1200",
                        "type"        => "text",
                        'dependency' => array( 'element' => 'enable_inlinemodal' , 'value'=> array('yes') )
                    ),

                    array(
                        'id'          => 'window_autopopup',
                        'name'        => 'Auto-Popup window?',
                        'description' => 'Select wether you want to autopopup this modal window',
                        "std"         => "0",
                        "type"        => "select",
                        "options"     => array (
                            '' => __( 'No', 'zn_framework' ),
                            'immediately' => __( 'Immediately ', 'zn_framework' ),
                            'delay' => __( 'After a delay of "x" seconds', 'zn_framework' ),
                            'scroll' => __( 'When user scrolls halfway down the page', 'zn_framework' ),
                        ),
                        'dependency' => array( 'element' => 'enable_inlinemodal' , 'value'=> array('yes') )
                    ),

                    array(
                        'id'          => 'autopopup_delay',
                        'name'        => 'Auto-Popup delay',
                        'description' => 'Select the autopopup delay in seconds. This option is used only if <em>"After a delay of "x" seconds"</em> option is selected in the <strong>"Auto-Popup window?"</strong> option above.',
                        "std"         => "5",
                        "type"        => "text",
                        'dependency' => array( 'element' => 'enable_inlinemodal' , 'value'=> array('yes') )
                    ),
                )
            ),

            'help' => array(
                'title' => '<span class="dashicons dashicons-editor-help"></span> HELP',
                'options' => array(

                    array (
                        "name"        => __( 'Video Tutorial', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#vcux4GW2ctg" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/section-and-columns/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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

                )
            ),
		);

		return $options;

	}

	/**
	 * Output the element
	 * IMPORTANT : The UID needs to be set on the top parent container
	 */
	function element() {

        $uid = $this->data['uid'];

        $css_class = $this->opt('ustyle') ? ' '.$this->opt('ustyle').' ' : '';
		$css_class_opt = $this->opt('css_class') ? $this->opt('css_class') : '';
		$size = $this->opt('size') ? $this->opt('size') : 'container';
		$enable_parallax = $this->opt('enable_parallax') === 'yes' ? 'zn_parallax' : '';

		$enable_ov_hidden = $this->opt('enable_ov_hidden') === 'yes' ? 'zn_ovhidden' : '';

		if ( empty( $this->data['content'] ) ) {
			$this->data['content'] = array ( ZN()->pagebuilder->add_module_to_layout( 'ZnColumn', array() , array(), 'col-sm-12' ) );
		}

        $bottom_mask = $this->opt('hm_header_bmasks','none');
        if($bottom_mask != 'none'){
            $css_class .= ' zn_section--masked';
        }

        if( $this->opt('source_type', '') != '' || $this->opt('source_overlay', '0') != 0 || $this->opt('hm_header_bmasks','none') != 'none'  || $this->opt('source_overlay_gloss', '') == 1){
            $css_class .= ' zn_section--relative';
        }

        $autopopup_attr = '';
        if($this->opt('enable_inlinemodal','') == 'yes'){
            $css_class .= ' zn_section--inlinemodal mfp-hide ';
            $css_class .= $this->opt('window_size', '1200') < 1200 ? ' zn_section--stretch-container' : '';
            $css_class .= $this->opt('window_autopopup','') != '' ? ' zn_section--auto-'.$this->opt('window_autopopup','') : '';
            // Add delay
            if( $this->opt('window_autopopup','') == 'delay' ){
                $autopopup_attr = 'data-auto-delay="'.$this->opt('autopopup_delay','5').'"';
            }
        }
		?>
		<section class="zn_section <?php echo $css_class.' '.$uid.' '.$enable_parallax.' '.$enable_ov_hidden ; ?> <?php echo $this->opt('css_class',''); ?> section--<?php echo $this->opt('skewed_bg','no') ?>" id="<?php echo $uid; ?>" <?php echo $autopopup_attr; ?>>

            <?php
                WpkPageHelper::zn_background_source( array(
                    'source_type' => $this->opt('source_type'),
                    'source_background_image' => $this->opt('background_image'),
                    'source_vd_yt' => $this->opt('source_vd_yt'),
                    'source_vd_embed_iframe' => $this->opt('source_vd_embed_iframe'),
                    'source_vd_self_mp4' => $this->opt('source_vd_self_mp4'),
                    'source_vd_self_ogg' => $this->opt('source_vd_self_ogg'),
                    'source_vd_self_webm' => $this->opt('source_vd_self_webm'),
                    'source_vd_vp' => $this->opt('source_vd_vp'),
                    'source_vd_autoplay' => $this->opt('source_vd_autoplay'),
                    'source_vd_loop' => $this->opt('source_vd_loop'),
                    'source_vd_muted' => $this->opt('source_vd_muted'),
                    'source_vd_controls' => $this->opt('source_vd_controls'),
                    'source_vd_controls_pos' => $this->opt('source_vd_controls_pos'),
                    'source_overlay' => $this->opt('source_overlay'),
                    'source_overlay_color' => $this->opt('source_overlay_color'),
                    'source_overlay_opacity' => $this->opt('source_overlay_opacity'),
                    'source_overlay_color_gradient' => $this->opt('source_overlay_color_gradient'),
                    'source_overlay_color_gradient_opac' => $this->opt('source_overlay_color_gradient_opac'),
                    'source_overlay_gloss' => $this->opt('source_overlay_gloss',''),
                    'enable_parallax' => $this->opt('enable_parallax'),
                ) );
            ?>

			<div class="zn_section_size <?php echo $size;?>">
				<div class="row zn_columns_container zn_content <?php echo $this->opt('gutter_size','') ?>" data-droplevel="1">

					<?php
						ZN()->pagebuilder->zn_render_content( $this->data['content'] );
					?>

				</div>
			</div>

            <?php
            if($bottom_mask != 'none'){
                WpkPageHelper::zn_bottommask_markup($bottom_mask);
            }
            ?>
		</section>
	<?php
	}

	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){

		//print_z($this);
		$uid = $this->data['uid'];
        $css = '';
        $s_css = '';

        $top_padding = $this->opt('top_padding','35');
        $s_css .= $top_padding != '35' ? 'padding-top:'.$top_padding.'px;' : '';

        $bottom_padding = $this->opt('bottom_padding','35');
		$s_css .= $bottom_padding != '35' ? 'padding-bottom:'.$bottom_padding.'px;' : '';

        $s_css .= $this->opt('background_color') ? 'background-color:'.$this->opt('background_color').';' : '';

        if ( !empty($s_css) )
        {
            $css .= '.zn_section.'.$uid.'{'.$s_css.'}';
        }

        $width = $this->opt('enable_inlinemodal','') == 'yes' ? 'width:'.$this->opt('window_size', '1200').'px' : '';
        if ( !empty($width) )
        {
            $css .= '@media screen and (min-width:'.$this->opt('window_size', '1200').'px) {';
            $css .= 'body:not(.zn_pb_editor_enabled) .zn_section--inlinemodal.'.$uid.' {'.$width.'}';
            $css .= '}';
        }

		return $css;
	}


    /**
     * Load dependant resources
     */
    function scripts()
    {
        if($this->opt('enable_parallax') == 'yes') {
            wp_enqueue_script( 'parallaxjs_pixelcog', THEME_BASE_URI . '/addons/parallax.js/parallax.min.js',  array ( 'jquery' ), ZN_FW_VERSION, true );
        }
    }


}

?>

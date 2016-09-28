<?php
/*
	Name: Google Map
	Description: This element will generate a map
	Class: ZnGoogleMap
	Category: Content, Fullwidth
	Level: 3
	Scripts: true
	Styles: true
*/

class ZnGoogleMap extends ZnElements {

	function options() {

		$zoom = array ();

		for ( $i = 1; $i<24; $i++) {
			$zoom[$i] = $i;
		}

		$icon_sizes = array(
			'20' => '20 x 20' ,
			'30' => '30 x 30' ,
			'40' => '40 x 40' ,
			'50' => '50 x 50' ,
			'60' => '60 x 60' ,
			'70' => '70 x 70' ,
			'80' => '80 x 80' ,
			);

		$mapstyleurl = 'http://snazzymaps.com';

		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(
					array(
							'id'         	=> 'single_multiple_maps',
							'name'       	=> 'Locations',
							'description' 	=> 'Here you can add your map locations.',
							'type'        	=> 'group',
							'sortable'	  	=> true,
							'element_title' => 'Map Location',
							'subelements' 	=> array(
													array(
														"name" => "Marker Latitude",
														"description" => "Please enter the latitude value for your location.",
														"id" => "sc_map_latitude",
														"std" => "41.447390",
														"type" => "text"
													),
													array(
														"name" => "Marker Longitude",
														"description" => "Please enter the longitude value for your location.",
														"id" => "sc_map_longitude",
														"std" => "-72.843868",
														"type" => "text"
													),
													array(
														"name" => "Marker tooltip",
														"description" => "Add a text that will appear when the user clicks on the marker.",
														"id" => "tooltip",
														"type" => "textarea"
													),
													array(
														"name" => "Marker location icon",
														"description" => "Select an icon that will appear as your current location. The default icon will be used if this is left blank.",
														"id" => "sc_map_icon",
														"std" => "",
														'class' => 'zn_full',
														"type" => "media"
													),
													array(
														"name" => "Marker animation",
														"description" => "Select an animation that the icon will use.",
														"id" => "sc_map_icon_animation",
														"std" => "",
														"type" => "select",
														"options" => array ( "" => "None", "DROP" => "Drop" , "BOUNCE" =>  "Bounce" ),
													),
													array(
														"name" => "Icon size",
														"description" => "Select the size of the marker icon.",
														"id" => "icon_size",
														"type" => "select",
														"options" => $icon_sizes,
													)
											)

						),
						array(
							"name" => "Zoom level",
							"description" => "Select the start zoom level you want to use for this map ( default is 14 )",
							"id" => "sc_map_zoom",
							"std" => "14",
							"type" => "select",
							"options" => $zoom,
							"class" => ""
						),
						array(
							"name" => "Map Type",
							"description" => "Select the desired map type you want to use.",
							"id" => "sc_map_type",
							"std" => "roadmap",
							"type" => "select",
							"options" => array ( "ROADMAP" => "Roadmap", "SATELLITE" => "Satellite" , "TERRAIN" => "Terrain" , "HYBRID" => "Hybrid" ),
							"class" => ""
						),
						array(
							"name" => "Add directions box",
							"description" => "Select if you want to add a textbox in which the user can enter a departure location and get directions to the office location (first one if there are more than one).",
							"id" => "sc_map_directions",
							"std" => 'yes',
							"type" => "toggle2",
							"value" => "yes"
						),
						array(
							"name" => "Directions box text",
							"description" => "Please enter the direction box text you want to use.",
							"id" => "sc_map_directions_text",
							"std" => 'Visit us from...',
							"type" => "text",
							'dependency'  => array( 'element' => 'sc_map_directions' , 'value'=> array('yes') ),
						),

						array(
							"name" => "Directions box position",
							"description" => "Please select the direction box's position.",
							"id" => "sc_map_directions_pos",
							"std" => 'top-left',
							"type" => "select",
							"options" => array (
								"top-left" => "Top Left",
								"middle-left" => "Middle Left",
								"bottom-left" => "Bottom Left",
								"top-right" => "Top Right",
								"middle-right" => "Middle Right",
								"bottom-right" => "Bottom Right",
								"top-center" => "Top Center",
								"bottom-center" => "Bottom Center",
							),
							'dependency'  => array( 'element' => 'sc_map_directions' , 'value'=> array('yes') ),
						),

						array(
							'id'            => 'show_overview',
							'name'          => 'Show overview map',
							'description'   => 'Select if you wish to add the overview map option',
							'type'          => 'toggle2',
							'std'           => '',
							'value'         => 'yes'
						),
						array(
							'id'            => 'show_streetview',
							'name'          => 'Show street view',
							'description'   => 'Select if you wish to add the street view option',
							'type'          => 'toggle2',
							'std'           => '',
							'value'         => 'yes'
						),
						array(
							'id'            => 'show_maptype',
							'name'          => 'Show map type',
							'description'   => 'Select if you wish to add the map type option',
							'type'          => 'toggle2',
							'std'           => '',
							'value'         => 'yes'
						),

		                array (
		                    "name"        => __( "Info bubble type", 'zn_framework' ),
		                    "description" => __( "Please select the info type", 'zn_framework' ),
		                    "id"          => "ww_mapinfo_type",
		                    "std"         => "infobox",
		                    "type"        => "select",
		                    "options"     => array (
		                        'infobox'  => __( "Info Box", 'zn_framework' ),
		                        'infopanel' => __( "Info Panel", 'zn_framework' )
		                    )
		                ),

		                array (
		                    "name"        => __( "Button Main Text", 'zn_framework' ),
		                    "description" => __( "Please enter a main text for this button", 'zn_framework' ),
		                    "id"          => "ww_slide_m_button",
		                    "std"         => "",
		                    "type"        => "text",
		                    "dependency"  => array( 'element' => 'ww_mapinfo_type' , 'value'=> array('infobox') ),
		                ),
		                array (
		                    "name"        => __( "Button Link Text", 'zn_framework' ),
		                    "description" => __( "Please enter a text that will appear on the right side of the button", 'zn_framework' ),
		                    "id"          => "ww_slide_l_text",
		                    "std"         => "",
		                    "type"        => "text",
		                    "dependency"  => array( 'element' => 'ww_mapinfo_type' , 'value'=> array('infobox') ),
		                ),
		                array (
		                    "name"        => __( "Button link", 'zn_framework' ),
		                    "description" => __( "Please enter a link that will appear on the right side of the button", 'zn_framework' ),
		                    "id"          => "ww_slide_link",
		                    "std"         => "",
		                    "type"        => "link",
		                    "options"     => array (
		                        '_self'  => __( "Same window", 'zn_framework' ),
		                        '_blank' => __( "New window", 'zn_framework' )
		                    ),
		                    "dependency"  => array( 'element' => 'ww_mapinfo_type' , 'value'=> array('infobox') ),
		                ),

		                array (
		                    "name"        => __( "Panel Image", 'zn_framework' ),
		                    "description" => __( "Display an image into the info panel.", 'zn_framework' ),
		                    "id"          => "sc_map_panel_img",
		                    "std"         => "",
		                    "type"        => "media",
		                    "dependency"  => array( 'element' => 'ww_mapinfo_type' , 'value'=> array('infopanel') ),
		                ),

		                array (
		                    "name"        => __( "Panel Title", 'zn_framework' ),
		                    "description" => __( "Title in panel.", 'zn_framework' ),
		                    "id"          => "sc_map_panel_title",
		                    "std"         => "",
		                    "type"        => "text",
		                    "dependency"  => array( 'element' => 'ww_mapinfo_type' , 'value'=> array('infopanel') ),
		                ),

		                array (
		                    "name"        => __( "Panel Content", 'zn_framework' ),
		                    "description" => __( "Content in panel.", 'zn_framework' ),
		                    "id"          => "sc_map_panel_text",
		                    "std"         => "",
		                    "type"        => "visual_editor",
		                    'class'		  => 'zn_full',
		                    "dependency"  => array( 'element' => 'ww_mapinfo_type' , 'value'=> array('infopanel') ),
		                ),
				),
			),
			'styling' => array(
				'title' => 'Styling options',
				'options' => array(
	                array (
	                    "name"        => __( "Background Style", 'zn_framework' ),
	                    "description" => __( "Select the background style you want to use. Please note that styles can be created
	                                from the unlimited headers options in the theme admin's page.", 'zn_framework' ),
	                    "id"          => "ww_header_style",
	                    "std"         => "",
	                    "type"        => "select",
	                    "options"     => WpkZn::getThemeHeaders(true),
	                    "class"       => ""
	                ),
	                array (
	                    "name"        => __( "Bottom masks override", 'zn_framework' ),
	                    "description" => __( "The new masks are svg based, vectorial and color adapted.", 'zn_framework' ),
	                    "id"          => "hm_header_bmasks",
	                    "std"         => "none",
	                    "type"        => "select",
	                    "options"     => array (
                            'none' => __( 'None, just rely on Background style.', 'zn_framework' ),
                            'shadow' => __( 'Shadow Up', 'zn_framework' ),
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
	                array (
	                    "name"        => __( "Enable fullscreen?", 'zn_framework' ),
	                    "description" => __( "Do you want to display the static content as fullscreen?", 'zn_framework' ),
	                    "id"          => "sc_fullscreen",
	                    "std"         => "no",
	                    "type"        => "select",
	                    "options"     => array (
	                        'yes'  => __( "Yes", 'zn_framework' ),
	                        'no' => __( "No", 'zn_framework' )
	                    )
	                ),
					array(
						"name" => "Map Height",
						"description" => "Please select value in pixels for the map height.",
						"id" => "sc_map_height",
						"std" => "600",
						"type" => "slider",
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '200',
							'max' => '1080',
							'step' => '1'
						),
						"dependency"  => array( 'element' => 'sc_fullscreen' , 'value'=> array('no') ),
						),
					array(
                        'id'            => 'use_custom_style',
                        'name'          => 'Map custom style',
                        'description'   => 'Use a custom map style. You can get custom styles from <a href="'. $mapstyleurl .'" target="_blank">'. $mapstyleurl .'</a>.',
                        'type'          => 'toggle2',
                        'std'           => '',
                        'value'         => 'yes'
                    ),
					array(
                        'id'          => 'custom_style',
                        'name'        => 'Normal map style',
                        'description' => 'Paste your custom style here (Javascript style array). You can get custom styles from <a href="'. $mapstyleurl .'" target="_blank">'. $mapstyleurl .'</a>.',
                        'type'        => 'textarea',
						'std'		  => '',
						'dependency'  => array( 'element' => 'use_custom_style' , 'value'=> array('yes') ),
                    ),
					array(
                        'id'          => 'custom_style_active',
                        'name'        => 'Active map style (when a popup is visible)',
                        'description' => 'Paste your custom style here (Javascript style array). You can get custom styles from <a href="'. $mapstyleurl .'" target="_blank">'. $mapstyleurl .'</a>.',
                        'type'        => 'textarea',
						'std'		  => '',
						'dependency'  => array( 'element' => 'use_custom_style' , 'value'=> array('yes') ),
                    ),
				)
			),
			'misc' => array(
				'title' => 'Miscellaneous',
				'options' => array(
					array(
						"name" => "Allow Mousewheel",
						"description" => "Select if you want to allow map zooming using the mouse scroll (may interfere with page scroll).",
						"id" => "sc_map_zooming_mousewheel",
						"std" => "",
						"type" => "toggle2",
						"value" => "yes",
					),
					array(
						"name" => "Map localization",
						"description" => "Force the map localization to a specific language",
						"id" => "sc_map_localization",
						"std" => "",
						"type" => "select",
						"options" => array ( '' => 'Use browser language','ar'=>'ARABIC'
																		,'eu'=>'BASQUE'
																		,'bg'=>'BULGARIAN'
																		,'bn'=>'BENGALI'
																		,'ca'=>'CATALAN'
																		,'cs'=>'CZECH'
																		,'da'=>'DANISH'
																		,'de'=>'GERMAN'
																		,'el'=>'GREEK'
																		,'en'=>'ENGLISH'
																		,'en-AU'=>'ENGLISH (AUSTRALIAN)'
																		,'en-GB'=>'ENGLISH (GREAT BRITAIN)'
																		,'es'=>'SPANISH'
																		,'eu'=>'BASQUE'
																		,'fa'=>'FARSI'
																		,'fi'=>'FINNISH'
																		,'fil'=>'FILIPINO'
																		,'fr'=>'FRENCH'
																		,'gl'=>'GALICIAN'
																		,'gu'=>'GUJARATI'
																		,'hi'=>'HINDI'
																		,'hr'=>'CROATIAN'
																		,'hu'=>'HUNGARIAN'
																		,'id'=>'INDONESIAN'
																		,'it'=>'ITALIAN'
																		,'iw'=>'HEBREW'
																		,'ja'=>'JAPANESE'
																		,'kn'=>'KANNADA'
																		,'ko'=>'KOREAN'
																		,'lt'=>'LITHUANIAN'
																		,'lv'=>'LATVIAN'
																		,'ml'=>'MALAYALAM'
																		,'mr'=>'MARATHI'
																		,'nl'=>'DUTCH'
																		,'no'=>'NORWEGIAN'
																		,'pl'=>'POLISH'
																		,'pt'=>'PORTUGUESE'
																		,'pt-BR'=>'PORTUGUESE (BRAZIL)'
																		,'pt-PT'=>'PORTUGUESE (PORTUGAL)'
																		,'ro'=>'ROMANIAN'
																		,'ru'=>'RUSSIAN'
																		,'sk'=>'SLOVAK'
																		,'sl'=>'SLOVENIAN'
																		,'sr'=>'SERBIAN'
																		,'sv'=>'SWEDISH'
																		,'tl'=>'TAGALOG'
																		,'ta'=>'TAMIL'
																		,'te'=>'TELUGU'
																		,'th'=>'THAI'
																		,'tr'=>'TURKISH'
																		,'uk'=>'UKRAINIAN'
																		,'vi'=>'VIETNAMESE'
																		,'zh-CN'=>'CHINESE (SIMPLIFIED)'
																		,'zh-TW'=>'CHINESE (TRADITIONAL)'
					  ),
						"class" => ""
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
	                    "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#qtw5ShCYcNY" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
	                    "id"          => "video_link",
	                    "std"         => "",
	                    "type"        => "zn_title",
	                    "class"       => "zn_full zn_nomargin"
	                ),

	                array (
	                    "name"        => __( 'Written Documentation', 'zn_framework' ),
	                    "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/google-map/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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

	function element(){

		$locations = $this->opt('single_multiple_maps') ? $this->opt('single_multiple_maps') : '';
		$sc_map_directions_text = $this->opt('sc_map_directions_text') ? $this->opt('sc_map_directions_text') : __('Visit us from...','zn_framework');

		if ( empty($locations) ) {
			echo '<div class="zn-pb-notification">Please configure the element options and add at least one location.</div>';
			return;
		}

		$uid = $this->data['uid'];

        $options = $this->data['options'];
        $style = '';
        if ( isset ( $options['ww_header_style'] ) && ! empty ( $options['ww_header_style'] ) ) {
            $style = 'uh_' . $options['ww_header_style'];
        }

        $bottom_mask = $this->opt('hm_header_bmasks','none');
        $bm_class = $bottom_mask != 'none' ? 'maskcontainer--'.$bottom_mask : '';



	?>

		<div class="zn_google_map kl-slideshow static-content__slideshow scontent__maps <?php echo $style; ?> <?php echo $uid; ?> <?php echo $bm_class ?> <?php echo ( $this->opt('sc_fullscreen', 'no') == 'yes' ? 'static-content--fullscreen' : '' ); ?> <?php echo $this->opt('css_class',''); ?>" >

		    <div class="bgback"></div>
		    <div class="th-sparkles"></div>

			<!-- map container -->
			<div id="zn_google_map_<?php echo $this->data['uid']; ?>" class="zn_gmap_canvas th-google_map">
				<?php if ( $this->opt('sc_map_directions') === 'yes') {?>
					<div class="zn_visitUsContainer zn_visit--pos-<?php echo $this->opt('sc_map_directions_pos','top-left'); ?>">
						<input type="text" required placeholder="<?php echo esc_attr($sc_map_directions_text); ?>" class="animate zn_startLocation" />
						<span class="zn_removeRoute zn_icon" data-unicode="ue855" data-zniconfam="glyphicons_halflingsregular" data-zn_icon="&#xe014;"></span>
					</div>
				<?php };?>
			</div>

			    <?php

			    if( $this->opt('ww_mapinfo_type', 'infobox') == 'infobox' ) {

			        $ww_slide_m_button = $this->opt('ww_slide_m_button');
			        if ( $ww_slide_m_button || $options['ww_slide_l_text'] ) {
			            echo '<div class="static-content__infopop" data-arrow="top">';

			            if ( $options['ww_slide_l_text'] && isset ( $options['ww_slide_link']['url'] ) && ! empty ( $options['ww_slide_link']['url'] ) ) {
			                echo '<a class="sc-infopop__btn" href="' . $options['ww_slide_link']['url'] . '" target="' .
			                     $options['ww_slide_link']['target'] . '">' . $options['ww_slide_l_text'] . '</a>';
			            }
			            // BUTTON LEFT TEXT
			            if ( isset ( $ww_slide_m_button ) && ! empty ( $ww_slide_m_button ) ) {
			                echo '<h5 class="sc-infopop__text">' . $ww_slide_m_button . '</h5>';
			            }

			            echo '<div class="clear"></div>';
			            echo '</div>';
			        }
			    } else {

			        ?>
			        <div class="kl-contentmaps__panel">

			            <?php if($this->opt('sc_map_panel_img','') && $panel_img = $this->opt('sc_map_panel_img','')){ ?>
			                <a href="#" class="js-toggle-class kl-contentmaps__panel-tgg hidden-xs" data-target=".kl-contentmaps__panel" data-target-class="is-closed"></a>
			                <a href="<?php echo $panel_img ?>" data-lightbox="image" class="kl-contentmaps__panel-img" style="background-image:url(<?php echo $panel_img ?>)"></a>
			            <?php } ?>

			            <?php if( $panel_text = $this->opt('sc_map_panel_text','')){ ?>

			                <div class="kl-contentmaps__panel-info">
			                    <?php
			                    if( $this->opt('sc_map_panel_title','') ){
			                        echo '<h5 class="kl-contentmaps__panel-title">'.$this->opt('sc_map_panel_title','').'</h5>';
			                    }
			                    ?>
			                    <div class="kl-contentmaps__panel-info-text">
			                    <?php
			                    $content = wpautop( $panel_text );
			                    if ( ! empty ( $panel_text ) ) {
			                        if ( preg_match( '%(<[^>]*>.*?</)%i', $content, $regs ) ) {
			                            echo do_shortcode( $content );
			                        }
			                        else {
			                            echo '<p>' . do_shortcode( $content ) . '</p>';
			                        }
			                    }
			                    ?>
			                    </div>
			                </div>
			            <?php } ?>
			        </div>
			    <?php
			    }
			WpkPageHelper::zn_bottommask_markup($bottom_mask);
			?>
		</div>

	<?php
	}

	function scripts() {
		$localization = ($this->opt('sc_map_localization') && $this->opt('sc_map_localization')!=='' ? '&language='.$this->opt('sc_map_localization') : '');
		wp_enqueue_script( 'zn_google_api', 'https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false'.$localization, array('jquery'), ZN_FW_VERSION, true );
		wp_enqueue_script( 'zn_gmap', THEME_BASE_URI .'/pagebuilder/elements/google_map/assets/gmaps.js', array('jquery'), ZN_FW_VERSION, true );
        wp_enqueue_style( 'zn_static_content', THEME_BASE_URI . '/sliders/static_content/sc_styles.css', '', ZN_FW_VERSION );
	}

	// Loads the required JS
	function js() {

			$locations = $this->opt('single_multiple_maps') ? $this->opt('single_multiple_maps') : array();
			$zoom = $this->opt('sc_map_zoom') ? $this->opt('sc_map_zoom') : '14' ;
			$terrain = $this->opt('sc_map_type') ? $this->opt('sc_map_type') : 'ROADMAP' ;
			$scroll = $this->opt('sc_map_zooming_mousewheel') === 'yes' ? 'true' : 'false' ;
			$routingColor = zget_option( 'sliding_background' , 'style_options' );
			$uid = $this->data['uid'];
			$mainOfficeLocation = '[0,0]';
			$markers = '';
			$use_custom_style = $this->opt('use_custom_style','');
			$custom_style = 'null';
			$custom_style_active = 'null';
			if ($use_custom_style === 'yes') {
				$custom_style = $this->opt('custom_style','null');
				$custom_style_active = $this->opt('custom_style_active','null');
			}
			$show_overview = $this->opt('show_overview') === 'yes' ? 'true' : 'false';
			$show_streetview = $this->opt('show_streetview') === 'yes' ? 'true' : 'false';
			$show_maptype = $this->opt('show_maptype') === 'yes' ? 'true' : 'false';

			if ( !empty( $locations ) )
			{
				$mainOfficeLocation = '['.$locations[0]['sc_map_latitude'].', '.$locations[0]['sc_map_longitude'].']';
				//** Build the markers [[lat, long, tooltip, icon, size, animation, anchor],...]
				$markers = '[';
				foreach ( $locations as $location ) {

					$latitude = preg_match( "/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/", $location['sc_map_latitude'], $matches ) ? $location['sc_map_latitude'] : false;
					$longitude = preg_match( "/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/", $location['sc_map_longitude'], $matches ) ? $location['sc_map_longitude'] : false;

					if( empty( $latitude ) || empty( $longitude ) ){
						continue;
					}


					$tooltip = !empty( $location['tooltip'] ) ? $location['tooltip'] : '';
					$icon_size = !empty( $location['icon_size'] ) ? $location['icon_size'] : '20';
					$sc_map_icon_animation = !empty( $location['sc_map_icon_animation'] ) ? $location['sc_map_icon_animation'] : '';
					$markers .= sprintf('[%1$s,%2$s,\'%3$s\',\'%4$s\',%5$s,\'%6$s\',%7$s],',
										$latitude,
										$longitude,
										preg_replace( "/\r|\n/", "", wpautop(addslashes($tooltip)) ),
										$location['sc_map_icon'],
										$icon_size,
										$sc_map_icon_animation,
										'');
				}
				$markers .= ']';

				$zn_g_map = array ( 'gmap'.$this->data['uid'] =>
						"
							var zn_google_map_$uid = new Zn_google_map('zn_google_map_$uid', $mainOfficeLocation, '$routingColor', $markers, '$terrain', $zoom, $scroll, $custom_style, $custom_style_active, $show_overview, $show_streetview, $show_maptype);
							zn_google_map_$uid.init_map();

						");
						return $zn_g_map;
			};

		return false;

	}

		/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){
        $css = '';
        $uid = $this->data['uid'];
        $height = (int)$this->opt('sc_map_height', '600');

        if( $height != 600 ) {
            $css = '
.'.$uid.':not(.static-content--fullscreen) { height:'.$height.'px;}
@media only screen and (max-height : '.$height.'px){ .'.$uid.':not(.static-content--fullscreen) {height:90vh;} }';
        }

        return $css;
	}

}


?>

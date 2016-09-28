<?php

	$theme_config = array(
		'options_prefix' => 'zn_kallyas_optionsv4', // The DB options field name
		'theme_id' => 'kallyas', // The theme id that will be used for options field
		'name'           => 'Kallyas', // The theme name
		'supports'       => array(
			'pagebuilder'  	=> true,
			'megamenu'     	=> true,
			'iconmanager'  	=> true,
			'imageresizer' 	=> true,
			'shortcodes' 	=> false,
			'theme_updater'	=> array(
				'author' => 'Hogash',
				'admin_parent' => 'advanced_options',
			),
		)
	);

	// Change the advanced tab to advanced_options. This is needed for the custom css save
	// TODO : Remove this and change the 'advanced_options' to 'advanced'
	function zn_add_custom_css_saving( $saved_options ){

		if ( isset( $saved_options['advanced_options']['custom_css'] ) ) {
			$custom_css = $saved_options['advanced_options']['custom_css'];
			update_option( 'zn_'.ZN()->theme_data['theme_id'].'_custom_css', $custom_css, false );

			// Remove custom css from the main options field
			unset( $saved_options['advanced_options']['custom_css'] );
		}

		if ( isset( $saved_options['advanced_options']['custom_js'] ) ) {
			$custom_js = $saved_options['advanced_options']['custom_js'];
			update_option( 'zn_'.ZN()->theme_data['theme_id'].'_custom_js', $custom_js, true );

			// Remove custom css from the main options field
			unset( $saved_options['advanced_options']['custom_js'] );
		}

		return $saved_options;
	}
	add_filter( 'zn_options_to_save', 'zn_add_custom_css_saving' );



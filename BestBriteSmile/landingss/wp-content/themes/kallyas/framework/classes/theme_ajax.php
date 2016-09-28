<?php

// Add ajax functionality
add_action( 'wp_ajax_zn_ajax_callback', 'zn_ajax_callback' );

function zn_ajax_callback() {

	check_ajax_referer( 'zn_framework', 'zn_ajax_nonce' );

	$save_action = $_POST['zn_action'];

	if ( $save_action == 'zn_save_options' ) {

		// DO ACTION FOR SAVED OPTIONS
		do_action( 'zn_save_theme_options' );


		$_POST = array_map( 'stripslashes_deep', $_POST );
		$data = $_POST;
		$options_field = $data['zn_option_field'];

		/* REMOVE THE HIDDEN FORM DATA */
		unset($data['zn_ajax_nonce']);
		unset($data['zn_option_field']);
		unset($data['action']);
		unset($data['zn_action']);

		// Combine all options
		// Get all saved options
		$saved_options = zget_option( '' , '' , true );
		$saved_options[$options_field] = $data;

		// Save the Custom CSS in c sutom field
		if ( isset( $saved_options['advanced']['custom_css'] ) ) {
			$custom_css = $saved_options['advanced']['custom_css'];
			update_option( 'zn_'.ZN()->theme_data['theme_id'].'_custom_css', $custom_css, false );

			// Remove custom css from the main options field
			unset( $saved_options['advanced']['custom_css'] );
		}

		if ( isset( $saved_options['advanced']['custom_js'] ) ) {
			$custom_js = $saved_options['advanced']['custom_js'];
			update_option( 'zn_'.ZN()->theme_data['theme_id'].'_custom_js', $custom_js, false );

			// Remove custom css from the main options field
			unset( $saved_options['advanced']['custom_js'] );
		}

		$saved_options = apply_filters( 'zn_options_to_save', $saved_options );

		$result = update_option( ZN()->theme_data['options_prefix'], $saved_options);
		generate_options_css($saved_options); //generate static css file

		if ( $result == 0 || $result ) {
				echo 'Settings successfully save';
			die();
		}
		else {
				echo 'There was a problem while saving the options';
			die();
		}
		
	} 
	elseif ( $save_action == 'zn_add_element' ) {

		$data = $_POST;

		if ( empty( $data['zn_elem_type'] ) ) {
			return;
		}

		$value = json_decode ( base64_decode( $data['zn_json'] ), true );
		$value['dynamic'] = true;

		echo ZN()->html()->zn_render_single_option( $value );
		
		die();
	}
	elseif ( $save_action == 'zn_add_google_font' ) {

		$data = $_POST;

		if ( empty( $data['zn_elem_type'] ) ) {
			return;
		}

		$value = json_decode ( base64_decode( $data['zn_json'] ), true );
		if( isset( $data['selected_font'] ) ) {
			$value['selected_font'] = $data['selected_font'];
		}
		$value['dynamic'] = true;

		echo ZN()->html()->zn_render_single_option( $value );
		
		die();
	}
	elseif( $save_action == 'zn_import_dummy_data' ){
		include( FW_PATH .'/importer/zn_importer.php' );
		installDummy();
		die();
	}
	elseif( $save_action == 'zn_process_theme_updater' ){
		ZN()->installer->update( $_POST['step'], $_POST['data'] );
		die();
	}
	elseif( $save_action == 'zn_refresh_pb' ){
		ZN()->pagebuilder->refresh_pb_data();
		die();
	}
	else {
		die('Are you cheating ?');
	}
}


?>
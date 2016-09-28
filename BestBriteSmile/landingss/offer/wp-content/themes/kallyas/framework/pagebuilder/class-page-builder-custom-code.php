<?php
/**
 * This class handles all functionality for the page builder frontend editor
 *
 * @category   Pagebuilder
 * @package    ZnFramework
 * @author     Balasa Sorin Stefan ( ThemeFuzz )
 * @copyright  Copyright (c) Balasa Sorin Stefan
 * @link       http://themeforest.net/user/ThemeFuzz
 */

class ZnPbCustomCode {

	function __construct() {

		add_action( 'znpb_save_page', array(&$this, 'on_page_save') );
		add_action( 'wp' , array(&$this, 'add_inline_css') );
		add_action( 'znpb_editor_tabs_content', array(&$this, 'zn_templates_tab') );
		add_action( 'znpb_editor_tabs_menu', array(&$this, 'zn_templates_tab_menu') );
		
	}

	/**
	 * 
	 *	HOOK INTO PAGEBUILDER TAB NAMES LIST
	 *
	 */
	function zn_templates_tab_menu(){
		echo '<a href="#" data-zn-tab="zn_pb_custom_code" class="zn_pb_tab_handler">CUSTOM CSS</a>';
	}

	/**
	 * 
	 *	HOOK INTO PAGEBUILDER TABS CONTENT
	 *
	 */
	function zn_templates_tab() {
		?>
		<div id="zn_pb_custom_code" class="zn_pb_custom_code zn_pb_tab zn_hide">
			<div class="zn_pb_sidebar">
				<h4>Custom css</h4>
				Use this field to add your own custom css that will be applied to the current page.
			</div>

			<div class="zn_pb_custom_code_container zn_pb_tab_content clearfix">
				<?php

					$saved_css = get_post_meta( zn_get_the_id(), 'zn_page_custom_css', true );
					$option = array(
						'id'			=> 'zn_custom_css',
						'type'			=> 'custom_code',
						'std'			=> $saved_css
						);

					echo ZN()->html()->zn_render_single_option( $option );

				?>

			</div>

		</div>
		<?php
	}

	function on_page_save(){
		if ( isset ( $_POST['custom_css'] ) ) {
			update_post_meta( zn_get_the_id(), 'zn_page_custom_css', $_POST['custom_css'] );
		}
	}

	function add_inline_css(){
		$css = get_post_meta( zn_get_the_id(), 'zn_page_custom_css', true );

		if ( !empty( $css ) ) {
			ZN()->add_inline_css( $css );
		}
	}

}
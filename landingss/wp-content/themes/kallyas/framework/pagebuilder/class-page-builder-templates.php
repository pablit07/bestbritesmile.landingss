<?php
/**
 * This class handles all functionality for the page builder frontend editor
 *
 * @category   Pagebuilder
 * @package    ZnFramework
 * @author     Balasa Sorin Stefan ( ThemeFuzz )
 * @copyright  Copyright (c) Balasa Sorin Stefan
 * @link       http://themeforest.net/user/zauan
 */

class ZnTemplateSystem {

	function __construct() {

		add_action( 'zn_framework_init', array(&$this, 'zn_register_template_system') );
		add_action( 'znpb_editor_tabs_content', array(&$this, 'zn_templates_tab') );
		add_action( 'znpb_editor_tabs_menu', array(&$this, 'zn_templates_tab_menu') );
		
		// SINGLE ELEMENT SAVING
		add_action( 'znpb_editor_tabs_content', array(&$this, 'zn_el_templates_tab') );
		add_action( 'znpb_editor_tabs_menu', array(&$this, 'zn_el_templates_tab_menu') );

	}

	function zn_register_template_system() {
		$args = array(
			'labels' => array('name' => 'Zn Framework' ),
			'show_ui' => false,
			'query_var' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => false,
			'supports' => array( 'title' ), 
			'can_export' => true,
			'public' => true,
			'show_in_nav_menus' => false
		);
		register_post_type( 'zn_pb_templates' , $args);
	}

	/**
	 * 
	 *	GENERATE A TEMPLATE KEY FOR USE IN UPDATE POST META
	 *
	 */
    function zn_generate_key( $name )
    {
        return "_zn_pb_template".str_replace(" ", "_", strtolower($name));
    }

	/**
	 * 
	 *	GET POST ID IF EXISTS OR CREATE A NEW POST USING THE NAME PROVIDED
	 *
	 */
	function zn_get_post_id( $post_title = 'zn_pb_templates' ) {
		// GET THE POST THAT CONTAINS ALL THE TEMPLATES 
		$zn_pb_template_post = get_page_by_title( $post_title , 'ARRAY_A' , 'zn_pb_templates' );

		if(!isset($zn_pb_template_post['ID']) ) 
		{ 

			$post = array(
				'post_type' => 'zn_pb_templates',					
				'comment_status' => 'closed',
				'ping_status' => 'closed',
				'post_content' => '',
				'post_title' => $post_title
				);

			$post_id = wp_insert_post( $post );
		}
		else
		{
			$post_id = $zn_pb_template_post['ID'];
		}

		return $post_id;
	}

	/**
	 * 
	 *	HOOK INTO PAGEBUILDER TAB NAMES LIST
	 *
	 */
	function zn_templates_tab_menu(){
		echo '<a href="#" data-zn-tab="zn_pb_templates" class="zn_pb_tab_handler">TEMPLATES</a>';
	}

	/**
	 * 
	 *	HOOK INTO PAGEBUILDER TABS CONTENT
	 *
	 */
	function zn_templates_tab() {
		?>
		<div id="zn_pb_templates" class="zn_pb_templates zn_pb_tab zn_hide">
			<div class="zn_pb_sidebar">
				<h4>Save new template</h4>
				<input type="text" placeholder="Template name"/>
				<a href="" class="zn_pb_save_template">Save template</a>
			</div>

			<div class="zn_pb_templates_container zn_pb_tab_content zn_has_isotope clearfix">
				<?php

					$templates = $this->zn_pb_get_templates();

					if ( is_array( $templates ) ) {
						foreach ( $templates as $template ) {
							$name = explode("}}}", $template);
							$name = explode("{{{", $name[0]);

							echo $this->template_render( $name[1] );

						}
					}
				?>

			</div>

		</div>
		<?php
	}

	/**
	 * 
	 *	HOOK INTO PAGEBUILDER TAB NAMES LIST
	 *
	 */
	function zn_el_templates_tab_menu(){
		echo '<a href="#" data-zn-tab="zn_pb_el_templates" class="zn_pb_tab_handler">SAVED ELEMENTS</a>';
	}

	/**
	 * 
	 *	HOOK INTO PAGEBUILDER TABS CONTENT
	 *
	 */
	function zn_el_templates_tab() {
		?>
		<div id="zn_pb_el_templates" class="zn_pb_el_templates zn_pb_tab zn_hide">
			<div class="zn_pb_sidebar">
				<h4>Saved elements</h4>
				<p>Here you will find all your saved elements. If you want to add a saved element to your page, just dragg it into your desired location.</p>
			</div>

			<div class="zn_pb_saved_elements_container zn_pb_tab_content zn_has_isotope clearfix">
				<?php

					$templates = $this->zn_pb_get_templates( 'zn_pb_el_templates' );

					if ( is_array( $templates ) ) {
						foreach ( $templates as $template ) {

							$template_data = maybe_unserialize( $template );
							$name = explode("}}}", $template_data['name']);
							$name = explode("{{{", $name[0]);

							echo $this->saved_element_render( $name[1], $template_data );

						}
					}
				?>

			</div>

		</div>
		<?php
	}


		/**
		 * 
		 *	Retrieves all saved templates
		 *
		 */
		function zn_pb_get_templates( $post_name = 'zn_pb_templates', $template_name = '_zn_pb_template%' , $compare = 'LIKE' ) {

			global $wpdb;

			$post_id = $this->zn_get_post_id( $post_name );

			$r = $wpdb->get_col( $wpdb->prepare( "
				SELECT meta_value FROM {$wpdb->postmeta}
				WHERE  meta_key {$compare} '%s'
				AND post_id = '%s'
			",  $template_name , $post_id) );

			return $r;
		}

		function template_render( $name ){

			$template = '<div class="zn_pb_template_container" data-template="'.$this->zn_generate_key($name).'" data-level="1">';
				$template .= '<div class="zn_pb_template">';
					$template .=  '<img class="zn_pb_el_icon" src="'. FW_URL .'/pagebuilder/assets/img/default_icon.png'.'"/>';
					$template .=  '<div class="zn_pb_el_title">'.$name.'<a href="#" class="zn_pb_animate zn_pb_delete_template">Delete</a></div>';

					// TEMPLATE ACTIONS
					$template .=  '<a href="#" class="zn_pb_animate zn_pb_load_template">Load template</a>';
					$template .=  '';

				$template .=  '</div>';
			$template .=  '</div>';

			return $template;
		}

		function saved_element_render( $name, $template_data ){

			if( empty( $template_data['template'] ) || empty( $template_data['level'] ) ){
				return;
			}

			$template = '<div class="zn_pb_element_container" data-znname="'.strtolower($name).'" >';
				$template .= '<div class="zn_pb_element" data-template="'.$this->zn_generate_key($name).'" data-level="'.$template_data['level'].'">';
					$template .=  '<img class="zn_pb_el_icon" src="'. FW_URL .'/pagebuilder/assets/img/default_icon.png'.'"/>';
					$template .=  '<div class="zn_pb_el_title">'.$name.'</div>';

					// TEMPLATE ACTIONS
					$template .=  '<a href="#" class="zn_pb_animate zn_pb_delete_saved_el">Delete</a>';

				$template .=  '</div>';
			$template .=  '</div>';

			return $template;

		}

}
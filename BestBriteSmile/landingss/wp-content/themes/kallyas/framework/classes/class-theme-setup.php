<?php

// This will add the theme options panel if the theme has this support

/*
*	TO DO :
*	Separate theme page css from HTML class css
*
*/

class Zn_Theme_Setup {

	var $theme_pages = array();
	public $data  = array();

	function __construct(){

		add_action('admin_menu', array(&$this, 'zn_add_admin_pages'));
		
		$this->theme_data = ZN()->theme_data;

		// LOAD THE BACKEND FILES
		add_action( 'admin_enqueue_scripts', array(&$this, 'zn_print_scripts') );
		add_action( 'admin_init', array(&$this, 'zn_permalink_settings_init') );
		add_action( 'admin_init', array(&$this, 'zn_permalink_settings_save') );
	}

	/*--------------------------------------------------------------------------------------------------
		Save the permalinks options
	--------------------------------------------------------------------------------------------------*/
	function zn_permalink_settings_save() {
		if ( ! is_admin() )
			return;

		// We need to save the options ourselves; settings api does not trigger save for the permalinks page
		if ( isset( $_POST['zn_permalinks'] ) /*|| isset( $_POST['zn_portfolio_item_slug_input'] ) */ ) {
			$permalinks = $_POST['zn_permalinks'];
			update_option( 'zn_permalinks', $permalinks );
			flush_rewrite_rules();
		}
	}

	/*--------------------------------------------------------------------------------------------------
		Add options for the portfolio and Documentation
	--------------------------------------------------------------------------------------------------*/
	static public function permalink_callback( $field ) {

		$permalinks = get_option( 'zn_permalinks' );

		?>
			<input name="zn_permalinks[<?php echo $field['id']; ?>]" type="text" class="regular-text code" value="<?php if ( isset( $permalinks[$field['id']] ) ) echo esc_attr( $permalinks[$field['id']] ); ?>" placeholder="<?php echo $field['id']; ?>" />
		<?php
	}

	function zn_permalink_settings_init() {

		$post_types = array();
		$taxonomies = array();
		$this->zn_allowed_post_types = apply_filters( 'zn_allowed_post_types', $post_types );
		$this->zn_allowed_taxonomies = apply_filters( 'zn_allowed_taxonomies', $taxonomies );

		foreach ( $this->zn_allowed_post_types as $id => $name) {

			$post_type_section_id = 'zn-'.$id.'-permalink';
			
			// SECTION : UNIQUE ID, NAME, CALLBACK, SETTINGS PAGE
			add_settings_section( $post_type_section_id, $name.' Slugs', '', 'permalink' );

			$this->add_settings_field( $id, $name, $post_type_section_id );

			if ( !empty( $this->zn_allowed_taxonomies[$id] ) ) {

				$current_taxonomies = $this->zn_allowed_taxonomies[$id];
				foreach ( $current_taxonomies as $key => $taxonomy) {
					$this->add_settings_field( $taxonomy['id'], $taxonomy['name'], $post_type_section_id );
				}

			}

		}
	}

	function add_settings_field( $id, $name, $section ) {

		// Add Slug option
		add_settings_field(
			$id,      	// id
			$name .' item slug', 	// setting title
			array('Zn_Theme_Setup','permalink_callback'),  // display callback
			'permalink',                 				// settings page
			$section,                 				// settings section
			array(
				'id'	=> $id
			)
		);
	}

	function get_theme_options_pages(){

		if ( !file_exists(THEME_BASE.'/template_helpers/options/theme-pages.php') ) { return array(); }
		include( THEME_BASE.'/template_helpers/options/theme-pages.php');
		return apply_filters( 'zn_theme_pages', $admin_pages );
	}

	function get_theme_options(){
		include(THEME_BASE.'/template_helpers/options/theme-options.php');
		return apply_filters( 'zn_theme_options', $admin_options );
	}


	function zn_add_admin_pages(){

		$this->data['theme_pages'] = $this->get_theme_options_pages();

		$i = 0;

		foreach ( $this->data['theme_pages'] as $key => $value ) {
				
				if ( $i == 0 ){
					$this->theme_pages[] = add_menu_page(
						$value['title'],
						ZN()->theme_data['name'] .' Options', 
						'manage_options',
						'zn_tp_'.$key, 
						array(&$this, 'zn_render_page')
					);

					$main_page = 'zn_tp_'.$key;

				}

				/* CREATE THE SUBPAGES */
				$this->theme_pages[] = add_submenu_page (
						$main_page,
						$value['title'],
						$value['title'],
						'manage_options',
						'zn_tp_'.$key,
						array(&$this, 'zn_render_page')
					);
			$i++;

		}
	}

	function zn_print_scripts( $hook ){

		/* Set default theme pages where the js and css should be loaded */
		$this->theme_pages[] = 'post.php';
		$this->theme_pages[] = 'post-new.php';
		$this->theme_pages[] = 'widgets.php';
		$this->theme_pages   = apply_filters( 'zn_theme_pages', $this->theme_pages );

		if ( !in_array( $hook, $this->theme_pages ) ) {
			return;
		}

		// Don't allow heartbeat in the advanced page
		if( $hook == 'kallyas-options_page_zn_tp_advanced_options' ){
			wp_deregister_script('heartbeat');
		}

		// LOAD CUSTOM SCRIPTS
		wp_enqueue_script( 'zn_theme_ajax_callback', FW_URL .'/assets/js/zn_theme_ajax_callback.js', 'jquery','',true );
		add_action('admin_print_styles', array( &$this, 'admin_css' ) );

		ZN()->load_html_scripts();
	}

	function admin_css(){
		echo '<!-- ICON FONTS CSS -->';
		echo '<style type="text/css">';
			echo ZN()->icon_manager->set_css( '' );
		echo '</style>';
	}

	function zn_render_page() {

		// Get the curent slug
		$slug = $_GET['page'];
		$slug = str_replace( 'zn_tp_', '', $slug );
		$this->data['slug'] = $slug;

		
		$this->data['theme_options'] = $this->get_theme_options();
		ZN()->html()->zn_set_data( $this->data );
		
		echo ZN()->html()->zn_page_start();

		echo ZN()->html()->zn_render_page_options();

		echo ZN()->html()->zn_page_end();
	}

}


?>

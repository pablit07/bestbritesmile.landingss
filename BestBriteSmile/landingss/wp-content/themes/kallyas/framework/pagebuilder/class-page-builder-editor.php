<?php
/**
 * This class handles all functionality for the page builder frontend editor
 *
 * @category   Pagebuilder
 * @package    ZnFramework
 * @author     Balasa Sorin Stefan ( Zauan )
 * @copyright  Copyright (c) Balasa Sorin Stefan
 * @link       http://themeforest.net/user/zauan
 */
class ZnPageBuilderEditor  {

	function __construct() {

		// Disable caching
		$this->disable_caching();


		add_action( 'zn_footer', array(&$this, 'zn_add_front_editor') );
		add_action( 'zn_footer', array(&$this, 'zn_add_factory') );
		add_action( 'wp_enqueue_scripts', array(&$this, 'load_scripts') );
		add_filter( 'body_class',array(&$this, 'zn_add_body_class'));

		// LOAD ALL THE ELEMENTS SCRIPTS AND INLINE JS
		add_action( 'wp_footer' , array(&$this, 'zn_add_inline_js') );
		add_action( 'zn_pb_content', array(&$this, 'zn_dummy_content') );

		// Fix post_type not added for ajax calls
		// See wp-includes/post-template.php -- ! is_admin
		add_filter( 'post_class', array( &$this, 'fix_post_classes' ) );
	}

	function fix_post_classes( $classes, $class = '', $post_id = '' ){
		$post = get_post( $post_id );

		$classes[] = $post->post_type;

		return $classes;
	}

	function disable_caching(){

		// Disable W3 Total cache for editing page
		define('DONOTCACHEPAGE', true);
		define('DONOTCACHEDB', true);
		define('DONOTMINIFY', true);
		define('DONOTCDN', true);
		define('DONOTCACHCEOBJECT', true);
		
	}

	function zn_add_body_class($classes) {
		$classes[] = 'zn_pb_editor_enabled';
		$classes[] = 'zn_pb_loading';

		return $classes;
	}

	function zn_add_factory(){
		?>
		<!-- PAGEBUILDER FACTORY -->
		<script>

			!function ($) {
				$.ZnPbFactory = {
					current_layout : <?php echo json_encode( ZNPB()->current_modules ); ?>
				}
			}(jQuery)

		</script><?php
	}

	function build_options_array( $layout_data, $single = false ) {

		if( empty( $layout_data ) ) { return array(); }

		$data = array();

		foreach ( $layout_data as $key => $module ) {

			$data[ $module['uid'] ] = $module;
			$data[ $module['uid'] ]['content'] = array();

			if( !empty( $module['content'] ) ) {

				if ( !empty( $module['content']['has_multiple'] ) ) {

					unset( $module['content']['has_multiple'] );
	
					foreach ( $module['content'] as $actual_content ) {
						$data = array_merge( $data, $this->build_options_array( (array)$actual_content ) );
					}

				}
				else {
					$data = array_merge( $data, $this->build_options_array( $module['content'] ) );
				}
			}
		}

		return $data;
	}

	static public function enable_editor(){
		$post_id = zn_get_the_id();
		$post = get_post( $post_id );

		// Save the post as draft if this is an auto-draft
		if ( $post->post_status === 'auto-draft' ) {
			$post_data = array( 'ID' => $post_id, 'post_status' => 'draft' );
			wp_update_post( $post_data );
		}

		update_post_meta( $post_id, 'zn_page_builder_status', 'enabled');

	}

	static public function disable_editor(){
		$post_id = zn_get_the_id();
		update_post_meta( $post_id, 'zn_page_builder_status', 'disabled' );
	}

	function zn_dummy_content(){

		$args = array(
			'editor_class' => 'zn_tinymce',
			'default_editor' => 'tmce',
			'textarea_name' => 'zn_dummy_editor_id',
			'textarea_rows' => 5,
			'tinymce' => array(
				'setup' => 'function(editor) {
					editor.on( "change SetContent" , function( e ){
						editor.save();
						console.log( "changed" );
					});
				}'
			)
		);

		echo '<div class="zn_hidden">';
			wp_editor( 'dummy_text', 'zn_dummy_editor_id', $args );
		echo '</div>';
	}

	function load_scripts(){

		wp_enqueue_style( 'zn_pb_style', FW_URL .'/pagebuilder/assets/css/zn_front_pb.css');

        wp_register_style('open-sans', 'http://fonts.googleapis.com/css?family=Open+Sans%3A300italic%2C400italic%2C600italic%2C300%2C400%2C600&subset=latin%2Clatin-ext');
        wp_enqueue_style( 'open-sans');

		// PB SPECIFIC PLUGINS
		wp_enqueue_script( 'isotope' );
		wp_enqueue_script( 'jquery-ui-sortable' ); // HTML + PB
		wp_enqueue_script( 'jquery-ui-draggable' ); // PB

		// IRIS IS NOT AVAILABLE IN FRONTEND SO WE NEED TO MANUALLY LOAD IT
		wp_enqueue_script('iris', admin_url( 'js/iris.min.js' ), array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ), false, 1 );
		wp_enqueue_script('wp-color-picker', admin_url( 'js/color-picker.min.js' ), array( 'iris' ), false, 1 );
		$colorpicker_l10n = array(
		    'clear' => __( 'Clear', 'zn_framework' ),
		    'defaultString' => __( 'Default', 'zn_framework' ),
		    'pick' => __( 'Select Color', 'zn_framework' )
		);
		wp_localize_script( 'wp-color-picker', 'wpColorPickerL10n', $colorpicker_l10n ); 

		// PAGE BUILDER CUSTOM SCRIPTS
		
		//wp_enqueue_script( 'ZnPagebuilderTemplates', FW_URL .'/pagebuilder/assets/js/ZnPagebuilderTemplates.js',array('jquery','zn_html_script'),'',true );
		wp_enqueue_script( 'zn_front_pb', FW_URL .'/pagebuilder/assets/js/zn_front_pb.js',array('jquery','zn_html_script'),'',true );

		ZN()->load_html_scripts();

		// Load all JS files that are required by the elements
		foreach( ZN()->pagebuilder->all_available_elements as $class => $element ){
			if ( $element['scripts'] ) {
				include_once( $element['file'] );
				$element = new $element['class'];
				$element->scripts();
			}
		}

	}

	function zn_add_inline_js() {
		do_action( 'zn_pb_inline_js' );
	}

	function zn_add_front_editor() {

		$categories = $this->zn_categories();
		$has_page_options = file_exists(THEME_BASE.'/template_helpers/pagebuilder/page_options.php') ? true : false;

		require( PB_PATH .'/templates/editor.tpl.php' );

	}

	function zn_categories(){

		$categories = array(
			'fullwidth' => 'Full width',
			'layout' => 'Layouts',
			'content' => 'Content',
			'post' => 'Single elements',
			'media' => 'Media',
			'headers' => 'Headers',
			);

		return apply_filters( 'zn_pb_categories', $categories );
	}

	/* EDITOR RENDER ELEMENTS METHOD */
	function default_options( $element ) {

		$options = array();
		$options = apply_filters( 'zn_pb_options'.$element->info['level'], $options );
		$options = apply_filters( 'zn_pb_options', $options );
		return $options;
	}

	function before_element( $element ) {

		$size = '';
		$css_class = '';
		if ( $element->info['flexible'] ) {

			$size = ( !empty( $element->data['width'] ) ) ? $element->data['width'] : 'col-md-12';
			if ( strpos( $size, 'col-md-') === false ) { $size = str_replace('col-sm-', 'col-md-', $size); }
			$actual_size = $size;
			
			// RESPONSIVE FIXES
			$size_small = ( !empty( $element->data['options']['size_small'] ) ) ? $element->data['options']['size_small'] : str_replace('col-md-', 'col-sm-', $size);
			$size_xsmall = ( !empty( $element->data['options']['size_xsmall'] ) ) ? $element->data['options']['size_xsmall'] : '';
			// Set the proper responsive classes 
			$size = $size .' '. $size_small .' '. $size_xsmall;

			
			$css_class = 'sortable_column';
			$element->data['width'] = 'zn_edit_mode';
			$element->data['options']['size_small'] = 'zn_edit_mode';
			$element->data['options']['size_xsmall'] = 'zn_edit_mode';

		}

		if ( !empty( $element->data['options']['column_offset'] ) ){
			$size .= ' '.$element->data['options']['column_offset'].' ';
		}



		$uid = zn_uid();

		echo '<div class="zn_pb_el_container zn_pb_section '.$size.' zn_element_'.strtolower($element->info['class']).'" data-form-uid="'.$uid.'" data-el-name="'.$element->info['name'].' options" data-uid="'.$element->data['uid'].'" data-level="'.$element->info['level'].'" data-object="'.$element->info['class'].'" data-has_multiple="'.$element->info['has_multiple'].'">';
			echo '<div class="zn_el_options_bar zn_pb_animate">';

				// SHOW THE WIDTH SELECTOR BUTTON
				if ( $element->info['flexible'] ) {

					$sizes = array(
						'col-md-12' => '12/12' ,
						'col-md-11' => '11/12' ,
						'col-md-10' => '10/12' ,
						'col-md-9'  => '9/12' ,
						'col-md-8'  => '8/12' ,
						'col-md-7'  => '7/12' ,
						'col-md-6'  => '6/12' ,
						'col-md-5'  => '5/12' ,
						'col-md-4'  => '4/12' ,
						'col-md-3'  => '3/12' ,
						'col-md-2'  => '2/12',
						'col-md-1-5'  => '1/5',
					);

					echo '<span class="zn_pb_select_width znpb_icon-resize-full zn_pb_icon">';
						echo '<span class="znpb_sizes_container">';

							foreach ( $sizes as $key => $value ) {
								$selected_width = '';
								if ( $key == $actual_size ) { $selected_width = ' class="selected_width" '; }
								echo '<span '.$selected_width.' data-width="'.$key.'">'.$value.'</span>';
							}

						echo '</span>';
					echo '</span>';
					//echo '<span class="zn_pb_increase zn_icon">&#xe2d3;</span>';
				}

				echo '<span class="znpb-element-title">'.$element->info['name'].'</span>';
				echo '<a class="zn_pb_remove znpb_icon-cancel zn_pb_icon"></a>';

				echo '<a class="zn_pb_group_handle znpb_icon-move zn_pb_icon" data-level="'.$element->info['level'].'"></a>';
				echo '<a class="zn_pb_clone_button znpb_icon-docs zn_pb_icon" data-clone="clone"></a>';
				
				// Element options
				if( $element->options() ) {
					echo '<a data-uid="'.$element->data['uid'].'" class="znpb-element-options-trigger zn_pb_edit_el znpb_icon-cog-alt zn_pb_icon"></a>';
				}
		
				// Element save
				echo '<a data-uid="'.$element->data['uid'].'" class="znpb-element-save-trigger znpb_icon-save zn_pb_icon"></a>';

				echo '</div>'; // END OPTIONS BAR
				
				
	}

	function after_element( $element ){

	}

}
?>
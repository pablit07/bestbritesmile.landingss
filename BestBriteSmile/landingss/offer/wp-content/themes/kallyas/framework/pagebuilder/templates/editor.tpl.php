<div class="zn_pb_placeholder"></div>
<div class="zn_front_pb_wrap">
	<div class="zn_pb_dragbar"></div>
	<div class="zn_pb_header clearfix">
		<div class="zn_fpb_buttons zn_left">
			<a class="zn_pb_icon zn_pb_close_panel znpb_icon-cancel zn_pb_icon" href="#"></a>
			<a href="#" data-zn-tab="zn_pb_content" class="zn_pb_add_el zn_pb_tab_handler">ADD ELEMENTS</a>
			<?php if ( $has_page_options ) { echo '<a href="#" data-zn-tab="zn_pb_page_options" class="zn_pb_tab_handler">PAGE OPTIONS</a>'; } ?>


			<?php do_action( 'znpb_editor_tabs_menu' ); ?>

		</div>

		<div class="zn_fpb_buttons zn_right">
			<div class="zn_pb_editor_right_action">
				<?php do_action( 'zn_pb_editor_right' ); ?>
			</div>

			<input class="zn_pb_search" type="text" placeholder="Search for an element"/>
			<a class="zn_publish" href="#">
				<span class="zn_publish_loading"></span>
				<span class="zn_publish_text">PUBLISH</span>
			</a>
		</div>			
	</div>

	<div class="zn_pb_tab_wrapper" class="fixclear">
		
		<div id="zn_pb_content" class="zn_pb_tab">
			<div class="zn_pb_sidebar">
				<ul class="zn_pb_groups">
					<li><a href="#" class="zn_pb_selected zn_pb_all" data-filter="*"><span class="zn_pb_circle"></span>All elements</a></li>
					<?php
						foreach ( $categories as $trigger => $name ){
							echo '<li><a href="#" data-filter=".'.$trigger.'"><span class="zn_pb_circle"></span>'.$name.'</a></li>';
						}
					?>
				</ul>
			</div>
			<div class="zn_pb_elements zn_pb_tab_content zn_has_isotope clearfix">
				<?php

					foreach ( ZN()->pagebuilder->all_available_elements as $element_class => $element ) {

						$icon = '<img class="zn_pb_el_icon" src="'.$element['icon'].'"/>';
						$name = sprintf('<div class="zn_pb_el_title">%s</div>', $element['name']);
						$categories = explode(',', $element['category']);
						$all_cats = array();
						foreach ($categories as $key => $value) {
							$all_cats[] = strtolower( $value );
						}

						$category = implode( ' ', $all_cats);
						$category_markup = ( isset( $categories[$element['category']] ) ) ? sprintf('<div class="zn_pb_el_category">%s</div>', $categories[$element['category']] ) : sprintf('<div class="zn_pb_el_category">%s</div>', $element['category']);
						$file = $element['file'];

						//printf('<div class="zn_pb_element_container %s" data-znname="%s"><div class="zn_pb_element" data-object="%s" data-level="%s">%s%s%s</div></div>', $category,  strtolower($element['name']) , $element_class, $element['level'], $icon , $name , $category_markup );

						$filter_level = (int)$element['level'] - 1;
						$filter_level = 'filter_level_'.$filter_level;
						echo '<div class="zn_pb_element_container '.$category.' '.$filter_level.'" data-znname="'.strtolower($element['name']).'"><div class="zn_pb_element" data-object="'.$element_class.'" data-level="'.$element['level'].'">'.$icon . $name . $category_markup.'</div></div>';

					}

				?>
			</div>
		</div>	

		<?php
			/*
			*	Add page options tab if the theme supports it
			*/
			if ( $has_page_options ) {
				global $post;
				include( THEME_BASE.'/template_helpers/pagebuilder/page_options.php');

				?>
				<div id="zn_pb_page_options" class="zn_pb_page_options zn_pb_tab zn_hide clearfix">

					<div class="zn_pb_tab_content zn_pb_tab_content_no_sidebar clearfix">
						<form action="" id="znpb_page_options">
							<?php
								foreach ( $page_options as $key => $element) {
									if( in_array( get_post_type() , $element['slug']  ) )
									{
										$saved_value = get_post_meta( $post->ID, $element['id'] , true);
										if(  !empty($saved_value) ) {
											$element['std'] = $saved_value;
										}

										echo ZN()->html()->zn_render_single_option( $element );

									}
								}
							?>
						</form>
					</div>

				</div>
			<?php
			}
		?>

		
		<?php 
		/*
		*	HOOK INTO THE TABS
		*/
		do_action( 'znpb_editor_tabs_content' ); 

		?>


	</div>
	<input type="hidden" id="zn_post_id" value="<?php echo ZN()->pagebuilder->get_post_id();?>"/>
</div>
<div class="zn_page_loading"></div>
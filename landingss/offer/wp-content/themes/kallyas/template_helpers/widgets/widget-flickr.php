<?php

/**
 * Navigation Menu widget class
 *
 * @since 3.0.0
 */
class ZN_Flickr_Widget extends WP_Widget
{
	function __construct()
	{
		$widget_ops = array ( 'description' => __( 'Use this widget to add images from Flickr to your site.', 'zn_framework' ) );
		parent::__construct( 'zn_flickr', __( '[' . 'Kallyas' . '] Flickr Widget', 'zn_framework' ), $widget_ops );
	}

	function widget( $args, $instance )
	{
		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . $instance['title'] . $args['after_title'];
		}

		echo '<div class="flickrfeed loading">';
		echo '<ul class="flickr_feeds fixclear" data-size="' . $instance['flickr_size'] . '"></ul>';
		echo '</div><!-- end // flickrfeed -->';

		echo $args['after_widget'];

		$flickr = array (
			'zn_flickr_feed' => "
			;(function($){
				jQuery(window).load(function() {
					// load flicker photos
					var ff_container = jQuery('.flickr_feeds'),
						ff_limit = (ff_container.attr('data-limit')) ?  ff_container.attr('data-limit') : 6;

					ff_container.parent().removeClass('loading');
						// ff_limit = if data-limit attribute is set, the limit is user defined, if not, default is 6

					ff_container.jflickrfeed({
						limit: " . $instance['flickr_num'] . ",
						qstrings: {
							id: '" . $instance['flickr_id'] . "'
						},
						itemTemplate: '<li><a href=\"{{image_b}}\" data-lightbox=\"image\"><img src=\"{{image_s}}\" alt=\"{{title}}\" /><span class=\"theHoverBorder \"></span></a></li>'
					}, function(data) {
						jQuery(\".flickr_feeds a[data-lightbox='image']\").magnificPopup({type:'image', tLoading: ''});
					});

				});
			})(jQuery);"
		);
		zn_update_array( $flickr );
	}

	function update( $new_instance, $old_instance )
	{
		$instance['title'] = strip_tags( stripslashes( $new_instance['title'] ) );
		$instance['flickr_id']  = strip_tags( stripslashes( $new_instance['flickr_id'] ) );
		$instance['flickr_num'] = strip_tags( stripslashes( $new_instance['flickr_num'] ) );
		$instance['flickr_size'] = strip_tags( stripslashes( $new_instance['flickr_size'] ) );
		return $instance;
	}

	function form( $instance )
	{
		$title       = isset( $instance['title'] ) ? $instance['title'] : '';
		$flickr_id   = isset( $instance['flickr_id'] ) ? $instance['flickr_id'] : '';
		$flickr_num  = isset( $instance['flickr_num'] ) ? $instance['flickr_num'] : '6';
		$flickr_size = isset( $instance['flickr_size'] ) ? $instance['flickr_size'] : '';

		$sizes = array ( 'small' => 'Small', 'normal' => 'Normal' );

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'zn_framework' ) ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
				   name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>"/>
		</p>
		<p>
			<label
				for="<?php echo $this->get_field_id( 'flickr_id' ); ?>"><?php _e( 'Flickr ID:', 'zn_framework' ) ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'flickr_id' ); ?>"
				   name="<?php echo $this->get_field_name( 'flickr_id' ); ?>" value="<?php echo $flickr_id; ?>"/>
		</p>
		<p>
			<label
				for="<?php echo $this->get_field_id( 'flickr_num' ); ?>"><?php _e( 'Number of images:', 'zn_framework' ) ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'flickr_num' ); ?>"
				   name="<?php echo $this->get_field_name( 'flickr_num' ); ?>" value="<?php echo $flickr_num; ?>"/>
		</p>
		<p>
			<label
				for="<?php echo $this->get_field_id( 'flickr_size' ); ?>"><?php _e( 'Image Size:', 'zn_framework' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'flickr_size' ); ?>"
					name="<?php echo $this->get_field_name( 'flickr_size' ); ?>">
				<?php

					foreach ( $sizes as $key => $value ) {
						$selected = $flickr_size == $key ? ' selected="selected"' : '';
						echo '<option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
					}
				?>
			</select>
		</p>
	<?php
	}
}
function register_widget_ZN_Flickr_Widget(){
	register_widget( "ZN_Flickr_Widget" );
}

add_action( 'widgets_init', 'register_widget_ZN_Flickr_Widget' );

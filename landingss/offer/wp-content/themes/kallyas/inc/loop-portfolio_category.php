<?php
global $zn_config;
//Items per page
$ports_num_columns = ! empty( $zn_config['port_columns'] ) ? $zn_config['port_columns'] : zget_option( 'ports_num_columns', 'portfolio_options', false, '4' );
$extra_content = ! empty( $zn_config['ports_extra_content'] ) ? $zn_config['ports_extra_content'] : zget_option( 'ports_extra_content', 'portfolio_options', false, 'no' );
$saved_alt = $saved_title = '';
$colWidth = 12 / intval($ports_num_columns);

echo '<div class="row">';

	$i = 0; // size(width) counter
	// Start the loop
	if ( have_posts() ) : while ( have_posts() ) :  the_post();
		$i += $colWidth;
		echo '<div class="col-sm-'.$colWidth.'">';

			echo '<div class="portfolio-item kl-has-overlay">';

				if( $ports_num_columns == 1 ){
					echo '<div class="row">';
					echo '<div class="col-sm-6">';
				}

				echo '<div class="img-intro">';
					$port_media = get_post_meta( $post->ID, 'zn_port_media', true );
					if ( ! empty ( $port_media ) && is_array( $port_media ) ) {
						$size      = zn_get_size( 'eight' );
						$has_image = false;

						// Modified portfolio display
						// Check to see if we have images
						if ( $portfolio_image = $port_media[0]['port_media_image_comb'] ) {
							if ( is_array( $portfolio_image ) ) {
								if ( $saved_image = $portfolio_image['image'] ) {
									if ( ! empty( $portfolio_image['alt'] ) ) {
										$saved_alt = $portfolio_image['alt'];
									}
									else {
										$saved_alt = '';
									}

									if ( ! empty( $portfolio_image['title'] ) ) {
										$saved_title = 'title="' . $portfolio_image['title'] . '"';
									}
									else {
										$saved_title = '';
									}

									$has_image = true;
								}
							}
							else {
								$saved_image = $portfolio_image;
								$has_image   = true;
								$saved_alt   = '';
								$saved_title = '';
							}

							if ( $has_image ) {
								$image = vt_resize( '', $saved_image, $size['width'], '', true );
							}
						}

						// Check to see if we have video
						$portfolio_media = $port_media[0]['port_media_video_comb'];

						// Display the media
						if ( ! empty( $saved_image ) && $portfolio_media ) {
							echo '<a href="' . $portfolio_media . '" data-mfp="iframe" data-lightbox="iframe" class="hoverLink"></a>';
							echo '<img src="' . $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" alt="' . $saved_alt . '" ' . $saved_title . ' />';
							echo '<div class="overlay">';
							echo '<div class="overlay-inner">';
							echo '<span class="glyphicon glyphicon-play"></span>';
							echo '</div>';
							echo '</div>';
						}
						elseif ( ! empty( $saved_image ) ) {
							if ( zget_option( 'zn_link_portfolio', 'portfolio_options', false, 'no' ) == 'yes' ) {
								echo '<a href="' . get_permalink() . '" data-type="image" class="hoverLink"></a>';
								echo '<img src="' . $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" alt="' . $saved_alt . '" ' . $saved_title . ' />';
								echo '<div class="overlay">';
								echo '<div class="overlay-inner">';
								echo '<span class="glyphicon glyphicon-picture"></span>';
								echo '</div>';
								echo '</div>';
							}
							else {
								echo '<a href="' . $saved_image . '" data-type="image" data-lightbox="image" class="hoverLink"></a>';
								echo '<img src="' . $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" alt="' . $saved_alt . '" ' . $saved_title . ' />';
								echo '<div class="overlay">';
								echo '<div class="overlay-inner">';
								echo '<span class="glyphicon glyphicon-picture"></span>';
								echo '</div>';
								echo '</div>';
							}
						}
						elseif ( $portfolio_media ) {
							echo get_video_from_link( $portfolio_media, '', $size['width'], $size['height'] );
						}
					}
				echo '</div><!-- img intro -->';

				// If we have only 1 column
				if( $ports_num_columns == 1 ){
					echo '</div>';
					echo '<div class="col-sm-6">';
				}

				echo '<div class="portfolio-entry">';
					echo '<h3 class="title">';
						echo '<a href="' . get_permalink() . '" >' . get_the_title() . '</a>';
					echo '</h3>';
					echo '<div class="pt-cat-desc">';

						if (preg_match('/<!--more(.*?)?-->/', $post->post_content)) {
							the_content('');
						}
						else {
							$exc = get_the_excerpt();
							echo wpautop( wp_trim_words($exc, 10) );
						}

					echo '</div><!-- pt cat desc -->';

				if( $ports_num_columns == 1 && $extra_content == 'yes' ){
					get_template_part( 'inc/details', 'portfolio' );
				}

				echo '</div><!-- End portfolio-entry -->';

				// If we have only 1 column
				if( $ports_num_columns == 1 ){
					echo '</div>'; // End col-sm-6
					echo '</div>'; // End row
				}

			echo '</div><!-- END portfolio-item -->';
		echo '</div><!-- END col-sm-x-->';
		if( $i >= 12 ){
			echo '<div class="clearfix"></div>';
			$i = 0;
		}
		endwhile;
	endif;
echo '</div>'; ?>
<?php zn_pagination(); ?>

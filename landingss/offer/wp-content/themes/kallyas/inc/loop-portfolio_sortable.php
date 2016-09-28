<?php
	global $zn_config;
	wp_enqueue_script( 'isotope');
?>
	<div class="hg-portfolio-sortable">
		<div id="sorting" class="fixclear">

			<span class="sortTitle"> <?php _e( "Sort By:", 'zn_framework' ); ?> </span>
			<ul id="sortBy" class="option-set " data-option-key="sortBy" data-default="">
				<li><a href="#sortBy=name" data-option-value="name"><?php _e( "Name", 'zn_framework' ); ?></a></li>
				<li><a href="#sortBy=date" data-option-value="date"><?php _e( "Date", 'zn_framework' ); ?></a></li>
			</ul>

			<span class="sortTitle"> <?php _e( "Direction:", 'zn_framework' ); ?> </span>
			<ul id="sort-direction" class="option-set" data-option-key="sortAscending">
				<li><a href="#sortAscending=true" data-option-value="true"><?php _e( "ASC", 'zn_framework' ); ?></a></li>
				<li><a href="#sortAscending=false" data-option-value="false"><?php _e( "DESC", 'zn_framework' ); ?></a></li>
			</ul>

		</div>
		<!-- end sorting toolbar -->

		<?php if ( ! is_tax() || isset( $zn_config['portfolio_categories'] ) ) {

			$ptf_current = !empty( $zn_config['ptf_sort_activebutton'] ) ? $zn_config['ptf_sort_activebutton'] : zget_option('ptf_sort_activebutton', 'portfolio_options', false, '*');

			?>
			<ul id="portfolio-nav" class="fixclear">
				<li <?php if($ptf_current == '*') echo 'class="current"'; ?>><a href="#" data-filter="*"><?php _e( "All", 'zn_framework' ); ?></a></li>
				<?php


					$args = array ();

					if ( isset( $zn_config['portfolio_categories'] ) ) {
						$args = array (
							'include' => $zn_config['portfolio_categories'],
						);
					}

					$terms = get_terms( 'project_category', $args );
					foreach ( $terms as $term ) {
						$current = $term->term_id == $ptf_current ? 'class="current"' : '';
						echo '<li '.$current.'><a href="#" data-filter=".' . $term->slug . '_sort">' . $term->name . '</a></li>';
					}

				?>

			</ul><!-- end nav toolbar -->
		<?php } ?>


		<div class="clear"></div>


		<?php
		// Set num columns
		$numColumns = !empty( $zn_config['port_columns'] ) ? $zn_config['port_columns'] : zget_option('ports_num_columns', 'portfolio_options', false, 4);
		?>
		<ul id="thumbs" class="fixclear" data-columns="<?php echo $numColumns;?>">
			<?php if ( have_posts() ): while ( have_posts() ): the_post();
				global $post;
				// GET THE ASSIGNED CATEGORIES
				$css_classes     = '';
				$item_categories = get_the_terms( $post->ID, 'project_category' );

				if ( is_object( $item_categories ) || is_array( $item_categories ) ) {
					foreach ( $item_categories as $cat ) {
						$css_classes .= $cat->slug . '_sort ';
					}
				}
				?>

				<li class="item kl-has-overlay <?php echo $css_classes; ?> even" data-date="<?php the_time( 'U' ); ?>">

					<div class="inner-item">
                        <div class="img-intro">
						<?php
							$port_media = get_post_meta( $post->ID, 'zn_port_media', true );
							if ( ! empty ( $port_media ) && is_array( $port_media ) ) {

								$size      = zn_get_size( 'portfolio_sortable' );
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
										$image = vt_resize( '', $saved_image, '', '', true );
									}
								}

								// Check to see if we have video
								if ( $portfolio_media = $port_media[0]['port_media_video_comb'] ) {
									$portfolio_media = str_replace( '', '&amp;', $portfolio_media );
								}

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
						?>
                        </div>

						<h4 class="title">
							<a href="<?php the_permalink(); ?>"><span class="name"><?php the_title(); ?></span></a>
						</h4>
                        <?php
                            $excerpt = get_the_excerpt();
                            $excerpt = strip_shortcodes( $excerpt );
                            $excerpt = strip_tags( $excerpt );
                            $the_str = mb_substr( $excerpt, 0, 116 );
                            if(! empty($the_str)){
                        ?>
                            <span class="moduleDesc">
                                <?php echo $the_str . '...'; ?>
                            </span>
                        <?php } ?>
						<div class="clear"></div>
					</div>
					<!-- end ITEM (.inner-item) -->
				</li>
			<?php endwhile; ?>
			<?php endif; ?>
		</ul>
		<!-- end items list -->
	</div>
	<!-- end Portfolio page -->

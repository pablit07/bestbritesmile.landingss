<?php
    global $zn_config;
    $frame_style = !empty( $zn_config['frame_style'] ) ? $zn_config['frame_style'] : zget_option( 'frame_style', 'portfolio_options', false, 'classic' );

    // Load scripts required
    wp_enqueue_script( 'caroufredsel');
    wp_enqueue_script( 'isotope');
?>
	<div class="hg-portfolio-carousel">
		<?php
			if ( have_posts() ): while ( have_posts() ) : the_post();
				?>
                <div class="portfolio-item">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="ptcontent">
                                <h3 class="title pt-content-title">
                                    <a href="<?php the_permalink(); ?>">
                                        <span class="name"><?php the_title(); ?></span>
                                    </a>
                                </h3>
                                <div class="pt-cat-desc">
                                    <?php
                                        if ( strpos( get_the_content(), 'more-link' ) !== false ) {
                                            the_content( '' );
                                        }
                                        else {
                                            the_excerpt();
                                        }
                                    ?>
                                </div>
                                <!-- end item desc -->
                                <?php
                                // Item Links
                                $zn_sp_client = get_post_meta( get_the_ID(), 'zn_sp_client', true );
                                $zn_sp_year = get_post_meta( get_the_ID(), 'zn_sp_year', true );
                                $zn_sp_services = get_post_meta( get_the_ID(), 'zn_sp_services', true );
                                $sp_col = get_post_meta( get_the_ID(), 'zn_sp_col', true );


                                if ( ! empty ( $zn_sp_client ) || ! empty ( $zn_sp_year ) || ! empty ( $zn_sp_services ) || ! empty ( $sp_col ) ) {

                                    echo '<ul class="portfolio-item-details clearfix">';

                                        if ( ! empty ( $zn_sp_client ) ) {
                                            echo '
                                            <li class="portfolio-item-details-client clearfix">
                                                <span class="portfolio-item-details-label">' . __( "CLIENT ", 'zn_framework' ) . '</span>
                                                <span class="portfolio-item-details-item">' . $zn_sp_client . '</span>
                                            </li>';
                                        }

                                        if ( ! empty ( $zn_sp_year ) ) {
                                            echo '
                                            <li class="portfolio-item-details-year clearfix">
                                                <span class="portfolio-item-details-label">' . __( "YEAR ", 'zn_framework' ) . '</span>
                                                <span class="portfolio-item-details-item">' . $zn_sp_year . '</span>
                                            </li>';
                                        }

                                        if ( ! empty ( $zn_sp_services ) ) {
                                            echo '
                                            <li class="portfolio-item-details-services clearfix">
                                                <span class="portfolio-item-details-label">' . __( "WE DID ", 'zn_framework' ) . '</span>
                                                <span class="portfolio-item-details-item">' . $zn_sp_services . '</span>
                                            </li>';
                                        }

                                        if ( ! empty ( $sp_col ) ) {
                                            echo '
                                            <li class="portfolio-item-details-partners clearfix">
                                                <span class="portfolio-item-details-label">' . __( "PARTNERS ", 'zn_framework' ) . '</span>
                                                <span class="portfolio-item-details-item">' . $sp_col . '</span>
                                            </li>';
                                        }

                                        echo '
                                        <li class="portfolio-item-details-cat clearfix">
                                            <span class="portfolio-item-details-label">' . __( "CATEGORY ", 'zn_framework' ) . '</span>
                                            <span class="portfolio-item-details-item">' . get_the_term_list( get_the_ID(), 'project_category', '', ' , ', '' ) . '</span>
                                        </li>';

                                    echo '</ul>';
                                }
                                ?>


                                <div class="pt-itemlinks itemLinks">
                                    <a class="btn btn-fullcolor " href="<?php the_permalink(); ?>">
                                        <?php _e('SEE MORE', 'zn_framework'); ?>
                                    </a>
                                    <?php
                                    $sp_link = get_post_meta(get_the_ID(), 'zn_sp_link', true);
                                    if (!empty ($sp_link['url'])) {
                                        echo '<a href="' . $sp_link['url'] . '" class="btn btn-lined lined-dark " target="' . $sp_link['target'] . '" >' . __("LIVE PREVIEW", 'zn_framework') . '</a>';
                                    }
                                    ?>
                                </div>
                                <!-- end item links -->
                            </div>
                            <!-- end item content -->
                        </div>
                        <div class="col-sm-6">
                            <div class="ptcarousel ptcarousel--frames-<?php echo $frame_style ?>">

                                <?php
                                $port_media = get_post_meta(get_the_ID(), 'zn_port_media', true);
                                if (count( $port_media ) > 1) {
                                    ?>
                                    <div class="th-controls controls">
                                        <a href="#" class="prev cfs--prev"><span class="glyphicon glyphicon-chevron-left kl-icon-white"></span></a>
                                        <a href="#" class="next cfs--next"><span class="glyphicon glyphicon-chevron-right kl-icon-white"></span></a>
                                    </div>
                                <?php
                                }
                                ?>

                                <ul class="zn_general_carousel cfs--default">
                                    <?php
                                    if ( ! empty ( $port_media ) && is_array( $port_media ) ) {
                                        foreach ( $port_media as $media ) {
                                            $size      = zn_get_size( 'eight' );
                                            $has_image = false;

                                            // Modified portfolio display
                                            // Check to see if we have images
                                            if ( $portfolio_image = $media['port_media_image_comb'] ) {

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
                                            if ( $portfolio_media = $media['port_media_video_comb'] ) {
                                                $portfolio_media = str_replace( '', '&amp;', $portfolio_media );
                                            }

                                            // Display the media
                                            echo '<li class="item kl-has-overlay cfs--item">';

                                                echo '<div class="img-intro">';
                                                if ( ! empty( $saved_image ) && $portfolio_media ) {
                                                    echo '<a href="' . $portfolio_media . '" data-mfp="iframe" data-lightbox="iframe"></a>';
                                                    echo '<img src="' . $image['url'] . '" width="' . $image['width'] . '" height="' .  $image['height'] . '" alt="' . $saved_alt . '" ' . $saved_title . ' />';
                                                    echo '<div class="overlay">';
                                                    echo '<div class="overlay-inner">';
                                                    echo '<span class="glyphicon glyphicon-play"></span>';
                                                    echo '</div>';
                                                    echo '</div>';
                                                }
                                                elseif ( ! empty( $saved_image ) ) {
                                                    if (  zget_option( 'zn_link_portfolio', 'portfolio_options', false, 'no' ) == 'yes' ) {
                                                        echo '<a href="' . get_permalink() . '" data-type="image" data-lightbox="image"></a>';
                                                        echo '<img src="' . $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" alt="' . $saved_alt . '" ' . $saved_title . ' />';
                                                        echo '<div class="overlay">';
                                                        echo '<div class="overlay-inner">';
                                                        echo '<span class="glyphicon glyphicon-picture"></span>';
                                                        echo '</div>';
                                                        echo '</div>';
                                                    }
                                                    else {
                                                        echo '<a href="' . $saved_image . '" data-type="image" data-lightbox="image"></a>';
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
                                                echo '</div>';
                                            echo '</li>';
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                            <!-- end ptcarousel -->
                        </div>
                    </div>
                </div>
			<?php endwhile; ?>
			<?php endif; ?>
	</div>
	<!-- end portfolio layout -->
	<?php
		echo '<div class="clear"></div>';
		echo '<div class="col-sm-12" >';
		    zn_pagination();
		echo '</div>';
	?>

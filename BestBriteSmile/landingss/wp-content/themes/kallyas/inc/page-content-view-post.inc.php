<?php if(! defined('ABSPATH')){ return; }
/**
 * Displays the layout for the post type POST, inside page.php
 * @internal
 * @see page-content-template.inc.php
 */

/* DISPLAY POST CONTENT */

$image = '';
if ( has_post_thumbnail() ) {
    $thumb   = get_post_thumbnail_id();
    $f_image = wp_get_attachment_url( $thumb );
    if ( $f_image ) {
        if( zget_option( 'sb_use_full_image', 'blog_options', false, 'no' ) == 'yes' ){
            $featured_image = wp_get_attachment_image_src($thumb, 'full');
            if(isset($featured_image[0]) && !empty($featured_image[0])) {
                $image = '<a data-lightbox="image" href="' . $featured_image[0] . '" class="hoverBorder pull-left full-width"
                            style="margin-bottom:4px;"><img class="shadow" src="' . $featured_image[0] . '" alt=""/></a>';
            }
        }
        else {
            $feature_image = wp_get_attachment_url( $thumb );
            $image = vt_resize( '', $f_image, 420, 280, true );
            $image = '<a data-lightbox="image" href="' . $feature_image . '" class="hoverBorder pull-left" style="margin-right: 20px;margin-bottom:4px;"><img class="shadow"
                 src="' . $image['url'] . '" alt=""/></a>';
        }
    }
}

?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <h1 class="page-title"><?php the_title(); ?></h1>
    <div class="itemView clearfix eBlog">
        <div class="itemHeader">
            <div class="post_details">
                <span class="itemAuthor">
                    <?php echo __( "by", 'zn_framework' ); ?>
                    <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
                        <?php echo get_the_author_meta( 'display_name' );?>
                    </a>
                </span>
                <span class="infSep"> / </span>
                <span class="itemDateCreated"><span class="glyphicon glyphicon-calendar"></span> <?php the_time( 'l, d F Y' ); ?></span>
                <span class="infSep"> / </span>
                <span class="itemCommentsBlock"></span>
                <span class="itemCategory">
                    <span class="glyphicon glyphicon-folder-close"></span>
                    <?php echo __( 'Published in ', 'zn_framework' ); ?>
                </span>
                <?php the_category( ", " ); ?>
            </div>
        </div>
        <!-- end itemheader -->

        <div class="itemBody">
            <!-- Blog Image -->
            <?php
                if( !post_password_required() ){
                    echo $image;
                }
            ?>

            <!-- Blog Content -->
            <?php the_content(); ?>

        </div>
        <!-- end item body -->
        <div class="clear"></div>

        <?php

        wp_link_pages( array (
            'before' => '<div class="page-link"><span>' . __( 'Pages:', 'zn_framework' ) . '</span>',
            'after'  => '</div>'
        ) );

        $show_social = get_post_meta( get_the_ID(), 'zn_show_social', true );
        if('default' == $show_social){
            $show_social = zget_option('show_social', 'blog_options', false, false);
        }

        if( 'show' == $show_social ){
            ?>
            <!-- Social sharing -->
            <div class="itemSocialSharing clearfix">

                <!-- Twitter Button -->
                <div class="itemTwitterButton">
                    <a href="//twitter.com/share" class="twitter-share-button"
                       data-count="horizontal">Tweet</a>
                    <script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
                </div>

                <!-- Facebook Button -->
                <div class="itemFacebookButton">
                    <div class="fb-like" 
                        data-href="<?php the_permalink(); ?>" 
                        data-send="false"
                         data-layout="button_count" data-width="90"
                         data-show-faces="false"></div>
                </div>

                <!-- Google +1 Button -->
                <div class="itemGooglePlusOneButton">
                    <script type="text/javascript">
                        jQuery(function($){
                            var po = document.createElement('script');
                            po.type = 'text/javascript';
                            po.async = true;
                            po.src = 'https://apis.google.com/js/plusone.js';
                            var s = document.getElementsByTagName('script')[0];
                            s.parentNode.insertBefore(po, s);
                        });
                    </script>
                    <div class="g-plusone" data-size="medium"></div>
                </div>

                <div class="clear"></div>
            </div><!-- end social sharing -->
        <?php
        } // end social

        if ( has_tag() ) {
            ?>
            <!-- TAGS -->
            <div class="itemTagsBlock">
                <span><?php echo __( 'Tagged under:', 'zn_framework' ); ?></span>
                <?php the_tags( '' ); ?>
                <div class="clear"></div>
            </div><!-- end tags blocks -->
        <?php
        }
        ?>

        <div class="clear"></div>

        <?php if( zget_option( 'zn_show_author_info', 'blog_options', false, 'yes' ) == 'yes' ) : ?>
        <div class="post-author">
            <div class="author-avatar">
                <?php echo get_avatar( get_the_author_meta( 'user_email' ), 100 ); ?>
            </div>
            <div class="author-details">
                <h4><?php _e('About', 'zn_framework'); ?> <?php echo get_the_author_meta( 'display_name' );?></h4>
                <?php echo get_the_author_meta( 'description' );?>
            </div>
        </div>
        <div class="clear"></div>
        <?php endif; ?>



        <?php if( zget_option( 'zn_show_related_posts', 'blog_options', false, 'yes' ) == 'yes' ) : ?>
        <?php
        /*
         * DISPLAY 3 RELATED POSTS
         */
            // Start the query
            $args = array(
                'posts_per_page' => 3,
                'category__in' => wp_get_post_categories( get_the_ID(), array('fields' => 'ids')),
                'orderby' => 'rand',
                'order'=> 'ID',
                'post__not_in' => array( get_the_ID() ),
            );
            $theQuery = new WP_Query( $args );
            $usePostFirstImage = (zget_option( 'zn_use_first_image', 'blog_options' , false, 'yes' ) == 'yes');

        if($theQuery->have_posts()) {
        ?>
        <div class="related-articles">
            <h3 class="rta-title"><?php _e( 'What you can read next', 'zn_framework' ); ?></h3>
            <div class="row">
                <?php
                    while($theQuery->have_posts())
                    {
                        $theQuery->the_post();
                        ?>
                        <div class="col-sm-4">
                            <div class="rta-post">
                                <?php
                                    $thumb   = get_post_thumbnail_id( get_the_ID() );
                                    if( !empty( $thumb ) ){
                                        $f_image = wp_get_attachment_url( $thumb );
                                        $image = vt_resize( '', $f_image, 370, 240, true );
                                        if( !empty( $image ) ){
                                            echo '<a href="' . get_permalink() . '">
                                            <img src="'. $image['url'] . '" width="' . $image['width'] . '" height="' .$image['height'] . '" alt=""/></a>';
                                        }
                                    }
                                    elseif ( $usePostFirstImage  && ! post_password_required() ){
                                        $f_image = echo_first_image();
                                        if ( ! empty ( $f_image ) ) {
                                            $image = vt_resize( '', $f_image, 370, 240, true );

                                            if( !empty( $image ) ){
                                                echo '<a href="' . get_permalink() . '">
                                                <img src="'. $image['url'] . '" width="' . $image['width'] . '" height="' .$image['height'] . '" alt=""/></a>';
                                            }

                                        }
                                    }

                                ?>
                                <h5><a href="<?php echo get_permalink(); ?>"><?php the_title();?></a></h5>
                            </div>
                        </div>
                    <?php
                    }
                    wp_reset_postdata();
                ?>
            </div>

        </div>
        <?php } /* End if has posts */?>
        <?php endif; ?>
    </div>
    <!-- End Item Layout -->
</div>

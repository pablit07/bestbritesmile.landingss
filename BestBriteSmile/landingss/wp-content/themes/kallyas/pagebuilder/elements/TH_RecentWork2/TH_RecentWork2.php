<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Recent Work 2
 Description: Create and display a Recent Work 2 element
 Class: TH_RecentWork2
 Category: content
 Level: 3
 Scripts: true
*/
/**
 * Class TH_RecentWork2
 *
 * Create and display a Recent Work 2 element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_RecentWork2 extends ZnElements
{
    public static function getName(){
        return __( "Recent Work 2", 'zn_framework' );
    }

    /**
     * Load dependant resources
     */
    function scripts(){
        wp_enqueue_script( 'caroufredsel', THEME_BASE_URI . '/sliders/caroufredsel/jquery.carouFredSel-packed.js', array ( 'jquery' ), ZN_FW_VERSION, true );
    }

    /**
     * This method is used to display the output of the element.
     *
     * @return void
     */
    function element()
    {
        $options = $this->data['options'];
        $rwheight = (int)$this->opt('rw_height',165);
        ?>

            <div class="recentwork_carousel recentwork_carousel_v2 <?php echo $this->data['uid']; ?> <?php echo $this->opt('css_class',''); ?>">
                <?php
                    // ELEMENT TITLE
                    if ( ! empty ( $options['rw_title'] ) ) {
                        echo '<h3 class="recentwork_carousel__title m_title">' . $options['rw_title'] . '</h3>';
                    }
                ?>
                <div class="controls recentwork_carousel__controls">
                    <a href="#" class="prev recentwork_carousel__prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                    <?php
                        // PORTFOLIO PAGE LINK
                        if ( ! empty ( $options['rw_port_link'] ) ) {
                            echo '<a href="' . $options['rw_port_link'] . '" class="complete"><span class="glyphicon glyphicon-th"></span></a>';
                        }
                    ?>
                    <a href="#" class="next recentwork_carousel__next"><span class="glyphicon glyphicon-chevron-right"></span></a>
                </div>

                <div class="work-carousel recentwork_carousel__crsl-wrapper">
                    <ul class="recent_works2 recentwork_carousel__crsl clearfix">
                        <?php
                        global $post;
                        $posts_per_page = $this->opt('ports_per_page', '6');
                        $categories = $this->opt('portfolio_categories', false);

                        // Start the query
                        $queryArgs = array (
                            'post_type'      => 'portfolio',
                            'post_status'    => 'publish',
                            'posts_per_page' => $posts_per_page,
                        );



                        if( ! empty( $categories ) ){

                            $queryArgs['tax_query'] = array (
                                 array (
                                'taxonomy' => 'project_category',
                                'field'    => 'id',
                                'terms'    => $categories
                                ),
                            );
                        }

                        $theQuery = new WP_Query($queryArgs);

                        // Start the loop
                        if( $theQuery->have_posts() ) {

                            while($theQuery->have_posts()){
                                $theQuery->the_post();

                                echo '<li>';

                                echo '<a href="' . get_permalink() . '" class="recentwork_carousel__link">';

                                $port_media = get_post_meta( $post->ID, 'zn_port_media', true );
                                if ( ! empty ( $port_media ) && is_array( $port_media ) ) {
                                    $size      = zn_get_size( 'four' );
                                    $has_image = false;
                                    if ( $portfolio_image = $port_media[0]['port_media_image_comb'] ) {
                                        if ( is_array( $portfolio_image ) ) {
                                            if ( $saved_image = $portfolio_image['image'] ) {
                                                $has_image = true;
                                            }
                                        }
                                        else {
                                            $saved_image = $portfolio_image;
                                            $has_image   = true;
                                        }

                                        if ( $has_image ) {
                                            $image = vt_resize( '', $saved_image, 450, $rwheight, true );
                                        }
                                    }

                                    // Check to see if we have video
                                    if ( $portfolio_media = $port_media[0]['port_media_video_comb'] ) {
                                    }

                                    // IMAGE
                                    if ( ! empty( $saved_image ) ) {
                                        echo '<div style="height: '.$rwheight.'px; background-image:url(' . $image['url'] . ');" class="recentwork_carousel__img"></div>';
                                    }
                                    elseif ( $portfolio_media ) {
                                        echo get_video_from_link( $portfolio_media, '', '100%', $rwheight );
                                    }
                                }

                                echo '<div class="details recentwork_carousel__details">';
                                    echo '<span class="plus recentwork_carousel__plus">+</span>';

                                    // GET THE POST TITLE
                                    echo '<h4 class="recentwork_carousel__crsl-title">' . get_the_title() . '</h4>';

                                    // GET ALL POST CATEGORIES
                                    echo '<span class="recentwork_carousel__cat">' . strip_tags( get_the_term_list( $post->ID, 'project_category', '', ' , ', '' ) ) . '</span>';
                                echo '</div>';

                                echo '</a>';

                                echo '</li>';
                            }
                            wp_reset_query();
                        }
                        ?>
                    </ul>
                </div>
        </div><!-- end -->

        <?php
    }

    /**
     * This method is used to retrieve the configurable options of the element.
     * @return array The list of options that compose the element and then passed as the argument for the render() function
     */
    function options()
    {
        $uid = $this->data['uid'];

        $options = array(
            'has_tabs'  => true,
            'general' => array(
                'title' => 'General options',
                'options' => array(
                    array (
                        "name"        => __( "Recent Works Items Height", 'zn_framework' ),
                        "description" => __( "Enter a height for the carousel items", 'zn_framework' ),
                        "id"          => "rw_height",
                        "std"         => "165",
                        "type"        => "text",
                        "placeholder" => "ex: 165px"
                    ),
                    array (
                        "name"        => __( "Recent Works Title", 'zn_framework' ),
                        "description" => __( "Enter a title for your Recent Works element", 'zn_framework' ),
                        "id"          => "rw_title",
                        "std"         => "",
                        "type"        => "text",
                    ),
                    array (
                        "name"        => __( "Portfolio page link", 'zn_framework' ),
                        "description" => __( "Please enter the link to your portfolio page.", 'zn_framework' ),
                        "id"          => "rw_port_link",
                        "std"         => "",
                        "type"        => "text",
                    ),
                    array (
                        "name"        => __( "Portfolio Category", 'zn_framework' ),
                        "description" => __( "Select the portfolio category to show items", 'zn_framework' ),
                        "id"          => "portfolio_categories",
                        "multiple"    => true,
                        "std"         => "0",
                        "type"        => "select",
                        "options"     => WpkZn::getPortfolioCategories(),
                    ),
                    array (
                        "name"        => __( "Number of portfolio Items", 'zn_framework' ),
                        "description" => __( "Please enter how many portfolio items you want to load.", 'zn_framework' ),
                        "id"          => "ports_per_page",
                        "std"         => "6",
                        "type"        => "text"
                    ),
                ),
            ),

            'other' => array(
                'title' => 'Other Options',
                'options' => array(

                    array(
                        'id'          => 'css_class',
                        'name'        => 'CSS class',
                        'description' => 'Enter a css class that will be applied to this element. You can than edit the custom css, either in the Page builder\'s CUSTOM CSS (which is loaded only into that particular page), or in Kallyas options > Advanced > Custom CSS which will load the css into the entire website.',
                        'type'        => 'text',
                        'std'         => '',
                    ),

                ),
            ),
            'help' => array(
                'title' => '<span class="dashicons dashicons-editor-help"></span> HELP',
                'options' => array(

                    array (
                        "name"        => __( 'Video Tutorial', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#g4kQDgLIZ38" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/recent-work/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
                        "id"          => "docs_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => sprintf(__( '<span data-clipboard-text="%s" data-tooltip="Click to copy ID to clipboard">Unique ID: %s</span> ', 'zn_framework' ), $uid, $uid),
                        "description" => __( 'In case you need some custom styling use as a css class selector <span class="u-code" data-clipboard-text=".'.$uid.' {  }" data-tooltip="Click to copy CSS class to clipboard">.'.$uid.'</span> .', 'zn_framework' ),
                        "id"          => "id_element",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( '<a href="http://support.hogash.com/support/forum/wordpress-themes/kallyas-wordpress-theme/" target="_blank">Support Forums</a> &nbsp; | &nbsp; <a href="http://support.hogash.com/kallyas-help/" target="_blank">Kallyas Video Tutorials & Documentation</a> &nbsp; | &nbsp; <a href="http://themeforest.net/downloads?sort_by=Recent+Updates&filter_by=themeforest.net#item-4091658" target="_blank" class="stars-yellow">Rate Kallyas <span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></a>', 'zn_framework' ),
                        "id"          => "otherlinks",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn-custom-title-sm zn_nomargin"
                    ),
                ),
            ),
        );
        return $options;
    }
}

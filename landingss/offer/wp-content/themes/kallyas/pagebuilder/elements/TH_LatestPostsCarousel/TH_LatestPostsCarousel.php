<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Latest Posts Carousel
 Description: Display latest post from specific categories in a carousel layout.
 Class: TH_LatestPostsCarousel
 Category: content
 Level: 3
 Scripts: true
*/

/**
 * Class TH_LatestPostsCarousel
 *
 * Create and display a Latest Posts Carousel element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_LatestPostsCarousel extends ZnElements
{
    public static function getName(){
        return __( "Latest Posts Carousel", 'zn_framework' );
    }

    /**
     * Load dependant resources
     */
    function scripts(){
        wp_enqueue_script( 'caroufredsel', THEME_BASE_URI . '/sliders/caroufredsel/jquery.carouFredSel-packed.js', array ( 'jquery' ), ZN_FW_VERSION, true );
    }

    /**
     * This method is used to display the output of the element.
     * @return void
     */
    function element()
    {
        $options = $this->data['options'];

        $numPosts   = isset( $options['lpc_num_posts'] ) ? $options['lpc_num_posts'] : 10; // how many posts
        $categories = isset( $options['lpc_categories'] ) ? $options['lpc_categories'] : get_option('default_category');
        $title = isset( $options['lpc_title'] ) ? $options['lpc_title'] : __('Latest Posts', 'zn_framework');

        // Start the query
        $queryArgs = array(
            'post_type'      => 'post',
            'posts_per_page' => $numPosts,
            'category__in' => $categories
        );
        $theQuery = new WP_Query($queryArgs);

        if ( $theQuery->have_posts() )
        {
            ?>

                <div class="latest-posts-carousel <?php echo $this->data['uid']; ?> <?php echo $this->opt('css_class',''); ?>">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="m_title"><?php echo $title;?></h3>
                            <div class="th-controls controls">
                                <a href="#" class="prev" style="display: inline;"><span class="glyphicon glyphicon-chevron-left"></span></a>
                                <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) );?>" class="complete"><span class="glyphicon glyphicon-th"></span></a>
                                <a href="#" class="next" style="display: inline;"><span class="glyphicon glyphicon-chevron-right"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="posts-carousel">
                                <ul class="lp_carousel clearfix">
                                    <?php
                                        // Start the loop
                                        while ( $theQuery->have_posts() ) {
                                            $theQuery->the_post();
                                            // post categories
                                            $categories = get_the_category();
                                            $separator = ', ';
                                            $catList = '';
                                            if($categories){
                                                foreach($categories as $category) {
                                                    $catList .= '<a href="'.get_category_link( $category->term_id ).'" title="' .
                                                                esc_attr( sprintf( __( "View all posts in %s", 'zn_framework'),
                                                                    $category->name ) ) . '">'.
                                                                $category->cat_name.'</a>'.$separator;
                                                }
                                                $catList = trim($catList, $separator);
                                            }
                                            $permalink = get_the_permalink();
                                            $featuredImage = get_the_post_thumbnail(get_the_ID(), 'full');
                                            ?>
                                            <li class="post">
                                                <div class="hoverBorder plus">
                                                    <span class="hoverBorderWrapper"><?php echo $featuredImage;?><span class="theHoverBorder"></span></span>
                                                    <h6><a href="<?php echo $permalink;?>"><?php _e('Read more +', 'zn_framework');?></a></h6>
                                                </div>
                                                <em><?php the_date();?> <?php _e('By', 'zn_framework');?> <?php the_author();?> <?php _e('in', 'zn_framework');?> <?php echo $catList;?></em>
                                                <h3 class="m_title"><a href="<?php echo $permalink;?>"><?php the_title();?></a></h3>
                                            </li>
                                        <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            <?php
            wp_reset_postdata();
        }
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
                        "name"        => __( "Title", 'zn_framework' ),
                        "description" => __( "Enter a title for the latest posts carousel", 'zn_framework' ),
                        "id"          => "lpc_title",
                        "std"         => "",
                        "type"        => "text",
                    ),
                    array (
                        "name"        => __( "Posts Category", 'zn_framework' ),
                        "description" => __( "Select the category to show items", 'zn_framework' ),
                        "id"          => "lpc_categories",
                        "multiple"    => true,
                        "std"         => 0,
                        "type"        => "select",
                        "options"     => WpkZn::getBlogCategories(),
                    ),
                    array (
                        "name"        => __( "Number of items", 'zn_framework' ),
                        "description" => __( "Please enter how many items you want to load.", 'zn_framework' ),
                        "id"          => "lpc_num_posts",
                        "std"         => 10,
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#gFcL4BXQpAs" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/latest-posts-carousel/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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

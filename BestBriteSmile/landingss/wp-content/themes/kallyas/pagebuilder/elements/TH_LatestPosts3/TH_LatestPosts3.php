<?php if(! defined('ABSPATH')){ return; }
/*
Name: Latest Posts 3
Description: Create and display a Latest Posts 3 element
Class: TH_LatestPosts3
Category: content
Level: 3
*/
/**
 * Class TH_LatestPosts3
 *
 * Create and display a Latest Posts 3 element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    3.8.0
 */
class TH_LatestPosts3 extends ZnElements
{
    public static function getName(){
        return __( "Latest Posts 3", 'zn_framework' );
    }

    /**
     * This method is used to display the output of the element.
     * @return void
     */
    function element()
    {
        $options = $this->data['options'];
        ?>

            <div class=" latest_posts style2 <?php echo $this->data['uid']; ?> <?php echo $this->opt('css_class',''); ?>">
                <h3 class="m_title"><?php echo (isset($options['lp_title']) ? strip_tags($options['lp_title']) : '');?></h3>
                <?php
                if ( ! empty( $options['lp_blog_page'] ) ) {
                    echo '<a href="' . $options['lp_blog_page'] . '" class="viewall">' . __( "VIEW ALL", 'zn_framework' ) . ' -</a>';
                }
                ?>
                <ul class="posts">
                    <?php
                    // Check what categories were selected..if any
                    $blog_category = '';
                    if ( isset ( $options['lp_blog_categories'] ) ) {
                        $blog_category = implode( ',', $options['lp_blog_categories'] );
                    }

                    // HOW MANY POSTS
                    $num_posts = '2';
                    if ( isset ( $options['lp_num_posts'] ) ) {
                        $num_posts = $options['lp_num_posts'];
                    }

                    // Start the query
                    query_posts( array ( 'posts_per_page' => $num_posts, 'cat' => $blog_category ) );

                    // GET THE NUMBER OF TOTAL POSTS RETURNED
                    global $wp_query;

                    // Start the loop
                    while ( have_posts() ) {
                        the_post();

                        echo '<li class="post">';

                        echo '<div class="details">';
                        echo '<span class="date">'.get_the_time( 'd/m/Y' ). '</span>';
                        echo '<span class="cat">' . __( 'in ', 'zn_framework' );
                        the_category( ", " );
                        echo '</span>';
                        echo '</div>';

                        // TITLE
                        echo '<h4 class="title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4>';

                        // TEXT
                        echo '<div class="text">';
                        $excerpt = get_the_excerpt();
                        $excerpt = strip_shortcodes( $excerpt );
                        $excerpt = strip_tags( $excerpt );
                        $the_str = mb_substr( $excerpt, 0, 350 );
                        echo $the_str . '...';

                        echo '</div>';
                        echo '</li>';
                    }
                    wp_reset_query();
                    ?>
                </ul>
            </div>
            <!-- end // latest posts style 2 -->
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
                        "name"        => __( "Title", 'zn_framework' ),
                        "description" => __( "Enter a title for your Latest Posts element", 'zn_framework' ),
                        "id"          => "lp_title",
                        "std"         => "",
                        "type"        => "text",
                    ),
                    array (
                        "name"        => __( "Blog page Link", 'zn_framework' ),
                        "description" => __( "Enter the link to your blog page", 'zn_framework' ),
                        "id"          => "lp_blog_page",
                        "std"         => "",
                        "type"        => "text",
                    ),
                    array (
                        "name"        => __( "Number of posts", 'zn_framework' ),
                        "description" => __( "Enter the number of posts that you want to show", 'zn_framework' ),
                        "id"          => "lp_num_posts",
                        "std"         => "2",
                        "type"        => "text",
                    ),
                    array (
                        "name"        => __( "Blog Category", 'zn_framework' ),
                        "description" => __( "Select the blog category to show items", 'zn_framework' ),
                        "id"          => "lp_blog_categories",
                        "multiple"    => true,
                        "std"         => "0",
                        "type"        => "select",
                        "options"     => WpkZn::getBlogCategories()
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
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/latest-posts/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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


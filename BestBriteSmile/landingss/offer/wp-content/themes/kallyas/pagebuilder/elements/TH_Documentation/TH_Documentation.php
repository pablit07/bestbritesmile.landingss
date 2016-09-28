<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Documentation
 Description: Create and display a Documentation element
 Class: TH_Documentation
 Category: content
 Level: 3
*/
/**
 * Class TH_Documentation
 *
 * Create and display a Documentation element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_Documentation extends ZnElements
{
    public static function getName(){
        return __( "Documentation", 'zn_framework' );
    }

    /**
     * This method is used to display the output of the element.
     * @return void
     */
    function element()
    {
        $options = $this->data['options'];

        $categories = get_terms( 'documentation_category', array (
            'orderby'     => 'name',
            'order'       => 'ASC',
            'hide_empty'  => 0,
            'show_count ' => 1
        ) );
        $limit = '6';
        if ( ! empty( $options['doc_num_items'] ) ) {
            $limit = $options['doc_num_items'];
        }

        $count = count( $categories );
        $i     = 1;

        foreach ( $categories as $category )
        {
            if ( $i % 2 == 1 ) {
                echo '<div class="row zn_photo_gallery '.$this->data['uid'].' '.$this->opt('css_class','').'">';
            }

            echo '<div class="col-sm-6">';
            echo '<h3><a href="' . get_term_link( $category->slug, 'documentation_category' ) . '">' . $category->name . ' (' . $category->count . ')</a></h3>';

            $args = array (
                'post_type'              => 'documentation',
                'post_status'            => 'publish',
                'posts_per_page'         => $limit,
                'documentation_category' => $category->slug
            );

            $zn_doc = new WP_Query( $args );

            echo '<ol>';

            while ( $zn_doc->have_posts() ): $zn_doc->the_post();

                global $post;

                echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';

            endwhile; // end loop

            wp_reset_postdata();

            echo "</ol>";

            echo '</div>';

            if ( $i % 2 == 0 || $i == $count ) {
                echo '</div>';
            }

            $i ++;
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
                        "name"        => __( "Number of items", 'zn_framework' ),
                        "description" => __( "Please enter the desired number of items that you want to be shown under each category.", 'zn_framework' ),
                        "id"          => "doc_num_items",
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#Yl7l2SVgyRU" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/documentation-header/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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

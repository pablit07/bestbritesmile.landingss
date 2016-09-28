<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Flickr Feed
 Description: Create and display a Flickr Feed element
 Class: TH_FlickrFeed
 Category: content
 Level: 3
 Scripts: true
*/
/**
 * Class TH_FlickrFeed
 *
 * Create and display a Flickr Feed element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    3.8.0
 */
class TH_FlickrFeed extends ZnElements
{
    public static function getName(){
        return __( "Flickr Feed", 'zn_framework' );
    }

    /**
     * Load dependant resources
     */
    function scripts(){
        wp_enqueue_script( 'flickr_feed', THEME_BASE_URI . '/addons/flickrfeed/jquery.jflickrfeed.min.js', array ( 'jquery' ), ZN_FW_VERSION, true );
    }
    /**
     * This method is used to display the output of the element.
     * @return void
     */
    function element()
    {
        $options = $this->data['options'];

        if( empty( $options['ff_id'] ) || empty( $options['ff_image_size'] ) ){
            return;
        }

        // default number of images to display
        $numImages = 6;
        if ( ! empty ( $options['ff_images'] ) ) {
            $numImages = absint($options['ff_images']);
            if(empty($numImages)){
                $numImages = 6;
            }
        }

        $image_size = '';
        if ( $options['ff_image_size'] == 'small' ) {
            $image_size = 'data-size="small"';
        }


        echo '<div class="flickrfeed '.$this->data['uid'].' '.$this->opt('css_class','').'">';
        echo '<h3 class="m_title">' . $options['ff_title'] . '</h3>';
        echo '<ul class="flickr_feeds fixclear " data-limit="' . $numImages . '" data-fid="'.$options['ff_id'].'" ' . $image_size . '></ul>';
        echo '</div><!-- end // flickrfeed -->';

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
                        "description" => __( "Please enter a title for this element", 'zn_framework' ),
                        "id"          => "ff_title",
                        "std"         => "",
                        "type"        => "text",
                    ),
                    array (
                        "name"        => __( "Flickr ID", 'zn_framework' ),
                        "description" => __( "Please enter your Flickr ID", 'zn_framework' ),
                        "id"          => "ff_id",
                        "std"         => "",
                        "type"        => "text",
                    ),
                    array (
                        "name"        => __( "Image Size", 'zn_framework' ),
                        "description" => __( "Select the desired image size for the Flickr images", 'zn_framework' ),
                        "id"          => "ff_image_size",
                        "type"        => "select",
                        "std"         => "small",
                        "options"     => array (
                            'normal' => __( 'Normal', 'zn_framework' ),
                            'small'  => __( 'Small', 'zn_framework' )
                        ),
                    ),
                    array (
                        "name"        => __( "Images to load", 'zn_framework' ),
                        "description" => __( "Please enter the number of images that you want to display", 'zn_framework' ),
                        "id"          => "ff_images",
                        "std"         => "6",
                        "type"        => "text",
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#HsX1KxNxKNM" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/flickr-feed/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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

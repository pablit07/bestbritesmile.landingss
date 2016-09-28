<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Video Box
 Description: Create and display a Video Box element
 Class: TH_VideoBox
 Category: content, media
 Level: 3
*/
/**
 * Class TH_VideoBox
 *
 * Create and display a Video Box element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_VideoBox extends ZnElements
{
    public static function getName(){
        return __( "Video Box", 'zn_framework' );
    }

    /**
     * This method is used to display the output of the element.
     * @return void
     */
    function element()
    {
        $options = $this->data['options'];

        ?>

            <?php
            if ( ! empty ( $options['vb_video_image'] ) && ! empty ( $options['vb_video_url'] ) ) {
                echo '<div class="adbox video '.$this->data['uid'].' '.$this->opt('css_class','').'">';
                    $image = vt_resize( '', $options['vb_video_image'], '', '', true );
                    echo '<img src="' . $image['url'] . '" alt="">';
                    echo '<div class="video_trigger_wrapper">';
                        echo '<div class="adbox_container">';
                            echo '<a class="playVideo" data-lightbox="iframe" href="' . $options['vb_video_url'] . '"></a>';
                            if( isset($options['vb_video_title']) && !empty($options['vb_video_title'])  ){
                                echo '<h5>' . $options['vb_video_title'] . '</h5>';
                            }
                        echo '</div>';
                    echo '</div>'; // close video_trigger_container
                echo '</div>'; // close adbox
            }
            else {
                if ( ! empty ( $options['vb_video_url'] ) ) {
                    if ( ! empty( $options['vb_video_title'] ) ) {
                        echo '<h4 class="m_title">' . $options['vb_video_title'] . '</h4>';
                    }
                    echo get_video_from_link( $options['vb_video_url'], '', '', '' );
                }
            }
            ?>
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
                        "name"        => __( "Video URL", 'zn_framework' ),
                        "description" => __( "Please enter a link to your desired video ( Youtube and Vimeo ).", 'zn_framework' ),
                        "id"          => "vb_video_url",
                        "std"         => "",
                        "type"        => "text"
                    ),
                    array (
                        "name"        => __( "Image", 'zn_framework' ),
                        "description" => __( "Please select an image that you want to display.If
                                             no image is selected, the video will be shown directly.", 'zn_framework' ),
                        "id"          => "vb_video_image",
                        "std"         => "",
                        "type"        => "media"
                    ),
                    array (
                        "name"        => __( "Video title", 'zn_framework' ),
                        "description" => __( "Please enter a title that will appear over the
                                            play icon. This will only be shown if you select an image.", 'zn_framework' ),
                        "id"          => "vb_video_title",
                        "std"         => "",
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#flIrJ1rcYlo" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/video-box/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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

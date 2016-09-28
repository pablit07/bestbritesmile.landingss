<?php if(! defined('ABSPATH')){ return; }
/*
Name: STATIC CONTENT - Simple Text ( full width )
Description: Create and display a STATIC CONTENT - Simple Text ( full width ) element
Class: TH_StaticContentSimpleTextFullWidth
Category: headers, Fullwidth
Level: 1
*/
/**
 * Class TH_StaticContentSimpleTextFullWidth
 *
 * Create and display a STATIC CONTENT - Simple Text ( full width ) element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_StaticContentSimpleTextFullWidth extends ZnElements
{
    public static function getName(){
        return __( "STATIC CONTENT - Simple Text ( full width )", 'zn_framework' );
    }

    /**
     * Load dependant resources
     */
    function scripts(){
        wp_enqueue_style( 'static_content', THEME_BASE_URI . '/sliders/static_content/sc_styles.css', '', ZN_FW_VERSION );
    }

    /**
     * This method is used to display the output of the element.
     * @return void
     */
    function element()
    {
        $uid = $this->data['uid'];
        $options = $this->data['options'];
        if( empty( $options ) ) { return; }
        ?>
            <div class="kl-slideshow static-content__slideshow nobg <?php echo $uid; ?> <?php echo $this->opt('css_class',''); ?>">

                <?php
                    $sc_sc = $this->opt('sc_sc','');
                    if( !empty ($sc_sc) ){
                        echo do_shortcode( $sc_sc );
                    }
                ?>

            </div><!-- end kl-slideshow -->
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
                        "name"        => __( "Text", 'zn_framework' ),
                        "description" => __( "Please enter the shortcode.", 'zn_framework' ),
                        "id"          => "sc_sc",
                        "std"         => "",
                        "type"        => "textarea"
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
            // 'help' => array(
            //     'title' => '<span class="dashicons dashicons-editor-help"></span> HELP',
            //     'options' => array(

            //         array (
            //             "name"        => __( 'Video Tutorial', 'zn_framework' ),
            //             "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
            //             "id"          => "video_link",
            //             "std"         => "",
            //             "type"        => "zn_title",
            //             "class"       => "zn_full zn_nomargin"
            //         ),

            //         array (
            //             "name"        => __( 'Written Documentation', 'zn_framework' ),
            //             "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
            //             "id"          => "docs_link",
            //             "std"         => "",
            //             "type"        => "zn_title",
            //             "class"       => "zn_full zn_nomargin"
            //         ),

            //         array (
            //             "name"        => sprintf(__( '<span data-clipboard-text="%s" data-tooltip="Click to copy ID to clipboard">Unique ID: %s</span> ', 'zn_framework' ), $uid, $uid),
            //             "description" => __( 'In case you need some custom styling use as a css class selector <span class="u-code" data-clipboard-text=".'.$uid.' {  }" data-tooltip="Click to copy CSS class to clipboard">.'.$uid.'</span> .', 'zn_framework' ),
            //             "id"          => "id_element",
            //             "std"         => "",
            //             "type"        => "zn_title",
            //             "class"       => "zn_full zn_nomargin"
            //         ),

            //         array (
            //             "name"        => __( '<a href="http://support.hogash.com/support/forum/wordpress-themes/kallyas-wordpress-theme/" target="_blank">Support Forums</a> &nbsp; | &nbsp; <a href="http://support.hogash.com/kallyas-help/" target="_blank">Kallyas Video Tutorials & Documentation</a> &nbsp; | &nbsp; <a href="http://themeforest.net/downloads?sort_by=Recent+Updates&filter_by=themeforest.net#item-4091658" target="_blank" class="stars-yellow">Rate Kallyas <span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></a>', 'zn_framework' ),
            //             "id"          => "otherlinks",
            //             "std"         => "",
            //             "type"        => "zn_title",
            //             "class"       => "zn_full zn-custom-title-sm zn_nomargin"
            //         ),
            //     ),
            // ),
        );
        return $options;
    }
}

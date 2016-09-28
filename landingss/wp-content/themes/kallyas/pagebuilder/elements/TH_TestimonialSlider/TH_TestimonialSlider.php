<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Testimonial Slider
 Description: Create and display a Testimonial Slider element
 Class: TH_TestimonialSlider
 Category: content
 Level: 3
 Scripts: true
*/

/**
 * Class TH_TestimonialSlider
 *
 * Create and display a Testimonial Slider element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_TestimonialSlider extends ZnElements
{
    public static function getName(){
        return __( "Testimonial Slider", 'zn_framework' );
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


        echo '<div class="testimonials-carousel '.$this->data['uid'].' '.$this->opt('css_class','').'">';

        if ( ! empty ( $options['tf_title'] ) ) {
            echo '<h3 class="m_title">' . $options['tf_title'] . '</h3>';
        }

        echo '<div class="th-controls controls">';
        echo '<a href="#" class="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>';
        echo '<a href="#" class="next"><span class="glyphicon glyphicon-chevron-right"></span></a>';
        echo '</div>';

        if ( ! empty ( $options['testimonials_slider_single'] ) && is_array( $options['testimonials_slider_single'] ) ) {

            // Speed
            $speed = 5000;
            if ( ! empty( $options['tf_speed'] ) ) {
                $speed = intval($options['tf_speed']);
            }

            echo '<ul class="zn_testimonials_carousel fixclear" data-speed="'.$speed.'">';

            foreach ( $options['testimonials_slider_single'] as $test ) {
                if ( ! empty ( $test['tf_single_test'] ) ) {
                    echo '<li>';

                    echo '<blockquote>' . do_shortcode( $test['tf_single_test'] ) . '</blockquote>';
                    echo '<div class="testimonial-author">';

                    if ( isset($test['ts_author_photo']) && !empty($test['ts_author_photo'])) {
                        echo '<div class="testimonial-author--photo">';
                        $image = vt_resize( '', $test['ts_author_photo'], '40', '40', true );
                        echo '<img src="' . $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" alt="">';
                        echo '</div>';
                    }


                    echo '<h5>' . $test['tf_single_author'] . '</h5>';
                    echo '</div>';

                    echo '</li>';
                }
            }
            echo '</ul>';
        }

        echo '</div>';

    }

    /**
     * This method is used to retrieve the configurable options of the element.
     * @return array The list of options that compose the element and then passed as the argument for the render() function
     */
    function options()
    {
        $extra_options = array (
            "name"           => __( "Testimonials", 'zn_framework' ),
            "description"    => __( "Here you can add your testimonials.", 'zn_framework' ),
            "id"             => "testimonials_slider_single",
            "std"            => "",
            "type"           => "group",
            "add_text"       => __( "Testimonial", 'zn_framework' ),
            "remove_text"    => __( "Testimonial", 'zn_framework' ),
            "group_sortable" => true,
            "element_title" => "tf_single_test",
            "subelements"    => array (
                array (
                    "name"        => __( "Testimonial", 'zn_framework' ),
                    "description" => __( "Please enter the desired testimonial.", 'zn_framework' ),
                    "id"          => "tf_single_test",
                    "std"         => "",
                    "type"        => "textarea"
                ),
                array (
                    "name"        => __( "Author Photo", 'zn_framework' ),
                    "description" => __( "Please select a photo for this author.", 'zn_framework' ),
                    "id"          => "ts_author_photo",
                    "std"         => "",
                    "type"        => "media",
                ),
                array (
                    "name"        => __( "Testimonial author", 'zn_framework' ),
                    "description" => __( "Please enter the desired author for this
                                            testimonial.", 'zn_framework' ),
                    "id"          => "tf_single_author",
                    "std"         => "",
                    "type"        => "text"
                )
            )
        );

        $uid = $this->data['uid'];

        $options = array(
            'has_tabs'  => true,
            'general' => array(
                'title' => 'General options',
                'options' => array(
                    array (
                        "name"        => __( "Title", 'zn_framework' ),
                        "description" => __( "Please enter the Testimonials Fader title", 'zn_framework' ),
                        "id"          => "tf_title",
                        "std"         => "",
                        "type"        => "text",
                    ),
                    array (
                        "name"        => __( "Transition Speed", 'zn_framework' ),
                        "description" => __( "Please enter a numeric value for the transition speed. Default is 2500", 'zn_framework' ),
                        "id"          => "tf_speed",
                        "std"         => "2500",
                        "type"        => "text",
                    ),
                    $extra_options,
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#oDsttutS1c8" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/testimonial-slider/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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

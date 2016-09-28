<?php if(! defined('ABSPATH')){ return; }
/*
Name: STATIC CONTENT - Text and Video
Description: Create and display a STATIC CONTENT - Text and Video element
Class: TH_StaticContentTextAndVideo
Category: headers, Fullwidth
Level: 1
*/
/**
 * Class TH_StaticContentTextAndVideo
 *
 * Create and display a STATIC CONTENT - Text and Video element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_StaticContentTextAndVideo extends ZnElements
{
    public static function getName(){
        return __( "STATIC CONTENT - Text and Video", 'zn_framework' );
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
        $options = $this->data['options'];

        if( empty( $options ) ) { return; }

        $style = '';
        if ( isset ( $options['ww_header_style'] ) && ! empty ( $options['ww_header_style'] ) ) {
            $style = 'uh_' . $options['ww_header_style'];
        }

        $bottom_mask = $this->opt('hm_header_bmasks','none');
        $bm_class = $bottom_mask != 'none' ? 'maskcontainer--'.$bottom_mask : '';
        ?>
        <div class="kl-slideshow <?php echo $style; ?> <?php echo $bm_class ?> <?php echo $this->data['uid']; ?> <?php echo $this->opt('css_class',''); ?>">

            <div class="bgback"></div>
            <div class="th-sparkles"></div>

            <div class="container kl-slideshow-inner kl-slideshow-safepadding">
                <div class="static-content default-style with-login">
                    <div class="row">
                        <div class="col-sm-7">
                            <?php
                            if ( ! empty( $options['ww_slide_title'] ) ) {
                                echo '<h2 class="static-content__title text-left">' . do_shortcode( $options['ww_slide_title'] ) . '</h2>';
                            }

                            if ( ! empty( $options['ww_slide_subtitle'] ) ) {
                                echo '<h3 class="static-content__subtitle text-left">' . do_shortcode( $options['ww_slide_subtitle'] ) . '</h3>';
                            }

                            if (
                                ( isset($options['ww_slide_m_button']) && !empty($options['ww_slide_m_button']) )
                                || ( isset($options['ww_slide_l_text']) && !empty($options['ww_slide_l_text']) )
                            ) {
                                echo '<div class="static-content__infopop animated fadeBoxIn sc-infopop--left" data-arrow="top">';

                                if ( isset ( $options['ww_slide_link']['url'] ) && ! empty ( $options['ww_slide_link']['url'] ) ) {
                                    echo '<a class="sc-infopop__btn" href="' . $options['ww_slide_link']['url'] . '" target="' . $options['ww_slide_link']['target'] . '">' . $options['ww_slide_l_text'] . '</a>';
                                }
                                // BUTTON LEFT TEXT
                                if ( isset ( $options['ww_slide_m_button'] ) && ! empty ( $options['ww_slide_m_button'] ) ) {
                                    echo '<h5 class="sc-infopop__text">' . $options['ww_slide_m_button'] . '</h5>';
                                }
                                echo '<div class="clear"></div>';
                                echo '</div>';
                            }
                            ?>
                        </div>
                        <div class="col-sm-5">
                            <?php
                            // Text
                            if ( isset ( $options['sc_ec_vid_desc'] ) && ! empty ( $options['sc_ec_vid_desc'] ) ) {
                                echo '<h5 style="text-align:right;">' . $options['sc_ec_vid_desc'] . '</h5>';
                            }
                            // VIDEO
                            if ( isset ( $options['sc_ec_vime'] ) && ! empty ( $options['sc_ec_vime'] ) ) {
                                echo get_video_from_link( $options['sc_ec_vime'], 'black_border full_width', '520px', '270px' );
                            }
                            ?>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
                <!-- end static content -->
            </div>
            <?php
                WpkPageHelper::zn_bottommask_markup($bottom_mask);
            ?>
            <!-- header bottom style -->
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
                    array(
                        "name"        => __( '<strong style="font-size:120%">Warning!</strong>', 'zn_framework' ),
                        "description" => __( 'Since v4.x, <strong>this element is <em>deprecated</em> & <em>unsuported</em></strong>. It\'s not recommended to be used bucause at some point it\'ll be removed (now it\'s kept only for backwards compatibilty).<br> Instead, try to use a combination of these elements: Section (to add background), 2 Columns (6 + 6), Title element/TextBox (onto the left column), Media Container (into the right column)', 'zn_framework' ),
                        'type'  => 'zn_message',
                        'id'    => 'zn_error_notice',
                        'show_blank'  => 'true',
                        'supports'  => 'warning'
                    ),
                    array (
                        "name"        => __( "Background Style", 'zn_framework' ),
                        "description" => __( "Select the background style you want to use. Please note that styles can be created
                                    from the unlimited headers options in the theme admin's page.", 'zn_framework' ),
                        "id"          => "ww_header_style",
                        "std"         => "",
                        "type"        => "select",
                        "options"     => WpkZn::getThemeHeaders(true),
                        "class"       => ""
                    ),
                    array (
                        "name"        => __( "Main title", 'zn_framework' ),
                        "description" => __( "Please enter a main title.", 'zn_framework' ),
                        "id"          => "ww_slide_title",
                        "std"         => "",
                        "type"        => "textarea"
                    ),
                    array (
                        "name"        => __( "Subtitle", 'zn_framework' ),
                        "description" => __( "Please enter a subtitle", 'zn_framework' ),
                        "id"          => "ww_slide_subtitle",
                        "std"         => "",
                        "type"        => "textarea"
                    ),
                    array (
                        "name"        => __( "Button Main Text", 'zn_framework' ),
                        "description" => __( "Please enter a main text for this button", 'zn_framework' ),
                        "id"          => "ww_slide_m_button",
                        "std"         => "",
                        "type"        => "text"
                    ),
                    array (
                        "name"        => __( "Button Link Text", 'zn_framework' ),
                        "description" => __( "Please enter a text that will appear on the right side of the button", 'zn_framework' ),
                        "id"          => "ww_slide_l_text",
                        "std"         => "",
                        "type"        => "text"
                    ),
                    array (
                        "name"        => __( "Button link", 'zn_framework' ),
                        "description" => __( "Please enter a link that will appear on the right side of the button", 'zn_framework' ),
                        "id"          => "ww_slide_link",
                        "std"         => "",
                        "type"        => "link",
                        "options"     => array (
                            '_self'  => __( "Same window", 'zn_framework' ),
                            '_blank' => __( "New window", 'zn_framework' )
                        )
                    ),
                    array (
                        "name"        => __( "Video", 'zn_framework' ),
                        "description" => __( "Please enter the link for your desired video ( youtube or vimeo ).", 'zn_framework' ),
                        "id"          => "sc_ec_vime",
                        "std"         => "",
                        "type"        => "text"
                    ),
                    array (
                        "name"        => __( "Video Description", 'zn_framework' ),
                        "description" => __( "Please enter a description for this video that will appear above the video.", 'zn_framework' ),
                        "id"          => "sc_ec_vid_desc",
                        "std"         => "",
                        "type"        => "textarea"
                    ),

                    // Bottom masks overrides
                    array (
                        "name"        => __( "Bottom masks override", 'zn_framework' ),
                        "description" => __( "The new masks are svg based, vectorial and color adapted.", 'zn_framework' ),
                        "id"          => "hm_header_bmasks",
                        "std"         => "none",
                        "type"        => "select",
                        "options"     => array (
                            'none' => __( 'None, just rely on Background style.', 'zn_framework' ),
                            'shadow' => __( 'Shadow Up', 'zn_framework' ),
                            'shadow_ud' => __( 'Shadow Up and down', 'zn_framework' ),
                            'mask1' => __( 'Raster Mask 1 (Old, not recommended)', 'zn_framework' ),
                            'mask2' => __( 'Raster Mask 2 (Old, not recommended)', 'zn_framework' ),
                            'mask3' => __( 'Vector Mask 3 CENTER (New! From v4.0)', 'zn_framework' ),
                            'mask3 mask3l' => __( 'Vector Mask 3 LEFT (New! From v4.0)', 'zn_framework' ),
                            'mask3 mask3r' => __( 'Vector Mask 3 RIGHT (New! From v4.0)', 'zn_framework' ),
                            'mask4' => __( 'Vector Mask 4 CENTER (New! From v4.0)', 'zn_framework' ),
                            'mask4 mask4l' => __( 'Vector Mask 4 LEFT (New! From v4.0)', 'zn_framework' ),
                            'mask4 mask4r' => __( 'Vector Mask 4 RIGHT (New! From v4.0)', 'zn_framework' ),
                            'mask5' => __( 'Vector Mask 5 (New! From v4.0)', 'zn_framework' ),
                            'mask6' => __( 'Vector Mask 6 (New! From v4.0)', 'zn_framework' ),
                        ),
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#RDW958-3Rws" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/static-content-text-and-video/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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

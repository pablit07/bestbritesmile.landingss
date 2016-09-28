<?php if(! defined('ABSPATH')){ return; }
/*
Name: Wow Slider
Description: Create and display a Wow Slider element
Class: TH_WowSlider
Category: headers, Fullwidth
Level: 1
Scripts: true
*/

/**
 * Class TH_WowSlider
 *
 * Create and display a Wow Slider element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_WowSlider extends ZnElements
{
    private $effect = '';

    public static function getName(){
        return __( "Wow Slider", 'zn_framework' );
    }

    /**
     * Load dependent resources
     */
    function scripts(){
        wp_enqueue_style( 'wow_slider',  THEME_BASE_URI . '/sliders/wow_slider/css/style.css', array('kallyas-styles'),ZN_FW_VERSION);
        wp_enqueue_script( 'wow_slider', THEME_BASE_URI . '/sliders/wow_slider/js/wowslider.js', array ( 'jquery' ), ZN_FW_VERSION, true );
    }

    /**
     * Load dependant resources
     */
    function loadScriptsConditionally(){

    }

    /**
     * This method is used to display the output of the element.
     * @return void
     */
    function element()
    {
        $options = $this->data['options'];

        if( empty( $options['single_wow'] ) ){
            return;
        }

        $style = '';
        if ( isset ( $options['ww_header_style'] ) && ! empty ( $options['ww_header_style'] ) ) {
            $style = 'uh_' . $options['ww_header_style'];
        }

        // Shadow style
        $ww_shadow = '';
        if( isset($options['ww_shadow']) && $options['ww_shadow'] != '' ) {
            $ww_shadow = 'zn-shadow-lifted';
        }

        $captstyle = '';
        if( isset($options['ww_caption_style']) && $options['ww_caption_style'] != '' ) {
            $captstyle = 'ws-alternative-title';
        }

        $sl_height = $this->opt('ww_sl_height','470');

        $bottom_mask = $this->opt('hm_header_bmasks','none');
        $bm_class = $bottom_mask != 'none' ? 'maskcontainer--'.$bottom_mask : '';

        ?>
<div class="kl-slideshow kl-wowslider <?php echo $style; ?> <?php echo $bm_class ?> <?php echo $this->data['uid']; ?> <?php echo $this->opt('css_class',''); ?>">

    <div class="fake-loading loading-2s"></div>

    <div class="bgback"></div>
    <?php
        WpkPageHelper::zn_background_source( array(
            'source_type' => $this->opt('source_type'),
            'source_background_image' => $this->opt('background_image'),
            'source_vd_yt' => $this->opt('source_vd_yt'),
            'source_vd_self_mp4' => $this->opt('source_vd_self_mp4'),
            'source_vd_self_ogg' => $this->opt('source_vd_self_ogg'),
            'source_vd_self_webm' => $this->opt('source_vd_self_webm'),
            'source_vd_vp' => $this->opt('source_vd_vp'),
            'source_vd_autoplay' => $this->opt('source_vd_autoplay'),
            'source_vd_loop' => $this->opt('source_vd_loop'),
            'source_vd_muted' => $this->opt('source_vd_muted'),
            'source_vd_controls' => $this->opt('source_vd_controls'),
            'source_vd_controls_pos' => $this->opt('source_vd_controls_pos'),
            'source_overlay' => $this->opt('source_overlay'),
            'source_overlay_color' => $this->opt('source_overlay_color'),
            'source_overlay_opacity' => $this->opt('source_overlay_opacity'),
            'source_overlay_color_gradient' => $this->opt('source_overlay_color_gradient'),
            'source_overlay_color_gradient_opac' => $this->opt('source_overlay_color_gradient_opac'),
        ) );
    ?>
    <div class="th-sparkles"></div>

    <div class="container kl-slideshow-inner kl-slideshow-safepadding">
        <div class="th-wowslider <?php echo $ww_shadow;?> <?php echo $captstyle; ?>" data-transition="<?php echo $this->opt('ww_transition','blast'); ?>" data-autoplay="<?php echo $this->opt('ww_autoplay','true'); ?>" data-timeout="<?php echo $this->opt('ww_timeout','3000'); ?>">
            <div class="ws_images">
                <ul>
                <?php
                    if ( isset ( $options['single_wow'] ) && is_array( $options['single_wow'] ) ) {
                        $i      = 0;
                        $thumbs = '';
                        foreach ( $options['single_wow'] as $slide ) {
                            $link_start = '';
                            $link_end   = '';
                            $title      = '';

                            if ( isset ( $slide['ww_slide_link']['url'] ) && ! empty ( $slide['ww_slide_link']['url'] ) ) {
                                // Set defaults
                                $link_start = '<a class="link" href="' . $slide['ww_slide_link']['url'] . '" target="' . $slide['ww_slide_link']['target'] . '">';
                                $link_end   = '</a>';
                            }

                            if ( isset ( $slide['ww_slide_title'] ) && ! empty ( $slide['ww_slide_title'] ) ) {
                                $title = $slide['ww_slide_title'];
                            }

                            echo '<li>';
                            echo $link_start;

                            if ( isset ( $slide['ww_slide_image'] ) && ! empty ( $slide['ww_slide_image'] ) ) {

                                $image = vt_resize( '', $slide['ww_slide_image'], '1170', $sl_height, true );
                                echo '<img id="wows1_' . $i . '" title="' . $title . '" alt="' . $title . '" src="' . $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" />';

                                $image_thumb = vt_resize( '', $slide['ww_slide_image'], '150', '60', true );
                                $thumbs .= '<a href="#" title="slide' . $i . '"><img src="' . $image_thumb['url'] . '" alt="" />' . $i . '</a>';
                            }

                            echo $link_end;
                            echo '</li>';
                            $i ++;
                        }
                    }
                ?>
                </ul>
            </div><!-- end ws_images -->

            <div class="ws_bullets">
                <div>
                    <?php echo $thumbs; ?>
                </div>
            </div><!-- end ws-bullets -->

        </div><!-- end #wow slider -->
    </div>
    <?php
        WpkPageHelper::zn_bottommask_markup($bottom_mask);
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
        $extra_options = array (
            "name"           => __( "Slides", 'zn_framework' ),
            "description"    => __( "Here you can create your Wow Slider Slides.", 'zn_framework' ),
            "id"             => "single_wow",
            "std"            => "",
            "type"           => "group",
            "add_text"       => __( "Slide", 'zn_framework' ),
            "remove_text"    => __( "Slide", 'zn_framework' ),
            "group_sortable" => true,
            "element_title" => "ww_slide_title",
            "subelements"    => array (
                array (
                    "name"        => __( "Slide image", 'zn_framework' ),
                    "description" => __( "Select an image for this Slide", 'zn_framework' ),
                    "id"          => "ww_slide_image",
                    "std"         => "",
                    "type"        => "media"
                ),
                array (
                    "name"        => __( "Slide title", 'zn_framework' ),
                    "description" => __( "This title will appear over the image", 'zn_framework' ),
                    "id"          => "ww_slide_title",
                    "std"         => "",
                    "type"        => "text"
                ),
                array (
                    "name"        => __( "Slide link", 'zn_framework' ),
                    "description" => __( "Here you can add a link to your slide", 'zn_framework' ),
                    "id"          => "ww_slide_link",
                    "std"         => "",
                    "type"        => "link",
                    "options"     => array (
                        '_self'  => __( "Same window", 'zn_framework' ),
                        '_blank' => __( "New window", 'zn_framework' )
                    )
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
                        "name"        => __( "Slides Height", 'zn_framework' ),
                        "description" => __( "Select a slider height. Removing the height will add an auto flag which will keep the default images heights.", 'zn_framework' ),
                        "id"          => "ww_sl_height",
                        "std"         => "470",
                        "type"        => "text"
                    ),

                    array (
                        "name"        => __( "Slider Transition", 'zn_framework' ),
                        "description" => __( "Select the desired transition that you want to use for this slider.", 'zn_framework' ),
                        "id"          => "ww_transition",
                        "std"         => "blast",
                        "type"        => "select",
                        "options"     => array (
                            'blast'  => __( 'Blast', 'zn_framework' ),
                            'blinds' => __( 'Blinds', 'zn_framework' ),
                            'blur'   => __( 'Blur', 'zn_framework' ),
                            'fly'    => __( 'Fly', 'zn_framework' )
                        ),
                    ),

                    array (
                        "name"        => __( "Caption style", 'zn_framework' ),
                        "description" => __( "Select caption style", 'zn_framework' ),
                        "id"          => "ww_caption_style",
                        "std"         => "normal",
                        "type"        => "select",
                        "options" => array(
                            "" => "Normal",
                            "alt" => "Big text",
                        )
                    ),

                    array (
                        "name"        => __( "Autoplay?", 'zn_framework' ),
                        "description" => __( "Autoplay the carousel?", 'zn_framework' ),
                        "id"          => "ww_autoplay",
                        "std"         => "true",
                        "type"        => "select",
                        "options" => array(
                            "true" => "Yes",
                            "false" => "No",
                        )
                    ),

                    array (
                        "name"        => __( "Timeout duration", 'zn_framework' ),
                        "description" => __( "Timeout duration in miliseconds. The time between slides", 'zn_framework' ),
                        "id"          => "ww_timeout",
                        "std"         => "3000",
                        "type"        => "text"
                    ),

                )
            ),

            'items' => array(
                'title' => 'Add slides',
                'options' => array(
                    $extra_options,
                ),
            ),

            'background' => array(
                'title' => 'Background & Styles Options',
                'options' => array(

                    array (
                        "name"        => __( "Shadow style", 'zn_framework' ),
                        "description" => __( "Select the desired shadow that you want to use for this slider.", 'zn_framework' ),
                        "id"          => "ww_shadow",
                        "std"         => "lifted",
                        "type"        => "select",
                        "options"     => array (
                            ''             => __( 'No Shadow', 'zn_framework' ),
                            'lifted'       => __( 'Lifted', 'zn_framework' )
                        ),
                        "class"       => ""
                    ),

                    array (
                        "name"        => __( "Element Background Style", 'zn_framework' ),
                        "description" => __( "Select the background style you want to use for this slider. Please note that styles can be created from the unlimited headers options in the theme admin's page.", 'zn_framework' ),
                        "id"          => "ww_header_style",
                        "std"         => "",
                        "type"        => "select",
                        "options"     => WpkZn::getThemeHeaders(true),
                        "class"       => ""
                    ),

                    // Background image/video or youtube
                    array (
                        "name"        => __( "Background Source Type", 'zn_framework' ),
                        "description" => __( "Please select the source type of the background.", 'zn_framework' ),
                        "id"          => "source_type",
                        "std"         => "",
                        "type"        => "select",
                        "options"     => array (
                            ''  => __( "None (Will just rely on the background color (if any) )", 'zn_framework' ),
                            'image'  => __( "Image", 'zn_framework' ),
                            'video_self' => __( "Self Hosted Video", 'zn_framework' ),
                            'video_youtube' => __( "Youtube Video", 'zn_framework' )
                        )
                    ),

                    array(
                        'id'          => 'background_image',
                        'name'        => 'Background image',
                        'description' => 'Please choose a background image for this section.',
                        'type'        => 'background',
                        'options' => array( "repeat" => true , "position" => true , "attachment" => true, "size" => true ),
                        'class'       => 'zn_full',
                        'dependency' => array( 'element' => 'source_type' , 'value'=> array('image') )
                    ),

                    // Youtube video
                    array (
                        "name"        => __( "Slide Video Youtube ID", 'zn_framework' ),
                        "description" => __( "Add an Youtube ID", 'zn_framework' ),
                        "id"          => "source_vd_yt",
                        "std"         => "",
                        "type"        => "text",
                        "placeholder" => "ex: tR-5AZF9zPI",
                        "dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_youtube') )
                    ),
                    /* LOCAL VIDEO */
                    array(
                        'id'          => 'source_vd_self_mp4',
                        'name'        => 'Mp4 video source',
                        'description' => 'Add the MP4 video source for your local video',
                        'type'        => 'media_upload',
                        'std'         => '',
                        'data'  => array(
                            'type' => 'video/mp4',
                            'button_title' => 'Add / Change mp4 video',
                        ),
                        "dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self') )
                    ),
                    array(
                        'id'          => 'source_vd_self_ogg',
                        'name'        => 'Ogg/Ogv video source',
                        'description' => 'Add the OGG video source for your local video',
                        'type'        => 'media_upload',
                        'std'         => '',
                        'data'  => array(
                            'type' => 'video/ogg',
                            'button_title' => 'Add / Change ogg video',
                        ),
                        "dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self') )
                    ),
                    array(
                        'id'          => 'source_vd_self_webm',
                        'name'        => 'Webm video source',
                        'description' => 'Add the WEBM video source for your local video',
                        'type'        => 'media_upload',
                        'std'         => '',
                        'data'  => array(
                            'type' => 'video/webm',
                            'button_title' => 'Add / Change webm video',
                        ),
                        "dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self') )
                    ),
                    array(
                        'id'          => 'source_vd_vp',
                        'name'        => 'Video poster',
                        'description' => 'Using this option you can add your desired video poster that will be shown on unsuported devices.',
                        'type'        => 'media',
                        'std'         => '',
                        'class'       => 'zn_full',
                        "dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self','video_youtube') )
                    ),
                    array(
                        'id'          => 'source_vd_autoplay',
                        'name'        => 'Autoplay video?',
                        'description' => 'Enable autoplay for video?',
                        'type'        => 'select',
                        'std'         => 'yes',
                        "dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self','video_youtube') ),
                        "options"     => array (
                            "yes" => __( "Yes", 'zn_framework' ),
                            "no"  => __( "No", 'zn_framework' )
                        ),
                        "class"       => "zn_input_xs"
                    ),
                    array(
                        'id'          => 'source_vd_loop',
                        'name'        => 'Loop video?',
                        'description' => 'Enable looping the video?',
                        'type'        => 'select',
                        'std'         => 'yes',
                        "dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self','video_youtube') ),
                        "options"     => array (
                            "yes" => __( "Yes", 'zn_framework' ),
                            "no"  => __( "No", 'zn_framework' )
                        ),
                        "class"       => "zn_input_xs"
                    ),
                    array(
                        'id'          => 'source_vd_muted',
                        'name'        => 'Start mute?',
                        'description' => 'Start the video with muted audio?',
                        'type'        => 'select',
                        'std'         => 'yes',
                        "dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self','video_youtube') ),
                        "options"     => array (
                            "yes" => __( "Yes", 'zn_framework' ),
                            "no"  => __( "No", 'zn_framework' )
                        ),
                        "class"       => "zn_input_xs"
                    ),
                    array(
                        'id'          => 'source_vd_controls',
                        'name'        => 'Video controls',
                        'description' => 'Enable video controls?',
                        'type'        => 'select',
                        'std'         => 'yes',
                        "dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self','video_youtube') ),
                        "options"     => array (
                            "yes" => __( "Yes", 'zn_framework' ),
                            "no"  => __( "No", 'zn_framework' )
                        ),
                        "class"       => "zn_input_xs"
                    ),
                    array(
                        'id'          => 'source_vd_controls_pos',
                        'name'        => 'Video controls position',
                        'description' => 'Video controls position in the slide',
                        'type'        => 'select',
                        'std'         => 'bottom-right',
                        "dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self','video_youtube') ),
                        "options"     => array (
                            "top-right" => __( "top-right", 'zn_framework' ),
                            "top-left" => __( "top-left", 'zn_framework' ),
                            "top-center"  => __( "top-center", 'zn_framework' ),
                            "bottom-right"  => __( "bottom-right", 'zn_framework' ),
                            "bottom-left"  => __( "bottom-left", 'zn_framework' ),
                            "bottom-center"  => __( "bottom-center", 'zn_framework' ),
                            "middle-right"  => __( "middle-right", 'zn_framework' ),
                            "middle-left"  => __( "middle-left", 'zn_framework' ),
                            "middle-center"  => __( "middle-center", 'zn_framework' )
                        ),
                        "class"       => "zn_input_sm"
                    ),

                    array(
                        'id'          => 'source_overlay',
                        'name'        => 'Background colored overlay',
                        'description' => 'Add slide color overlay over the image or video to darken or enlight?',
                        'type'        => 'select',
                        'std'         => '0',
                        "options"     => array (
                            "1" => __( "Yes (Normal color)", 'zn_framework' ),
                            "2" => __( "Yes (Horizontal gradient)", 'zn_framework' ),
                            "3" => __( "Yes (Vertical gradient)", 'zn_framework' ),
                            "0"  => __( "No", 'zn_framework' )
                        )
                    ),

                    array(
                        'id'          => 'source_overlay_color',
                        'name'        => 'Overlay background color',
                        'description' => 'Pick a color',
                        'type'        => 'colorpicker',
                        'std'         => '#353535',
                        "dependency"  => array( 'element' => 'source_overlay' , 'value'=> array('1', '2', '3') ),
                    ),
                    array(
                        'id'          => 'source_overlay_opacity',
                        'name'        => 'Overlay\'s opacity.',
                        'description' => 'Overlay background colors opacity level.',
                        'type'        => 'slider',
                        'std'         => '30',
                        "helpers"     => array (
                            "step" => "5",
                            "min" => "0",
                            "max" => "100"
                        ),
                        "dependency"  => array( 'element' => 'source_overlay' , 'value'=> array('1', '2', '3') ),
                    ),

                    array(
                        'id'          => 'source_overlay_color_gradient',
                        'name'        => 'Overlay Gradient 2nd Bg. Color',
                        'description' => 'Pick a color',
                        'type'        => 'colorpicker',
                        'std'         => '#353535',
                        "dependency"  => array( 'element' => 'source_overlay' , 'value'=> array('2', '3') ),
                    ),
                    array(
                        'id'          => 'source_overlay_color_gradient_opac',
                        'name'        => 'Gradient Overlay\'s 2nd Opacity.',
                        'description' => 'Overlay gradient 2nd background color opacity level.',
                        'type'        => 'slider',
                        'std'         => '30',
                        "helpers"     => array (
                            "step" => "5",
                            "min" => "0",
                            "max" => "100"
                        ),
                        "dependency"  => array( 'element' => 'source_overlay' , 'value'=> array('2', '3') ),
                    ),

                    // Bottom masks
                    array (
                        "name"        => __( "Bottom masks override", 'zn_framework' ),
                        "description" => __( "The new masks are svg based, vectorial and color adapted. <br> <strong>Disclaimer:</strong> may now work perfectly for all elements!", 'zn_framework' ),
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#wQ_XfgfzRwk" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/wow-slider/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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

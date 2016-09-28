<?php if(! defined('ABSPATH')){ return; }
/*
Name: Laptop Slider
Description: Create and display a Laptop Slider element
Class: TH_LaptopSlider
Category: header, Fullwidth
Level: 1
Scripts: true
*/

/**
 * Class TH_LaptopSlider
 *
 * Create and display a Laptop Slider element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    3.8.0
 */
class TH_LaptopSlider extends ZnElements
{
    public static function getName(){
        return __( "Laptop Slider", 'zn_framework' );
    }

    /**
     * Load dependant resources
     */
    function scripts(){
        wp_enqueue_style( 'lslider', THEME_BASE_URI . '/sliders/laptop_slider/laptop-slider.css',array('kallyas-styles'), ZN_FW_VERSION );
        wp_enqueue_script( 'ios_slider_min', THEME_BASE_URI . '/sliders/iosslider/jquery.iosslider.min.js', array('jquery'), ZN_FW_VERSION );
    }

    /**
     * This method is used to display the output of the element.
     *
     * @return void
     */
    function element()
    {
        $options = $this->data['options'];
        $style = 'zn_def_header_style';
        if ( isset ( $options['ls_header_style'] ) &&
             ! empty ( $options['ls_header_style'] ) &&
             $options['ls_header_style'] != 'zn_def_header_style' )
        {
            $style = 'uh_' . $options['ls_header_style'];
        }

        $slider_desc = '';
        if ( isset ( $options['ls_slider_desc'] ) && ! empty ( $options['ls_slider_desc'] ) ) {
            $slider_desc = '<h3 class="ls__main-title">' . do_shortcode( $options['ls_slider_desc'] ) . '</h3>';
        }

        $uid = $this->data['uid'];

        $ls_slider_display = $this->opt('ls_slider_display', 'laptop');

        $slides_exists = isset($options['single_lslides']) && is_array($options['single_lslides']);

        $fullscreen = $this->opt('ls_fullscreen',0) == 1 ? 'ls--fullscreen':'';
        $enable_autoplay = $this->opt('enable_autoplay','yes') == 'yes';

        // Mask
        // -- not needed as the slider has it's own mask
        // $bottom_mask = $this->opt('hm_header_bmasks','none');
        // $bm_class = $bottom_mask != 'none' ? 'maskcontainer--'.$bottom_mask : '';

        ?>
        <div class="kl-slideshow laptop-slider__slideshow ls--<?php echo $ls_slider_display; ?> <?php echo $style; ?> <?php echo $fullscreen; ?> <?php echo $this->data['uid']; ?> <?php echo $this->opt('css_class',''); ?>">

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

                if( $this->opt('source_mask',1) ){
                    echo '<div class="ls-source__mask ls-source__mask-back"></div>';
                    echo '<div class="ls-source__mask ls-source__mask-front"></div>';
                }

            ?>
            <div class="th-sparkles"></div>

            <div class="laptop-slider__inner container ls--theme-<?php echo $this->opt('ls_theme_color', 'light') ?>">
                <div class=" ls__container kl-slideshow-safepadding">

                    <?php echo $slider_desc;?>

                    <div class="ls__laptop-mask">

                        <div class="ls__screen">
                            <div class="zn_laptop_slider_wrapper">

                                <div class="fake-loading loading-1s fl--nobg"></div>

                                <div class="zn_laptop_slider" data-details="#ls__left-desc-<?php echo $uid; ?>" data-autoplay="<?php echo $enable_autoplay;?>" data-trans="<?php echo $this->opt('ls_trans', 5000); ?>">
                                    <div class="zn_laptop_slider_container">
<?php
if ( $slides_exists ) {

    $bullets = '';

    foreach ( $options['single_lslides'] as $slide )
    {
        $link_start = '';
        $link_end   = '';

        $bullets .= '<a href="#" class="ls__nav-item"></a>';

        if ( isset ( $slide['ls_slide_link']['url'] ) && ! empty ( $slide['ls_slide_link']['url'] ) ) {
            // Link
            $link_start = '<a class="ls__item-link" href="' . $slide['ls_slide_link']['url'] . '" target="' . $slide['ls_slide_link']['target'] . '">';
            $link_end   = '</a>';
        }
        $caption = isset ( $slide['ls_slide_title'] ) && ! empty ( $slide['ls_slide_title'] ) ? $slide['ls_slide_title'] : '';

        // Display image
        echo '<div class="ls__slider-item">';
            if ( isset ( $slide['ls_slide_image'] ) && ! empty ( $slide['ls_slide_image'] ) ) {
                $image = vt_resize( '', $slide['ls_slide_image'], '800', '600', true );
                echo '<div class="ls-slider-item__img" style="background-image:url(' . $image['url'] . ')"></div>';
            }
            // If JUST slider
            if($ls_slider_display == 'laptop' && !empty($caption)){
                echo '<h3 class="ls__item-caption ff-alternative">' . $link_start . $caption . $link_end . '</h3>';
            }
        echo '</div>';

    }
}
?>
                                        </div><!-- /.zn_laptop_slider_container -->
                                    </div>
                                </div><!-- /.zn_laptop_slider_wrapper -->
                            </div>
                            <!-- end /.ls screen -->

                            <?php if($this->opt('ls_slide_bullets',1)): ?>
                            <div class="ls__nav">
                                <?php if ( $slides_exists ) echo $bullets; ?>
                            </div>
                            <?php endif; ?>

                            <?php if($this->opt('ls_slide_arrows',1)): ?>
                            <div class="ls__arrows">
                                <span class="ls__arrow ls__arrow-left"></span>
                                <span class="ls__arrow ls__arrow-right"></span>
                            </div>
                            <?php endif; ?>

                        </div>
                        <!-- laptop mask -->

                        <?php
                        // If it's using the SLIDER description
                        if ($ls_slider_display == 'lapt_slider_desc' || $ls_slider_display == 'lapt_desc'): ?>

                        <div class="ls__left-desc" id="ls__left-desc-<?php echo $uid; ?>">

                            <?php if ($ls_slider_display == 'lapt_slider_desc'): ?>

                                <?php if($this->opt('ls_slide_title')): ?>
                                    <div class="ls__sl-main-title"><?php echo $this->opt('ls_slide_title'); ?></div>
                                <?php endif; ?>

                                <?php if($this->opt('ls_slide_desc')): ?>
                                    <div class="ls__sl-main-desc"><?php echo $this->opt('ls_slide_desc'); ?></div>
                                <?php endif; ?>

                                <?php
                                // BUTTON
                                if (
                                    ( isset($options['ls_slide_link']) && !empty($options['ls_slide_link']['url']) ) ||
                                    ( isset($options['sc_shcar_sec_btn']) && !empty($options['sc_shcar_sec_btn']['url']) )
                                ):
                                echo '<div class="ls__actionarea clearfix">';

                                    if ( isset ( $options['ls_slide_link']['url'] ) && ! empty ( $options['ls_slide_link']['url'] ) ) {
                                        echo '<a class="btn btn-fullcolor" href="' . $options['ls_slide_link']['url'] . '" target="' . $options['ls_slide_link']['target'] . '">' . $options['ls_slide_link']['title'] . '</a>';
                                    }
                                    if ( isset ( $options['ls_slide_link_sec']['url'] ) && ! empty ( $options['ls_slide_link_sec']['url'] ) ) {
                                        echo '<a class="btn ls__secbtn btn-lined '.( $this->opt('ls_theme_color', 'light') == 'dark' ? 'lined-dark':'' ).'" href="' . $options['ls_slide_link_sec']['url'] . '" target="' . $options['ls_slide_link_sec']['target'] . '">' . $options['ls_slide_link_sec']['title'] . '</a>';
                                    }

                                echo '</div>';
                                endif;
                                ?>

                            <?php
                            // If It's using the ITEMS description
                            elseif($ls_slider_display == 'lapt_desc'): ?>

                                <?php if( $slides_exists ): ?>
                                <?php foreach ( $options['single_lslides'] as $slide ): ?>

                                    <div class="ls_slide_item-details">

                                        <?php if($slide['ls_slide_title']): ?>
                                            <div class="ls__sl-main-title"><?php echo $slide['ls_slide_title']; ?></div>
                                        <?php endif; ?>

                                        <?php if($slide['ls_slide_desc']): ?>
                                            <div class="ls__sl-main-desc"><?php echo $slide['ls_slide_desc']; ?></div>
                                        <?php endif; ?>

                                        <?php
                                        // BUTTON
                                        if (
                                            ( isset($slide['ls_slide_link']) && !empty($slide['ls_slide_link']['url']) ) ||
                                            ( isset($slide['sc_shcar_sec_btn']) && !empty($slide['sc_shcar_sec_btn']['url']) )
                                        ):
                                        echo '<div class="ls__actionarea clearfix">';

                                            if ( isset ( $slide['ls_slide_link']['url'] ) && ! empty ( $slide['ls_slide_link']['url'] ) ) {
                                                echo '<a class="btn btn-fullcolor" href="' . $slide['ls_slide_link']['url'] . '" target="' . $slide['ls_slide_link']['target'] . '">' . $slide['ls_slide_link']['title'] . '</a>';
                                            }
                                            if ( isset ( $slide['ls_slide_link_sec']['url'] ) && ! empty ( $slide['ls_slide_link_sec']['url'] ) ) {
                                                echo '<a class="btn ls__secbtn btn-lined '.( $this->opt('ls_theme_color', 'light') == 'dark' ? 'lined-dark':'' ).'" href="' . $slide['ls_slide_link_sec']['url'] . '" target="' . $slide['ls_slide_link_sec']['target'] . '">' . $slide['ls_slide_link_sec']['title'] . '</a>';
                                            }

                                        echo '</div>';
                                        endif;
                                        ?>

                                    </div>

                                <?php endforeach; ?>
                                <?php endif; ?>

                            <?php endif; ?>

                        </div><!-- /.ls__left-desc -->

                        <?php endif; ?>
                        <div class="clearfix"></div>

                    </div><!-- /.laptop-slider__inner -->
                </div>
            </div>
            <?php
                // not needed as the slider has it's own mask
                // WpkPageHelper::zn_bottommask_markup($bottom_mask);
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
            "description"    => __( "Here you can create your Laptop Slider Slides.", 'zn_framework' ),
            "id"             => "single_lslides",
            "std"            => "",
            "type"           => "group",
            "add_text"       => __( "Slide", 'zn_framework' ),
            "remove_text"    => __( "Slide", 'zn_framework' ),
            "group_sortable" => true,
            "element_title" => "ls_slide_title",
            "subelements"    => array (
                array (
                    "name"        => __( "Slide image", 'zn_framework' ),
                    "description" => __( "Select an image for this Slide", 'zn_framework' ),
                    "id"          => "ls_slide_image",
                    "std"         => "",
                    "type"        => "media"
                ),
                array (
                    "name"        => __( "Slide title", 'zn_framework' ),
                    "description" => __( "This title will appear on the left side.", 'zn_framework' ),
                    "id"          => "ls_slide_title",
                    "std"         => "",
                    "type"        => "text"
                ),
                array (
                    "name"        => __( "Slide Description", 'zn_framework' ),
                    "description" => __( "This description will appear on the left side.", 'zn_framework' ),
                    "id"          => "ls_slide_desc",
                    "std"         => "",
                    "type"        => "textarea"
                ),
                array (
                    "name"        => __( "Primary Button", 'zn_framework' ),
                    "description" => __( "Here you can add data for the primary button. In case the general slider style is 'Just Laptop', this link will be used to add a link to the title of the slide.", 'zn_framework' ),
                    "id"          => "ls_slide_link",
                    "std"         => "",
                    "type"        => "link",
                    "options"     => array (
                        '_self'  => __( "Same window", 'zn_framework' ),
                        '_blank' => __( "New window", 'zn_framework' )
                    )
                ),
                array (
                    "name"        => __( "Secondary Button", 'zn_framework' ),
                    "description" => __( "Here you can add data for the secondary button.", 'zn_framework' ),
                    "id"          => "ls_slide_link_sec",
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
                        "name"        => __( "Enable fullscreen?", 'zn_framework' ),
                        "description" => __( "Do you want to display the static content as fullscreen?", 'zn_framework' ),
                        "id"          => "ls_fullscreen",
                        "std"         => "0",
                        "type"        => "select",
                        "options"     => array (
                            '1'  => __( "Yes", 'zn_framework' ),
                            '0' => __( "No", 'zn_framework' )
                        )
                    ),

                    array (
                        "name"        => __( "Slider Title", 'zn_framework' ),
                        "description" => __( "Here you can enter a main title that will appear above the slider.", 'zn_framework' ),
                        "id"          => "ls_slider_desc",
                        "std"         => "",
                        "type"        => "textarea",
                        "class"       => ''
                    ),
                    array (
                        "name"        => __( "Slider Display", 'zn_framework' ),
                        "description" => __( "Select how to display the slider.", 'zn_framework' ),
                        "id"          => "ls_slider_display",
                        "std"         => "laptop",
                        "type"        => "select",
                        "options"     => array (
                            'laptop'  => __( "Just laptop", 'zn_framework' ),
                            'lapt_desc' => __( "Laptop with ITEMS description", 'zn_framework' ),
                            'lapt_slider_desc' => __( "Laptop with SLIDER details", 'zn_framework' )
                        )
                    ),

                    // Main title
                    array (
                        "name"        => __( "Main title", 'zn_framework' ),
                        "description" => __( "This title will appear on the left side.", 'zn_framework' ),
                        "id"          => "ls_slide_title",
                        "std"         => "",
                        "type"        => "text",
                        "dependency"  => array( 'element' => 'ls_slider_display' , 'value'=> array('lapt_slider_desc') )
                    ),
                    array (
                        "name"        => __( "Main Description", 'zn_framework' ),
                        "description" => __( "This description will appear on the left side.", 'zn_framework' ),
                        "id"          => "ls_slide_desc",
                        "std"         => "",
                        "type"        => "textarea",
                        "dependency"  => array( 'element' => 'ls_slider_display' , 'value'=> array('lapt_slider_desc') )
                    ),
                    array (
                        "name"        => __( "Primary Button", 'zn_framework' ),
                        "description" => __( "Here you can add data for the primary button. In case the general slider style is 'Just Laptop', this link will be used to add a link to the title of the slide.", 'zn_framework' ),
                        "id"          => "ls_slide_link",
                        "std"         => "",
                        "type"        => "link",
                        "options"     => array (
                            '_self'  => __( "Same window", 'zn_framework' ),
                            '_blank' => __( "New window", 'zn_framework' )
                        ),
                        "dependency"  => array( 'element' => 'ls_slider_display' , 'value'=> array('lapt_slider_desc') )
                    ),
                    array (
                        "name"        => __( "Secondary Button", 'zn_framework' ),
                        "description" => __( "Here you can add data for the secondary button.", 'zn_framework' ),
                        "id"          => "ls_slide_link_sec",
                        "std"         => "",
                        "type"        => "link",
                        "options"     => array (
                            '_self'  => __( "Same window", 'zn_framework' ),
                            '_blank' => __( "New window", 'zn_framework' )
                        ),
                        "dependency"  => array( 'element' => 'ls_slider_display' , 'value'=> array('lapt_slider_desc') )
                    ),

                    array(
                        'id'          => 'ls_slide_bullets',
                        'name'        => 'Enable bullets?',
                        'description' => 'Enable bullets for the slides?',
                        'type'        => 'select',
                        'std'         => '1',
                        "options"     => array (
                            "1" => __( "Yes", 'zn_framework' ),
                            "0"  => __( "No", 'zn_framework' )
                        ),
                        "class"       => "zn_input_xs"
                    ),
                    array(
                        'id'          => 'ls_slide_arrows',
                        'name'        => 'Enable Control Arrows?',
                        'description' => 'Enable next & prev arrows?',
                        'type'        => 'select',
                        'std'         => '1',
                        "options"     => array (
                            "1" => __( "Yes", 'zn_framework' ),
                            "0"  => __( "No", 'zn_framework' )
                        ),
                        "class"       => "zn_input_xs"
                    ),
                    array(
                        'id'            => 'enable_autoplay',
                        'name'          => 'Enable Auto play ?',
                        'description'   => 'Select if you want to autoplay the slider',
                        'type'          => 'toggle2',
                        'std'           => 'yes',
                        'value'         => 'yes'
                    ),
                    array (
                        "name"        => __( "Transition Timeout", 'zn_framework' ),
                        "description" => __( "Enter a numeric value automatic timeout between slides (default: 5000)", 'zn_framework' ),
                        "id"          => "ls_trans",
                        "std"         => "5000",
                        "type"        => "text",
                        "class"       => "zn_input_xs",
                        'dependency'  => array( 'element' => 'enable_autoplay', 'value' => array( 'yes' ) )
                    ),
                    array (
                        "name"        => __( "Text Theme Colors", 'zn_framework' ),
                        "description" => __( "Select the color theming. Perhaps you want a light background with dark text or viceversa.", 'zn_framework' ),
                        "id"          => "ls_theme_color",
                        "std"         => "light",
                        "type"        => "select",
                        "options"     => array (
                            'light'  => __( "Light", 'zn_framework' ),
                            'dark'   => __( "Dark", 'zn_framework' )
                        )
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
                        "name"        => __( "Element Background Style", 'zn_framework' ),
                        "description" => __( "Select the background style you want to use for this slider. Please note that styles can be created from the unlimited headers options in the theme admin's page.", 'zn_framework' ),
                        "id"          => "ls_header_style",
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

                    // array(
                    //  'id'            => 'enable_parallax',
                    //  'name'          => 'Enable parallax',
                    //  'description'   => 'Select if you want to enable parallax effect on background image',
                    //  'type'          => 'toggle2',
                    //  'std'           => '',
                    //  'value'         => 'yes'
                    // ),



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

                    // // Bottom masks
                    // array (
                    //     "name"        => __( "Bottom masks override", 'zn_framework' ),
                    //     "description" => __( "The new masks are svg based, vectorial and color adapted. <br> <strong>Disclaimer:</strong> may now work perfectly for all elements!", 'zn_framework' ),
                    //     "id"          => "hm_header_bmasks",
                    //     "std"         => "none",
                    //     "type"        => "select",
                    //     "options"     => array (
                    //         'none' => __( 'None, just rely on Background style.', 'zn_framework' ),
                    //         'shadow' => __( 'Shadow Up', 'zn_framework' ),
                    //         'shadow_ud' => __( 'Shadow Up and down', 'zn_framework' ),
                    //         'mask1' => __( 'Raster Mask 1 (Old, not recommended)', 'zn_framework' ),
                    //         'mask2' => __( 'Raster Mask 2 (Old, not recommended)', 'zn_framework' ),
                    //         'mask3' => __( 'Vector Mask 3 (New! From v4.0)', 'zn_framework' ),
                    //         'mask4' => __( 'Vector Mask 4 (New! From v4.0)', 'zn_framework' ),
                    //         'mask5' => __( 'Vector Mask 5 (New! From v4.0)', 'zn_framework' ),
                    //         'mask6' => __( 'Vector Mask 6 (New! From v4.0)', 'zn_framework' ),
                    //     ),
                    // ),
                    array(
                        'id'          => 'source_mask',
                        'name'        => 'Add bottom mask?',
                        'description' => 'Add a bottom mask?',
                        'type'        => 'select',
                        'std'         => '1',
                        "options"     => array (
                            "1" => __( "Yes", 'zn_framework' ),
                            "0"  => __( "No", 'zn_framework' )
                        )
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#tyNiHoWQsUE" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/laptop-slider/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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


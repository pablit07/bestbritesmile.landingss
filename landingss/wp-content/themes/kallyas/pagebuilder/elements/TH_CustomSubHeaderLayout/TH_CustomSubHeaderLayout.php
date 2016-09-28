<?php if(! defined('ABSPATH')){ return; }
/*
Name: Custom Sub-header
Description: Create and display a Custom Header Layout element
Class: TH_CustomSubHeaderLayout
Category: headers, Fullwidth
Level: 1
*/
/**
 * Class TH_CustomSubHeaderLayout
 *
 * Create and display a Custom Header Layout element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    3.8.0
 */
class TH_CustomSubHeaderLayout extends ZnElements
{
    public static function getName(){
        return __( "Custom Sub-Header Layout", 'zn_framework' );
    }

    /**
     * This method is used to display the output of the element.
     * @return void
     */
    function element(){

        $bgsource = array(
            'source_type' => $this->opt('source_type'),
            'source_background_image' => $this->opt('source_background_image'),
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
        );

        $config = array();
        if( !empty( $this->data['options'] ) ){
            $config = array(
                'headerClass' => 'site-subheader-cst uh_'. $this->opt( 'hm_header_style', 'zn_def_header_style' ),
                'def_header_date' => $this->opt( 'hm_header_date', 0 ),
                'extra_css_class' => $this->data['uid'].' '.$this->opt('css_class',''),
                'bottommask' => $this->opt( 'hm_header_bmasks', 'none' ),
                'bg_source' => $bgsource,
                'def_header_title' => $this->opt( 'hm_header_title', 1 ),
                'show_subtitle' =>  $this->opt( 'hm_header_subtitle', 1 ),
                'def_header_bread' => $this->opt('hm_header_bread')
            );
        }

        $title = $this->opt('hm_header_ovtitle');
        $subtitle = $this->opt('hm_header_ovsubtitle');

        if( !empty( $title ) ){ $config['title'] = $title; }
        if( !empty( $subtitle ) ){ $config['subtitle'] = $subtitle; }

        // display the Subheader
        WpkPageHelper::zn_get_subheader($config);
    }

    /**
     * This method is used to retrieve the configurable options of the element.
     * @return array The list of options that compose the element and then passed as the argument for the render() function
     */
    function options()
    {
        $uid = $this->data['uid'];

        return  array (
            'has_tabs'  => true,
            'general' => array(
                'title' => 'General options',
                'options' => array(

                    array (
                        "name"        => __( "Show Page Title", 'zn_framework' ),
                        "description" => __( "Select if you want to show the page title or not.", 'zn_framework' ),
                        "id"          => "hm_header_title",
                        "std"         => "1",
                        "type"        => "select",
                        "options"     => array ( '1' => __( 'Show', 'zn_framework' ), '0' => __( 'Hide', 'zn_framework' ) ),
                        "class"       => ""
                    ),
                    array (
                        "name"        => __( "Override Title", 'zn_framework' ),
                        "description" => __( "Override the default page title.", 'zn_framework' ),
                        "id"          => "hm_header_ovtitle",
                        "std"         => "",
                        "type"        => "text",
                        "dependency"  => array( 'element' => 'hm_header_title' , 'value'=> array('1') )
                    ),

                    array (
                        "name"        => __( "Show Page Subtitle", 'zn_framework' ),
                        "description" => __( "Select if you want to show the page subtitle or not.", 'zn_framework' ),
                        "id"          => "hm_header_subtitle",
                        "std"         => "1",
                        "type"        => "select",
                        "options"     => array ( '1' => __( 'Show', 'zn_framework' ), '0' => __( 'Hide', 'zn_framework' ) ),
                        "class"       => ""
                    ),
                    array (
                        "name"        => __( "Override SubTitle", 'zn_framework' ),
                        "description" => __( "Override the default page subtitle.", 'zn_framework' ),
                        "id"          => "hm_header_ovsubtitle",
                        "std"         => "",
                        "type"        => "text",
                        "dependency"  => array( 'element' => 'hm_header_subtitle' , 'value'=> array('1') )
                    ),

                    array (
                        "name"        => __( "Show Breadcrumbs", 'zn_framework' ),
                        "description" => __( "Select if you want to show the breadcrumbs or not.", 'zn_framework' ),
                        "id"          => "hm_header_bread",
                        "std"         => "",
                        "type"        => "select",
                        "options"     => array ( '1' => __( 'Show', 'zn_framework' ), '0' => __( 'Hide', 'zn_framework' ) ),
                        "class"       => ""
                    ),

                    array (
                        "name"        => __( "Show Date", 'zn_framework' ),
                        "description" => __( "Select if you want to show the current date under breadcrumbs or not.", 'zn_framework' ),
                        "id"          => "hm_header_date",
                        "std"         => "",
                        "type"        => "select",
                        "options"     => array ( '1' => __( 'Show', 'zn_framework' ), '0' => __( 'Hide', 'zn_framework' ) ),
                        "class"       => ""
                    ),
                )
            ),

            'height_pad' => array(
                'title' => 'Height & Padding',
                'options' => array(

                    array (
                        "name"        => __( "Edit height and padding for each device breakpoint", 'zn_framework' ),
                        "description" => __( "Edit the height and padding options for each breakpoint (device). This will enable you to have more control over the subheader on each device. For example you might want the subheader to be shorter on mobiles, but taller on desktops.", 'zn_framework' ),
                        "id"          => "hm_br_options",
                        "std"         => "lg",
                        "type"        => "zn_radio",
                        "options"     => array (
                            "lg"        => __( "LARGE", 'zn_framework' ),
                            "md"        => __( "MEDIUM", 'zn_framework' ),
                            "sm"        => __( "SMALL", 'zn_framework' ),
                            "xs"        => __( "EXTRA SMALL", 'zn_framework' ),
                        ),
                        "class"       => "zn_full zn_breakpoints"
                    ),

                    // LARGE BREAKPOINTS
                    array (
                        "name"        => __( "Header Height on LARGE DEVICES (Desktops)", 'zn_framework' ),
                        "description" => __( "Please enter your desired height in pixels for this header.", 'zn_framework' ),
                        "id"          => "hm_header_height",
                        "std"         => "300",
                        "type" => "slider",
                        'class'       => 'zn_full',
                        'helpers'     => array(
                            'min' => '150',
                            'max' => '1280',
                            'step' => '1'
                        ),
                        'live' => array(
                            'multiple' => array(
                                array(
                                    'type'        => 'css',
                                    'css_class' => '.'.$this->data['uid'],
                                    'css_rule'    => 'height',
                                    'unit'        => 'px'
                                ),
                                array(
                                    'type'        => 'css',
                                    'css_class' => '.'.$this->data['uid'],
                                    'css_rule'    => 'min-height',
                                    'unit'        => 'px'
                                ),
                            ),
                        ),
                        "dependency"  => array( 'element' => 'hm_br_options' , 'value'=> array('lg') )
                    ),
                    array(
                        'id'          => 'top_padding',
                        'name'        => 'Top Padding on LARGE DEVICES (Desktops)',
                        'description' => 'Select the top padding ( in pixels ) for this section.',
                        'type'        => 'slider',
                        'std'         => '170',
                        'class'       => 'zn_full',
                        'helpers'     => array(
                            'min' => '50',
                            'max' => '350',
                            'step' => '1'
                        ),
                        'live' => array(
                            'type'      => 'css',
                            'css_class' => '.'.$this->data['uid'].' .ph-content-wrap',
                            'css_rule'  => 'padding-top',
                            'unit'      => 'px'
                        ),
                        "dependency"  => array( 'element' => 'hm_br_options' , 'value'=> array('lg') )
                    ),
                    array(
                        'id'          => 'bottom_padding',
                        'name'        => 'Bottom Padding on LARGE DEVICES (Desktops)',
                        'description' => 'Select the bottom padding ( in pixels ) for this section.',
                        'type'        => 'slider',
                        'std'         => '0',
                        'class'       => 'zn_full',
                        'helpers'     => array(
                            'min' => '0',
                            'max' => '350',
                            'step' => '1'
                        ),
                        'live' => array(
                            'type'      => 'css',
                            'css_class' => '.'.$this->data['uid'].' .ph-content-wrap',
                            'css_rule'  => 'padding-bottom',
                            'unit'      => 'px'
                        ),
                        "dependency"  => array( 'element' => 'hm_br_options' , 'value'=> array('lg') )
                    ),

                    // MEDIUM BREAKPOINTS
                    array (
                        "name"        => __( "Header Height on MEDIUM DEVICES (Tablets on Landscape mode)", 'zn_framework' ),
                        "description" => __( "Please enter your desired height in pixels for this header.", 'zn_framework' ),
                        "id"          => "hm_header_height_md",
                        "std"         => "300",
                        "type" => "slider",
                        'class'       => 'zn_full',
                        'helpers'     => array(
                            'min' => '150',
                            'max' => '1280',
                            'step' => '1'
                        ),
                        "dependency"  => array( 'element' => 'hm_br_options' , 'value'=> array('md') )
                    ),
                    array(
                        'id'          => 'top_padding_md',
                        'name'        => 'Top Padding on MEDIUM DEVICES (Tablets on Landscape mode)',
                        'description' => 'Select the top padding ( in pixels ) for this section.',
                        'type'        => 'slider',
                        'std'         => '170',
                        'class'       => 'zn_full',
                        'helpers'     => array(
                            'min' => '50',
                            'max' => '350',
                            'step' => '1'
                        ),
                        "dependency"  => array( 'element' => 'hm_br_options' , 'value'=> array('md') )
                    ),
                    array(
                        'id'          => 'bottom_padding_md',
                        'name'        => 'Bottom Padding on MEDIUM DEVICES (Tablets on Landscape mode)',
                        'description' => 'Select the bottom padding ( in pixels ) for this section.',
                        'type'        => 'slider',
                        'std'         => '0',
                        'class'       => 'zn_full',
                        'helpers'     => array(
                            'min' => '0',
                            'max' => '350',
                            'step' => '1'
                        ),
                        "dependency"  => array( 'element' => 'hm_br_options' , 'value'=> array('md') )
                    ),

                    // SMALL BREAKPOINTS
                    array (
                        "name"        => __( "Header Height on SMALL DEVICES (Tablets on Portrait mode)", 'zn_framework' ),
                        "description" => __( "Please enter your desired height in pixels for this header.", 'zn_framework' ),
                        "id"          => "hm_header_height_sm",
                        "std"         => "300",
                        "type" => "slider",
                        'class'       => 'zn_full',
                        'helpers'     => array(
                            'min' => '150',
                            'max' => '1280',
                            'step' => '1'
                        ),
                        "dependency"  => array( 'element' => 'hm_br_options' , 'value'=> array('sm') )
                    ),
                    array(
                        'id'          => 'top_padding_sm',
                        'name'        => 'Top Padding on SMALL DEVICES (Tablets on Portrait mode)',
                        'description' => 'Select the top padding ( in pixels ) for this section.',
                        'type'        => 'slider',
                        'std'         => '170',
                        'class'       => 'zn_full',
                        'helpers'     => array(
                            'min' => '50',
                            'max' => '350',
                            'step' => '1'
                        ),
                        "dependency"  => array( 'element' => 'hm_br_options' , 'value'=> array('sm') )
                    ),
                    array(
                        'id'          => 'bottom_padding_sm',
                        'name'        => 'Bottom Padding on SMALL DEVICES (Tablets on Portrait mode)',
                        'description' => 'Select the bottom padding ( in pixels ) for this section.',
                        'type'        => 'slider',
                        'std'         => '0',
                        'class'       => 'zn_full',
                        'helpers'     => array(
                            'min' => '0',
                            'max' => '350',
                            'step' => '1'
                        ),
                        "dependency"  => array( 'element' => 'hm_br_options' , 'value'=> array('sm') )
                    ),

                    // EXTRA SMALL BREAKPOINTS
                    array (
                        "name"        => __( "Header Height on EXTRA SMALL DEVICES (SmartPhones)", 'zn_framework' ),
                        "description" => __( "Please enter your desired height in pixels for this header.", 'zn_framework' ),
                        "id"          => "hm_header_height_xs",
                        "std"         => "300",
                        "type" => "slider",
                        'class'       => 'zn_full',
                        'helpers'     => array(
                            'min' => '150',
                            'max' => '1280',
                            'step' => '1'
                        ),
                        "dependency"  => array( 'element' => 'hm_br_options' , 'value'=> array('xs') )
                    ),
                    array(
                        'id'          => 'top_padding_xs',
                        'name'        => 'Top Padding on EXTRA SMALL DEVICES (SmartPhones)',
                        'description' => 'Select the top padding ( in pixels ) for this section.',
                        'type'        => 'slider',
                        'std'         => '170',
                        'class'       => 'zn_full',
                        'helpers'     => array(
                            'min' => '50',
                            'max' => '350',
                            'step' => '1'
                        ),
                        "dependency"  => array( 'element' => 'hm_br_options' , 'value'=> array('xs') )
                    ),
                    array(
                        'id'          => 'bottom_padding_xs',
                        'name'        => 'Bottom Padding on EXTRA SMALL DEVICES (SmartPhones)',
                        'description' => 'Select the bottom padding ( in pixels ) for this section.',
                        'type'        => 'slider',
                        'std'         => '0',
                        'class'       => 'zn_full',
                        'helpers'     => array(
                            'min' => '0',
                            'max' => '350',
                            'step' => '1'
                        ),
                        "dependency"  => array( 'element' => 'hm_br_options' , 'value'=> array('xs') )
                    ),


                )
            ),

            'background' => array(
                'title' => 'Background & Styles Options',
                'options' => array(
                    array (
                        "name"        => __( "Header Style", 'zn_framework' ),
                        "description" => __( "Select the header style you want to use for this page. Please note that header styles can be created from the theme's admin page .", 'zn_framework' ),
                        "id"          => "hm_header_style",
                        "std"         => "",
                        "type"        => "select",
                        "options"     => WpkZn::getThemeHeaders(true),
                        "class"       => "",
                        // Live doesn't work because we need to add extra 'uh_' to the option name
                        'live' => array(
                           'type'        => 'class',
                           'css_class' => '.'.$this->data['uid'],
                           'val_prepend'   => 'uh_',
                        )
                    ),

                    // Background image/video or youtube
                    array (
                        "name"        => __( "Background Source Type", 'zn_framework' ),
                        "description" => __( "Please select the source type of the background.", 'zn_framework' ),
                        "id"          => "source_type",
                        "std"         => "",
                        "type"        => "select",
                        "options"     => array (
                            ''  => __( "None (Will just rely on the Header style (if any selected) )", 'zn_framework' ),
                            'image'  => __( "Image", 'zn_framework' ),
                            'video_self' => __( "Self Hosted Video", 'zn_framework' ),
                            'video_youtube' => __( "Youtube Video", 'zn_framework' )
                        )
                    ),

                    array(
                        'id'          => 'source_background_image',
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
                        'std'         => $this->opt('source_type'),
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
                    )
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#fENF1bmvkmE" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/custom-header-layout/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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
    }

    /**
     * Output the inline css to head or after the element in case it is loaded via ajax
     */
    function css(){
        $css = '';
        $uid = $this->data['uid'];
        $height = $this->opt('hm_header_height', '300');

        // No need to add the css code if the value is left default which is 300px
        if( $height != '300' ){
            $extraHeightFromMask = $this->opt('hm_header_bmasks','none') != 'none' ? '30' : '0';
            $height = $extraHeightFromMask + $height;
            $css .= '.'.$uid.'.page-subheader { height: '. $height.'px; min-height: '. $height.'px;} ';
        }
        // Top padding
        $tpadding = '';
        $top_padding = $this->opt('top_padding');
        if($top_padding != '170'){
            $tpadding = $top_padding || $top_padding === '0' ? 'padding-top:'.$top_padding.'px;' : '';
        }
        // Bottom padding
        $bpadding = '';
        $bottom_padding = $this->opt('bottom_padding');
        if( $bottom_padding != 0 ){
            $bpadding = $bottom_padding || $bottom_padding === '0' ? 'padding-bottom:'.$bottom_padding.'px;' : '';
        }
        // Top and bottom paddings
        if($tpadding || $bpadding){
            $css .= '.'.$uid.'.page-subheader .ph-content-wrap {'.$tpadding.$bpadding.'}';
        }

        // MEDIUM BREAKPOINT HEIGHT
        $css_md = '';
        $height_md = $this->opt('hm_header_height_md', '300');
        if( $height_md != '300' ){
            $extraHeightFromMask = $this->opt('hm_header_bmasks','none') != 'none' ? '30' : '0';
            $height_md = $extraHeightFromMask + $height_md;
            $css_md .= '.'.$uid.'.page-subheader{height: '. $height_md.'px; min-height: '. $height_md.'px;} ';
        }
        // Top padding
        $tpadding_md = '';
        $top_padding_md = $this->opt('top_padding_md');
        if($top_padding_md != '170'){
            $tpadding_md = $top_padding_md || $top_padding_md === '0' ? 'padding-top:'.$top_padding_md.'px;' : '';
        }
        // Bottom padding
        $bpadding_md = '';
        $bottom_padding_md = $this->opt('bottom_padding_md');
        if( $bottom_padding_md != 0 ){
            $bpadding_md = $bottom_padding_md || $bottom_padding_md === '0' ? 'padding-bottom:'.$bottom_padding_md.'px;' : '';
        }
        // Top and bottom paddings
        if($tpadding_md || $bpadding_md){
            $css_md .= '.'.$uid.'.page-subheader .ph-content-wrap{'.$tpadding_md.$bpadding_md.'}';
        }
        // Subheader height & padding for MEDIUM
        if($css_md != ''){
            $css .= '@media screen and (min-width:992px) and (max-width:1199px) {'.$css_md.'}';
        }


        // SMALL BREAKPOINT HEIGHT
        $css_sm = '';
        $height_sm = $this->opt('hm_header_height_sm', '300');
        if( $height_sm != '300' ){
            $extraHeightFromMask = $this->opt('hm_header_bmasks','none') != 'none' ? '30' : '0';
            $height_sm = $extraHeightFromMask + $height_sm;
            $css_sm .= '.'.$uid.'.page-subheader{height: '. $height_sm.'px; min-height: '. $height_sm.'px;} ';
        }
        // Top padding
        $tpadding_sm = '';
        $top_padding_sm = $this->opt('top_padding_sm');
        if($top_padding_sm != '170'){
            $tpadding_sm = $top_padding_sm || $top_padding_sm === '0' ? 'padding-top:'.$top_padding_sm.'px;' : '';
        }
        // Bottom padding
        $bpadding_sm = '';
        $bottom_padding_sm = $this->opt('bottom_padding_sm');
        if( $bottom_padding_sm != 0 ){
            $bpadding_sm = $bottom_padding_sm || $bottom_padding_sm === '0' ? 'padding-bottom:'.$bottom_padding_sm.'px;' : '';
        }
        // Top and bottom paddings
        if($tpadding_sm || $bpadding_sm){
            $css_sm .= '.'.$uid.'.page-subheader .ph-content-wrap{'.$tpadding_sm.$bpadding_sm.'}';
        }
        // Subheader height & padding for SMALL
        if($css_sm != ''){
            $css .= '@media screen and (min-width:768px) and (max-width:991px) {'.$css_sm.'}';
        }


        // EXTRA SMALL BREAKPOINT HEIGHT
        $css_xs = '';
        $height_xs = $this->opt('hm_header_height_xs', '300');
        if( $height_xs != '300' ){
            $extraHeightFromMask = $this->opt('hm_header_bmasks','none') != 'none' ? '30' : '0';
            $height_xs = $extraHeightFromMask + $height_xs;
            $css_xs .= '.'.$uid.'.page-subheader{height: '. $height_xs.'px; min-height: '. $height_xs.'px;} ';
        }
        // Top padding
        $tpadding_xs = '';
        $top_padding_xs = $this->opt('top_padding_xs');
        if($top_padding_xs != '170'){
            $tpadding_xs = $top_padding_xs || $top_padding_xs === '0' ? 'padding-top:'.$top_padding_xs.'px;' : '';
        }
        // Bottom padding
        $bpadding_xs = '';
        $bottom_padding_xs = $this->opt('bottom_padding_xs');
        if( $bottom_padding_xs != 0 ){
            $bpadding_xs = $bottom_padding_xs || $bottom_padding_xs === '0' ? 'padding-bottom:'.$bottom_padding_xs.'px;' : '';
        }
        // Top and bottom paddings
        if($tpadding_xs || $bpadding_xs){
            $css_xs .= '.'.$uid.'.page-subheader .ph-content-wrap{'.$tpadding_xs.$bpadding_xs.'}';
        }
        // Subheader height & padding for EXTRA SMALL
        if($css_xs != ''){
            $css .= '@media screen and (max-width:767px) {'.$css_xs.'}';
        }


        return $css;
    }

}

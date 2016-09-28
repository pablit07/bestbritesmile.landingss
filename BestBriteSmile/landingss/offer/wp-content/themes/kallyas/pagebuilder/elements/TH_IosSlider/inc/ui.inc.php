<?php if(!defined('ABSPATH')) { return; }
/*
 * Build and display the element
 */

$options = (isset($GLOBALS['options']['ios_slider']) ? $GLOBALS['options']['ios_slider'] : null);
if(empty($options)){
    return;
}

$classes = array();

// Header styles
if ( isset ( $options['io_header_style'] ) && ! empty ( $options['io_header_style'] ) ) {
    $classes[] = 'uh_' . $options['io_header_style'];
}

// Faded Slider
if ( $this->opt('io_s_fade',0) == 1 ) {
    $classes[] = 'iosslider-faded';
}

// Fixed position
if ( $this->opt('io_s_scroll',0) == 1 ) {
    $classes[] = 'ios-fixed-position-scr';
}

// Fixed width slider
$fluid_start = '';
$fluid_end   = '';
$fixed_width_opt = $this->opt('io_s_width',0);
if ( ! empty ( $fixed_width_opt ) ) {
    $classes[] = 'ios--notpadded';
    $classes[] = 'ios--fixed-width';
    $fluid_start = '<div class="fluidHeight"><div class="container sliderContainer">';
    $fluid_end   = '</div></div>';
}
// Add relative height
$classes[] = $this->opt('io_s_fixdwidth_relative','');

// fullscreen
$fullscreen_opt = $this->opt('io_s_s_fullscreen',0);
$classes[] = $fullscreen_opt == 1 ? 'kl-slider-fullscreen':'';
// bottom mask
$bottom_mask = $this->opt('hm_header_bmasks','none');
$classes[] = $bottom_mask != 'none' ? 'maskcontainer--'.$bottom_mask : '';
// element id
$classes[] = $this->data['uid'];

// Set a custom height class if fullscreen and fixed disabled
if($fullscreen_opt != 1 && $fixed_width_opt != 1){
    $classes[] = 'iosslider--custom-height';
}

$is_screffect = $this->opt('io_s_scrolling_effect',0 ) == 1;
$scr_effect_class = '';
$scr_effect_attribs = '';
$scr_effect_attribs_captions = '';
if( $is_screffect ){
    $classes[] = 'scrollme';
    $scr_effect_class = 'animateme';
    $scr_effect_attribs = ' data-when="span" data-from="0" data-to="0.75" data-translatey="300" data-easing="linear"';
    $scr_effect_attribs_captions = ' data-when="span" data-from="0" data-to="0.75" data-opacity="0.1" data-easing="linear"';
}



?>
<div class="kl-slideshow iosslider-slideshow <?php echo implode(" ", $classes); ?> <?php echo $this->opt('css_class',''); ?>">

    <div class="kl-loader">
        <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
        width="40px" height="40px" viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve">
            <path opacity="0.2" fill="#000" d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946
            s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634
            c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z"/>
            <path fill="#000" d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0
            C22.32,8.481,24.301,9.057,26.013,10.047z">
                <animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 20 20" to="360 20 20" dur="0.5s" repeatCount="indefinite"/>
            </path>
        </svg>
    </div>

    <div class="bgback"></div>
    <div class="th-sparkles"></div>

<?php
echo $fluid_start;

$trans = '5000';
if ( ! empty( $options['io_s_trans'] ) ) {
    $trans = $options['io_s_trans'];
}

$infinite_slide = 'false';
if ( count( $options['single_iosslider'] ) > 1 ) {
    // This will fix the Ios Slider when using only one slide
    $infinite_slide = 'true';
}


?>

<div class="iosSlider kl-slideshow-inner <?php echo $scr_effect_class; ?>" data-trans="<?php echo $trans; ?>" data-autoplay="<?php echo $this->opt('io_s_autoplay','1'); ?>" data-infinite="<?php echo $infinite_slide; ?>" <?php echo $scr_effect_attribs; ?> data-clickdrag="<?php echo $this->opt('io_s_clickdrag','1'); ?>">

    <div class="kl-iosslider">

        <?php
        $thumbs = $bullets = '';
        if ( isset ( $options['single_iosslider'] ) && is_array( $options['single_iosslider'] ) ) {
            $thumbs  = '';
            $bullets = '';
            $i       = 0;
            foreach ( $options['single_iosslider'] as $slide ) {
                if ( $i == 0 ) {
                    $slide_num = 'first selected';
                }
                else {
                    $slide_num = '';
                }

                $c_style = 'style1';
                $c_pos   = '';

                $bullets .= '<div class="item iosslider__bull-item ' . $slide_num . '"></div>';

                echo '<div class="item iosslider__item">';

                $img_link_start = '';
                $img_link_end   = '';

                if ( ! empty ( $slide['io_slide_link']['url'] ) && ! empty( $slide['io_slide_link_image'] ) && $slide['io_slide_link_image'] == 'yes' ) {
                    $img_link_start = '<a class="zn_slide_image_link" data-target="smoothscroll" href="' . $slide['io_slide_link']['url'] . '" target="' . $slide['io_slide_link']['target'] . '">';
                    $img_link_end   = '</a>';
                }

                // Slide type
                 $slideType = isset ( $slide['io_slide_type'] ) && ! empty ( $slide['io_slide_type'] ) ? $slide['io_slide_type'] : 'image' ;

                if($slideType == 'image') {

                    $io_slide_image_vert_pos = 'vertical-pos--'.( (isset($slide['io_slide_image_vert_pos']) && !empty($slide['io_slide_image_vert_pos']) ) ? $slide['io_slide_image_vert_pos'] : 'center');

                    // Slide Image
                    if ( $slide_image = $slide['io_slide_image'] ) {

                        if ( is_array( $slide_image ) ) {
                            $saved_image = $slide_image['image'];
                            if ( ! empty( $slide_image['alt'] ) ) {
                                $saved_alt = 'alt="' . $slide_image['alt'] . '"';
                            }
                            else {
                                $saved_alt = '';
                            }
                            if ( ! empty( $slide_image['title'] ) ) {
                                $saved_title = 'title="' . $slide_image['title'] . '"';
                            }
                            else {
                                $saved_title = '';
                            }
                        }
                        else {
                            $saved_image = $slide_image;
                            $saved_alt   = '';
                            $saved_title = '';
                        }

                        if ( $options['io_s_width'] ) {

                            $image = vt_resize( '', $saved_image, '1170', '', true );

                            // echo $img_link_start . '<img src="' . $image['url'] . '" width="' . $image['width'] .
                            //      '" height="' . $image['height'] . '"  ' . $saved_title . ' ' . $saved_alt . ' />'
                            //      . $img_link_end;
                            echo '<div class="slide-item-bg '.$io_slide_image_vert_pos.'" style="background-image:url(' . $image['url'] . ');"  ' . $saved_title . '>' . $img_link_start
                                 . $img_link_end . '</div>';
                        }
                        else {
                            // echo $img_link_start . '<img src="' . $saved_image . '" ' . $saved_title . ' ' .
                            //      $saved_alt . '/>' . $img_link_end;
                            echo  '<div class="slide-item-bg '.$io_slide_image_vert_pos.'" style="background-image:url(' . $saved_image . ');" ' . $saved_title . ' ' .
                                 '>' . $img_link_start . $img_link_end. '</div>';
                        }

                        if ( isset ( $options['io_s_navigation'] ) && $options['io_s_navigation'] == 'thumbs' ) {

                            $image = vt_resize( '', $saved_image, '150', '60', true );
                            $thumbs .= '<div class="item ' . $slide_num . '"><img src="' . $image['url'] .
                                       '" width="' . $image['width'] . '" height="' . $image['height'] . '" ' .
                                       $saved_title . ' ' . $saved_alt . ' /></div>';
                        }
                    }

                } else if($slideType == 'video_self' || $slideType == 'video_youtube') {

                    // Slide Video
                    echo '
                    <div class="kl-video-container">
                        <div class="kl-video-wrapper video-grid-overlay">
                    ';
                        if($slideType == 'video_self') {
                            echo '
                            <!-- Self Hosted Video Source -->
                            <div
                                class="kl-video valign halign"
                                style="width: 100%; height: 100%;"
                                data-setup=\'{
                                    "position": "absolute",
                                    "loop": '.( isset($slide['io_slide_vd_loop']) && !empty($slide['io_slide_vd_loop']) && $slide['io_slide_vd_loop'] == 'yes' ? 'true' : 'false' ).',
                                    "autoplay": '.(isset($slide['io_slide_vd_autoplay']) && !empty($slide['io_slide_vd_autoplay']) && $slide['io_slide_vd_autoplay'] == 'yes' ? 'true' : 'false' ).',
                                    "muted": '.(isset($slide['io_slide_vd_muted']) && !empty($slide['io_slide_vd_muted']) && $slide['io_slide_vd_muted'] == 'yes' ? 'true' : 'false' ).',
                                    '.(isset($slide['io_slide_vd_self_mp4']) && !empty($slide['io_slide_vd_self_mp4']) ? '"mp4":"'.$slide['io_slide_vd_self_mp4'].'",' : '' ).'
                                    '.(isset($slide['io_slide_vd_self_webm']) && !empty($slide['io_slide_vd_self_webm']) ? '"webm":"'.$slide['io_slide_vd_self_webm'].'",' : '' ).'
                                    '.(isset($slide['io_slide_vd_self_ogg']) && !empty($slide['io_slide_vd_self_ogg']) ? '"ogg":"'.$slide['io_slide_vd_self_ogg'].'",' : '' ).'
                                    '.(isset($slide['io_slide_vd_vp']) && !empty($slide['io_slide_vd_vp']) ? '"fallback_image":"'.$slide['io_slide_vd_vp'].'",' : '' ).'
                                    "video_ratio": "1.7778"
                                }\'
                            ></div>';

                        } elseif($slideType == 'video_youtube') {
                            echo '
                            <!-- Youtube Source -->
                            <div
                                class="kl-video valign halign"
                                style="width: 100%; height: 100%;"
                                data-setup=\'{
                                    "position": "absolute",
                                    "loop": '.(isset($slide['io_slide_vd_loop']) && !empty($slide['io_slide_vd_loop']) && $slide['io_slide_vd_loop'] == 'yes' ? 'true' : 'false' ).',
                                    "autoplay": '.(isset($slide['io_slide_vd_autoplay']) && !empty($slide['io_slide_vd_autoplay']) && $slide['io_slide_vd_autoplay'] == 'yes' ? 'true' : 'false' ).',
                                    "muted": '.(isset($slide['io_slide_vd_muted']) && !empty($slide['io_slide_vd_muted']) && $slide['io_slide_vd_muted'] == 'yes' ? 'true' : 'false' ).',
                                    '.(isset($slide['io_slide_vd_yt']) && !empty($slide['io_slide_vd_yt']) ? '"youtube":"'.$slide['io_slide_vd_yt'].'",' : '' ).'
                                    '.(isset($slide['io_slide_vd_vp']) && !empty($slide['io_slide_vd_vp']) ? '"fallback_image":"'.$slide['io_slide_vd_vp'].'",' : '' ).'
                                    "video_ratio": "1.7778"
                                }\'
                            ></div>';
                        }

                    if(isset($slide['io_slide_vd_controls']) && !empty($slide['io_slide_vd_controls']) && $slide['io_slide_vd_controls'] == 'yes'){
                        echo '
                        <ul class="kl-video--controls" data-position="'.(!empty($slide['io_slide_vd_controls_pos']) ? $slide['io_slide_vd_controls_pos'] : 'bottom-right' ).'">
                            <li><a href="#" class="btn-toggleplay"><i class="kl-icon glyphicon glyphicon-play circled-icon"></i></a></li>
                            <li><a href="#" class="btn-audio"><i class="kl-icon glyphicon glyphicon-volume-up circled-icon ci-xsmall"></i></a></li>
                        </ul>';
                    }
                    echo '
                        </div>
                        <!-- // video-wrapper -->
                    </div>
                    <!-- // video-container -->
                    ';

                }

                // // Slide Overalay
                // if ( isset ( $slide['io_slide_overlay'] ) && ! empty ( $slide['io_slide_overlay'] ) ) {
                //     $overlay_color = $slide['io_slide_overlay_color'] ? $slide['io_slide_overlay_color'] : '#000';
                //     $overlay_opac = $slide['io_slide_overlay_opacity'] ? $slide['io_slide_overlay_opacity'] : '30';
                //     echo '<div class="kl-slide-overlay" style="background-color:'.zn_hex2rgba_str($overlay_color, $overlay_opac).'"></div>';
                // }

                // Overlays
                if ( isset ( $slide['io_slide_overlay'] ) && $slide['io_slide_overlay'] != 0 ) {

                    $overlay_color = $slide['io_slide_overlay_color'];
                    $overlay_opac = $slide['io_slide_overlay_opacity'];

                    $overlay_color_final = zn_hex2rgba_str($overlay_color, $overlay_opac);
                    $ovstyle = 'background-color:'.$overlay_color_final;

                    // Gradient
                    if ( $slide['io_slide_overlay'] == 2 || $slide['io_slide_overlay'] == 3 ) {

                        $gr_overlay_color = $slide['io_slide_overlay_color_gradient'];
                        $overlay_gr_opac = $slide['io_slide_overlay_color_gradient_opac'];

                        $gr_overlay_color_final = zn_hex2rgba_str($gr_overlay_color, $overlay_gr_opac);

                        // Gradient Horizontal
                        if ( $slide['io_slide_overlay'] == 2 ) {
                            $ovstyle = 'background:'.$overlay_color_final.'; background: -moz-linear-gradient(left, '.$overlay_color_final.' 0%, '.$gr_overlay_color_final.' 100%); background: -webkit-gradient(linear, left top, right top, color-stop(0%,'.$overlay_color_final.'), color-stop(100%,'.$gr_overlay_color_final.')); background: -webkit-linear-gradient(left, '.$overlay_color_final.' 0%,'.$gr_overlay_color_final.' 100%); background: -o-linear-gradient(left, '.$overlay_color_final.' 0%,'.$gr_overlay_color_final.' 100%); background: -ms-linear-gradient(left, '.$overlay_color_final.' 0%,'.$gr_overlay_color_final.' 100%); background: linear-gradient(to right, '.$overlay_color_final.' 0%,'.$gr_overlay_color_final.' 100%); ';
                        }

                        // Gradient Vertical
                        if ( $slide['io_slide_overlay'] == 3 ) {
                            $ovstyle = 'background: '.$overlay_color_final.'; background: -moz-linear-gradient(top,  '.$overlay_color_final.' 0%, '.$gr_overlay_color_final.' 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,'.$overlay_color_final.'), color-stop(100%,'.$gr_overlay_color_final.')); background: -webkit-linear-gradient(top,  '.$overlay_color_final.' 0%,'.$gr_overlay_color_final.' 100%); background: -o-linear-gradient(top,  '.$overlay_color_final.' 0%,'.$gr_overlay_color_final.' 100%); background: -ms-linear-gradient(top,  '.$overlay_color_final.' 0%,'.$gr_overlay_color_final.' 100%); background: linear-gradient(to bottom,  '.$overlay_color_final.' 0%,'.$gr_overlay_color_final.' 100%); ';
                        }
                    }
                    echo '<div class="kl-slide-overlay" style="'.$ovstyle.'"></div>';
                }


                $slideCaptionStyle = $slide['io_slide_caption_style'];

                // Slide Caption Style
                if ( isset ( $slideCaptionStyle ) && ! empty ( $slideCaptionStyle ) ) {
                    $c_style = $slideCaptionStyle;
                }

                // Slide Caption Position
                if ( ( isset($slide['io_slide_caption_pos']) && ! empty ($slide['io_slide_caption_pos']) ) ) {
                    $c_pos = $slide['io_slide_caption_pos'];
                    if($c_pos == 'zn_def_anim_pos'){
                        $c_pos = 'fromleft';
                    }
                }

                // Slide Caption Position Vertical
                $c_pos_vert = '';
                if ( isset ( $slide['io_slide_caption_pos_vert'] ) && ! empty ( $slide['io_slide_caption_pos_vert'] ) ) {
                    $c_pos_vert = $slide['io_slide_caption_pos_vert'];
                }

                // Slide Caption Position Vertical
                $c_pos_horiz = '';
                if ( isset ( $slide['io_slide_caption_pos_horiz'] ) && ! empty ( $slide['io_slide_caption_pos_horiz'] ) ) {
                    $c_pos_horiz = $slide['io_slide_caption_pos_horiz'];
                }

                // Bottom fade effect inside slides
                if ( isset ( $options['io_s_fade'] ) && ! empty ( $options['io_s_fade'] ) ) {
                    $fadeColor = '#f5f5f5';
                    if ( isset ( $options['io_s_fade_color'] ) && ! empty ( $options['io_s_fade_color'] ) ) {
                        $fadeColor = $options['io_s_fade_color'];
                    }
                    echo '<div class="fadeMask" style="background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,'.zn_hex2rgba_str($fadeColor, 0).'), color-stop(100%,'.zn_hex2rgba_str($fadeColor, 100).')); background: -webkit-linear-gradient(top,  '.zn_hex2rgba_str($fadeColor, 0).' 0%,'.zn_hex2rgba_str($fadeColor, 100).' 100%); background: -webkit-linear-gradient(top, '.zn_hex2rgba_str($fadeColor, 0).' 0%, '.zn_hex2rgba_str($fadeColor, 100).' 100%); background: linear-gradient(to bottom,  '.zn_hex2rgba_str($fadeColor, 0).' 0%,'.zn_hex2rgba_str($fadeColor, 100).' 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#00'.str_replace('#', '', $fadeColor).'", endColorstr="#ff'.str_replace('#', '', $fadeColor).'",GradientType=0 );"></div>';
                }

                // START SLIDE CAPTIONS
                $safepadding = 'kl-slideshow-safepadding';
                // for the moment disable the padding
                $safepadding = '';
                echo '<div class="container '.$safepadding.' kl-iosslide-caption kl-ioscaption--' . $c_style . ' ' . $c_pos . ' klios-'. $c_pos_horiz.' kl-caption-posv-' . $c_pos_vert . '">';

                if($is_screffect){
                    echo '<div class="'.$scr_effect_class.'" '.$scr_effect_attribs_captions.'>';
                }

                // Slide TOP!! SMALL TITLE (for style5)
                if( $slideCaptionStyle != 'style6' ){
                    if ( isset ( $slide['io_slide_s_title_top'] ) && ! empty ( $slide['io_slide_s_title_top'] ) && $slideCaptionStyle == 'style5' ) {
                        echo '<h4 class="title_small_top">' . $slide['io_slide_s_title_top'] . '</h4>';
                    }
                }

                // Slide Main TITLE
                if ( isset ( $slide['io_slide_m_title'] ) && ! empty ( $slide['io_slide_m_title'] ) ) {
                    $squarebox = isset ( $slide['io_slide_m_title_s5_sqbox'] ) && ! empty ( $slide['io_slide_m_title_s5_sqbox'] ) && $slideCaptionStyle != 'style6' ? '<span class="kl-ios-sqbox"></span>':'';
                    $has_squarebox = isset ( $slide['io_slide_m_title_s5_sqbox'] ) && ! empty ( $slide['io_slide_m_title_s5_sqbox'] ) ? 'kl-ios-has-sqbox':'';
                    $has_titlebig = isset ( $slide['io_slide_b_title'] ) && ! empty ( $slide['io_slide_b_title'] ) ? 'has_titlebig':'';
                    $has_sepline = isset ( $slide['io_slide_sep_line'] ) && ! empty ( $slide['io_slide_sep_line'] ) ? 'has_klios-line':'';
                    echo '<h2 class="main_title '.$has_titlebig.' '.$has_squarebox.' '.$has_sepline.'">'.$squarebox.'<span>' . $slide['io_slide_m_title'] . '</span></h2>';
                }

                if( $slideCaptionStyle != 'style6' ) {

                    // Separator line
                    if ( isset ( $slide['io_slide_sep_line'] ) && ! empty ( $slide['io_slide_sep_line'] ) && $slideCaptionStyle == 'style5' ) {
                        $has_titlebig = isset ( $slide['io_slide_b_title'] ) && ! empty ( $slide['io_slide_b_title'] ) ? 'has_titlebig':'';
                        $has_imageboxes = isset ( $slide['io_slide_imgboxes'] ) && ! empty ( $slide['io_slide_imgboxes'] ) ? 'has_imageboxes':'';
                        echo '<div class="klios-separator-line '.$has_titlebig.' '.$has_imageboxes.'"><div class="klios--inner"><span></span></div></div>';
                    }

                    // Slide SMALL TITLE (for style3 extended only)
                    if ( isset ( $slide['io_slide_s_title'] ) && ! empty ( $slide['io_slide_s_title'] ) && $slideCaptionStyle == 'style3 s3ext' ) {
                        echo '<h4 class="title_small">' . $slide['io_slide_s_title'] . '</h4>';
                    }

                    // Slide BIG TITLE
                    if ( isset ( $slide['io_slide_b_title'] ) && ! empty ( $slide['io_slide_b_title'] ) ) {
                        echo '<h3 class="title_big">' . $slide['io_slide_b_title'] . '</h3>';
                    }

                    $buttons_sizes = isset($slide['io_btn_sizes']) && !empty($slide['io_btn_sizes']) ? $slide['io_btn_sizes'] : '';

                    // Links for style 4
                    if ( ! empty ( $slide['io_slide_link']['url'] ) && ( $slideCaptionStyle == 'style4' || $slideCaptionStyle == 'style4 s4ext' ) ) {
                        $no_titlebig = isset ( $slide['io_slide_b_title'] ) && ! empty ( $slide['io_slide_b_title'] ) ? '':'no_titlebig';
                        echo '<a class="more '.$no_titlebig.'" data-target="smoothscroll" href="' . $slide['io_slide_link']['url'] . '" target="' .
                             $slide['io_slide_link']['target'] . '">'. $slide['io_slide_link']['title'].'</a>';
                    }
                    // Links for Style 5
                    elseif ( $slideCaptionStyle == 'style5' ) {
                        echo '<div class="more">';
                            if(! empty ( $slide['io_slide_link']['url'] ) ){
                                echo '<a class="btn btn-fullcolor '.$buttons_sizes.'" data-target="smoothscroll" href="' . $slide['io_slide_link']['url'] . '" target="' .
                                 $slide['io_slide_link']['target'] . '">'. $slide['io_slide_link']['title'].'</a>';
                             }
                            // Secondary link
                            if ( isset ( $slide['io_slide_link2']['url'] ) && ! empty ( $slide['io_slide_link2']['url'] ) ) {
                                echo '<a class="btn btn-lined '.$buttons_sizes.'" href="' . $slide['io_slide_link2']['url'] . '" target="' .
                                 $slide['io_slide_link2']['target'] . '">'. $slide['io_slide_link2']['title'].'</a>';
                             }
                         echo '</div>';
                    }
                     // Links for style 1 or style 2
                    elseif ( ! empty ( $slide['io_slide_link']['url'] ) && ($slideCaptionStyle == 'style1' || $slideCaptionStyle == 'style2' )) {
                        echo '<a class="more" data-target="smoothscroll" href="' . $slide['io_slide_link']['url'] . '" target="' .
                             $slide['io_slide_link']['target'] . '"><span class="glyphicon glyphicon-chevron-right kl-icon-white more-arrow"></span></a>';
                    }
                    elseif ( ! empty ( $slide['io_slide_link']['url'] ) && $slideCaptionStyle != 'style3' ) {
                        echo '<div class="more">';
                            echo '<a class="btn btn-fullcolor '.$buttons_sizes.'" data-target="smoothscroll" href="' . $slide['io_slide_link']['url'] . '" target="' .
                                 $slide['io_slide_link']['target'] . '">'. $slide['io_slide_link']['title'].'</a>';
                         echo '</div>';
                    }

                }// end check if it's not style6

                // Slide SMALL TITLE
                if ( isset ( $slide['io_slide_s_title'] ) && ! empty ( $slide['io_slide_s_title'] ) && $slideCaptionStyle != 'style3 s3ext' ) {
                    echo '<h4 class="title_small">' . $slide['io_slide_s_title'] . '</h4>';
                }

                // Style 6 (circle play)
                if($slideCaptionStyle == 'style6' && isset ( $slide['io_slide_s6_yt'] ) && ! empty ( $slide['io_slide_s6_yt'] )){
                    $yt_params = '?loop=1&amp;start=0&amp;autoplay=1&amp;controls=0&amp;showinfo=0&amp;wmode=transparent&amp;iv_load_policy=3&amp;modestbranding=1&amp;rel=0';

                    echo '
                    <div class="klios-playvid">
                        <a href="http://www.youtube.com/watch?v='.$slide['io_slide_s6_yt'].$yt_params.'" data-lightbox="youtube">
                            <i class="kl-icon glyphicon glyphicon-play circled-icon ci-large"></i>
                        </a>
                    </div>';
                }

                echo $img_link_start . $img_link_end;

                if($is_screffect){
                    echo '</div>';
                }

                echo '</div>'; // end caption

                if(isset ( $slide['io_slide_imgboxes'] ) && ! empty ( $slide['io_slide_imgboxes']) ) {
                    // Image Boxes
                    echo '
                        <div class="klios-imageboxes '. $c_pos . ' klios-'. $c_pos_horiz .' ' . $c_pos_vert . ' ">
                            <div class="kl-imgbox-inner">
                    ';
                    //  Image box 1
                    if(! empty( $slide['io_slide_imgboxes_i1_src'] ) ){
                        $imgb1 = $slide['io_slide_imgboxes_i1_src'];
                        if ( is_array( $imgb1 ) ) {
                            $ib1 = $imgb1['image'];
                            $ib1_alt = $imgb1['alt'];
                        } else {
                            $ib1 = $imgb1;
                            $ib1_alt = '';
                        }
                        echo '
                        <div class="kl-imgbox kl-imgbox--1">
                            <a href="'.$slide['io_slide_imgboxes_i1_url']['url'].'" title="'.$slide['io_slide_imgboxes_i1_url']['title'].'" class="kl-imgbox--link" style="background-image:url('.$ib1.')">
                                <!-- <img src="'.$ib1.'" alt="'.$ib1_alt.'" class="img-responsive"> -->
                            </a>
                        </div>';
                    }
                    //  Image box 2
                    if(! empty( $slide['io_slide_imgboxes_i2_src']) ){
                        $imgb2 = $slide['io_slide_imgboxes_i2_src'];
                        if ( is_array( $imgb2 ) ) {
                            $ib2 = $imgb2['image'];
                            $ib2_alt = $imgb2['alt'];
                        } else {
                            $ib2 = $imgb2;
                            $ib2_alt = '';
                        }
                        echo '
                        <div class="kl-imgbox kl-imgbox--2">
                            <a href="'.$slide['io_slide_imgboxes_i2_url']['url'].'" title="'.$slide['io_slide_imgboxes_i2_url']['title'].'" class="kl-imgbox--link" style="background-image:url('.$ib2.')">
                                <!-- <img src="'.$ib2.'" alt="'.$ib2_alt.'" class="img-responsive"> -->
                            </a>
                        </div>';
                    }
                    //  Image box 3
                    if(! empty( $slide['io_slide_imgboxes_i3_src']) ){
                        $imgb3 = $slide['io_slide_imgboxes_i3_src'];
                        if ( is_array( $imgb3 ) ) {
                            $ib3 = $imgb3['image'];
                            $ib3_alt = $imgb3['alt'];
                        } else {
                            $ib3 = $imgb3;
                            $ib3_alt = '';
                        }
                        echo '
                        <div class="kl-imgbox kl-imgbox--3">
                            <a href="'.$slide['io_slide_imgboxes_i3_url']['url'].'" title="'.$slide['io_slide_imgboxes_i3_url']['title'].'" class="kl-imgbox--link" style="background-image:url('.$ib3.')">
                                <!-- <img src="'.$ib3.'" alt="'.$ib3_alt.'" class="img-responsive"> -->
                            </a>
                        </div>';
                    }

                    echo '
                            </div>
                        </div>
                    ';
                }
                // end Image Boxes

                echo '</div><!-- end item -->';

                $i ++;
            }
        }
        echo '</div>';


        $kl_nav = '<div class="kl-iosslider-prev"><span class="thin-arrows ta__prev"></span><div class="btn-label">' . __( 'PREV', 'zn_framework' ) . '</div></div>';
        $kl_nav .= '<div class="kl-iosslider-next"><span class="thin-arrows ta__next"></span><div class="btn-label">' . __( 'NEXT', 'zn_framework' ) . '</div></div>';


        if ( count( $options['single_iosslider'] ) > 1 ) {

            if(!$fixed_width_opt){
                echo $kl_nav;
            }

            if ( ! $options['io_s_width'] && $options['io_s_navigation'] == 'thumbs' ) {
                ?>
                <div class="kl-ios-selectors-block thumbs" data-count="">
                    <input type="checkbox" id="thumbTrayButton">
                    <label class="thumbTrayButton" for="thumbTrayButton">
                        <span class="glyphicon glyphicon-minus kl-icon-white"></span>
                        <span class="glyphicon glyphicon-plus kl-icon-white"></span>
                    </label>
                    <div class="selectors">
                        <?php echo $thumbs; ?>
                    </div>
                </div>
            <?php
            }

            echo '</div><!-- end iosSlider -->';

            if ( $options['io_s_width'] || $options['io_s_navigation'] != 'thumbs' ) {
                ?>
                <div class="kl-ios-selectors-block <?php echo $options['io_s_navigation']; ?>">
                    <div class="selectors">
                        <?php echo $bullets; ?>
                    </div>
                </div>
            <?php
            }
        }
        else {
            echo '</div><!-- end iosSlider -->';
        }
        ?>
        <?php if ( $this->opt('io_s_s_fullscreen',0) == 1): ?>
        <a class="tonext-btn js-tonext-btn <?php echo $options['io_s_navigation'] == 'bullets' ? 'has-nav':'' ?>" href="#" data-endof=".kl-slideshow">
            <span class="mouse-anim-icon"></span>
        </a>
        <?php endif; ?>

        <div class="scrollbarContainer"></div>

        <?php echo $fluid_end; ?>

        <?php
            // arrows outside if fixed width slider is enabled
            if($fixed_width_opt){
                echo $kl_nav;
            }
         ?>

        <?php
        if( $this->opt('io_s_navigation','bullets') != 'thumbs' ){
            WpkPageHelper::zn_bottommask_markup($bottom_mask);
        }
        ?>
        <!-- header bottom style -->

    </div>
    <!-- end kl-slideshow -->

    <?php if ( $this->opt('io_s_scroll',0) == 1 ): ?>
    <div class="zn_fixed_slider_fill"></div>
    <?php endif; ?>

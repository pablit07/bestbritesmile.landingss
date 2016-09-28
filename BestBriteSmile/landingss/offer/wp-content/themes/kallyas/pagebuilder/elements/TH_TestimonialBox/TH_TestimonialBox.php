<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Testimonial Box
 Description: Create and display a Testimonial Box element
 Class: TH_TestimonialBox
 Category: content
 Level: 3
*/
/**
 * Class TH_TestimonialBox
 *
 * Create and display a Testimonial Box element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_TestimonialBox extends ZnElements
{
    public static function getName(){
        return __( "Testimonial Box", 'zn_framework' );
    }

    /**
     * Output the inline css to head or after the element in case it is loaded via ajax
     */
    function css(){
        $css = '';
        $uid = $this->data['uid'];
        if( $color = $this->opt('tb_bg_color') ) {
            $css = '
.tb-'.$uid.'[data-align=left] blockquote:after { border-right-color: '. $color .' !important ; }
.tb-'.$uid.'[data-align=right] blockquote:after { border-left-color: '. $color .' !important ; }
.tb-'.$uid.'[data-align=top] blockquote:after { border-bottom-color: '. $color .' !important ; }
.tb-'.$uid.'[data-align=bottom] blockquote:after { border-top-color: '. $color .' !important ; }
            ';
        }
        return $css;
    }

    /**
     * This method is used to display the output of the element.
     * @return void
     */
    function element()
    {
        $options = $this->data['options'];

        $uid = $this->data['uid'];

        $tbStyle = (isset($options['tb_style']) && !empty($options['tb_style']) ? esc_attr($options['tb_style']) : 'style1');
        $cssClass = '';
        $cssRules = '';
        $useBgColor = false;
        $lightQuote = '';
        $fgStyle = (isset($options['tb_fg_style']) && !empty($options['tb_fg_style']) ? esc_attr($options['tb_fg_style']) : 'dark-quote');

        if('style3' == $tbStyle){
            $cssClass = 'tbox-bg';
            $useBgColor = true;
        }

        if($useBgColor && (isset($options['tb_bg_color']) && !empty($options['tb_bg_color']))){
            $cssRules .= 'background: '.$options['tb_bg_color'].';';
        }

        if($fgStyle == 'light-quote'){
            $lightQuote = 'color: #fff;';
        }

        $style = 'light';
        $align = "left";
        if ( $tbStyle == 'style2' ) {
            $style = 'dark';
            $align = "top";
        }
        ?>

            <div class="testimonial_box tb-<?php echo $uid; ?> clearfix <?php echo $cssClass;?> <?php echo $this->opt('css_class',''); ?>" data-align="<?php echo $align;?>" data-theme="<?php echo $style;?>">
                <div class="details">
                    <?php
                    if ( ! empty ( $options['tb_author_logo'] ) ) {
                        $image = vt_resize( '', $options['tb_author_logo'], '60', '60', true );
                        echo '<img src="' . $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" alt="">';
                    }

                    if ( ! empty ( $options['tb_author'] ) || ! empty ( $options['tb_author_com'] ) ) {
                        echo '<h6>';

                        if ( ! empty ( $options['tb_author'] ) ) {
                            echo '<strong>' . $options['tb_author'] . '</strong>';
                        }
                        if ( ! empty ( $options['tb_author_com'] ) ) {
                            echo $options['tb_author_com'];
                        }
                        echo '</h6>';
                    }
                    ?>
                </div>
                <?php
                if ( ! empty ( $options['tb_author_quote'] ) ) {
                    echo '<blockquote style="'.$cssRules.' '.$lightQuote.' ">' . $options['tb_author_quote'] . '</blockquote>';
                }
                ?>
            </div>
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
                        "name"        => __( "Testimonial style", 'zn_framework' ),
                        "description" => __( "Select the desired style for this testimonial element", 'zn_framework' ),
                        "id"          => "tb_style",
                        "type"        => "select",
                        "std"         => "style1",
                        "options"     => array (
                            'style1' => __( 'Style 1', 'zn_framework' ),
                            'style2' => __( 'Style 2', 'zn_framework' ),
                            'style3' => __( 'Style 3 ( from v4.0+ )', 'zn_framework' ),
                        ),
                    ),
                    array (
                        "name"        => __( "Background Color", 'zn_framework' ),
                        "description" => __( "Here you can choose the background color for this element.", 'zn_framework' ),
                        "id"          => "tb_bg_color",
                        "std"         => '',
                        "type"        => "colorpicker",
                        'dependency'  => array('element' => 'tb_style', 'value' => array('style3')),
                    ),
                    array (
                        "name"        => __( "Quote style", 'zn_framework' ),
                        "description" => __( "Select the desired style for quotes", 'zn_framework' ),
                        "id"          => "tb_fg_style",
                        "type"        => "select",
                        "std"         => "dark-quote",
                        "options"     => array (
                            'dark-quote'  => __( 'Dark Quote', 'zn_framework' ),
                            'light-quote' => __( 'Light Quote', 'zn_framework' ),
                        ),
                        'dependency'  => array('element' => 'tb_style', 'value' => array('style3')),
                    ),
                    array (
                        "name"        => __( "Author", 'zn_framework' ),
                        "description" => __( "Please enter the quote author name", 'zn_framework' ),
                        "id"          => "tb_author",
                        "std"         => "",
                        "type"        => "text",
                    ),
                    array (
                        "name"        => __( "Author Company", 'zn_framework' ),
                        "description" => __( "Please enter the quote author company/function", 'zn_framework' ),
                        "id"          => "tb_author_com",
                        "std"         => "",
                        "type"        => "text",
                    ),
                    array (
                        "name"        => __( "Author Quote", 'zn_framework' ),
                        "description" => __( "Please enter the quote for this author", 'zn_framework' ),
                        "id"          => "tb_author_quote",
                        "std"         => "",
                        "type"        => "textarea",
                    ),
                    array (
                        "name"        => __( "Author logo", 'zn_framework' ),
                        "description" => __( "Please select a logo for this author.", 'zn_framework' ),
                        "id"          => "tb_author_logo",
                        "std"         => "",
                        "type"        => "media",
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#LmhkFB2frSM" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/testimonial-box/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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

<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Title Element
 Description: Create and display a title and or subtitle
 Class: TH_TitleElement
 Category: content
 Level: 3
*/
/**
 * Class TH_TitleElement
 *
 * Create and display a Title  element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_TitleElement extends ZnElements
{
    public static function getName(){
        return __( "Title Element", 'zn_framework' );
    }

    /**
     * Output the inline css to head or after the element in case it is loaded via ajax
     */
    function css(){

        $uid = $this->data['uid'];
        $css = '';

        $top_padding = $this->opt('top_padding');
        $tpadding = $top_padding != '0' ? 'padding-top:'.$top_padding.'px;' : '';

        $bottom_padding = $this->opt('bottom_padding');
        $bpadding = $bottom_padding != '35' ? 'padding-bottom:'.$bottom_padding.'px;' : '';

        if ( !empty($tpadding) || !empty($bpadding) )
        {
            $css .= '.'.$uid.'{';
            $css .= $tpadding;
            $css .= $bpadding;
            $css .= '}';
        }

        // Title Styles
        $title_styles = '';
        $title_typo = $this->opt('title_typo');
        if( is_array($title_typo) && !empty($title_typo) ){
            foreach ($title_typo as $key => $value) {
                if($key == 'font-size' && $value != '24px') {
                    $title_styles .= 'font-size:'. $value.';';
                }
                if($key == 'font-family' && $value != 'Open Sans') {
                    $title_styles .= 'font-family:'. $value.';';
                }
                if($key == 'line-height' && $value != '30px') {
                    $title_styles .= 'line-height:'. $value.';';
                }
                if($key == 'font-style' && $value != 'normal') {
                    $title_styles .= 'font-style:'. $value.';';
                }
                if($key == 'font-weight' && $value != '400') {
                    $title_styles .= 'font-weight:'. $value.';';
                }
                if($key == 'color' && $value != '') {
                    $title_styles .= 'color:'. $value.';';
                }
            }
            if(!empty($title_styles)){
                $css .= '.'.$uid.' .tbk__title{'.$title_styles.'}';
            }
        }
        // Subtitle styles
        $subtitle_styles = '';
        $subtitle_typo = $this->opt('subtitle_typo');
        if( is_array($subtitle_typo) && !empty($subtitle_typo) ){
            foreach ($subtitle_typo as $key => $value) {
                if($key == 'font-size' && $value != '20px') {
                    $subtitle_styles .= 'font-size:'. $value.';';
                }
                if($key == 'font-family' && $value != 'Open Sans') {
                    $subtitle_styles .= 'font-family:'. $value.';';
                }
                if($key == 'line-height' && $value != '26px') {
                    $subtitle_styles .= 'line-height:'. $value.';';
                }
                if($key == 'font-style' && $value != 'normal') {
                    $subtitle_styles .= 'font-style:'. $value.';';
                }
                if($key == 'font-weight' && $value != '400') {
                    $subtitle_styles .= 'font-weight:'. $value.';';
                }
                if($key == 'color' && $value != '') {
                    $subtitle_styles .= 'color:'. $value.';';
                }
            }
            if(!empty($subtitle_styles)){
                $css .= '.'.$uid.' .tbk__subtitle{'.$subtitle_styles.'}';
            }
        }
        // icon size
        $icon_size = $this->opt('icon_size') || $this->opt('icon_size') === '0' ? 'font-size:'.$this->opt('icon_size').'px;' : 'font-size:28px;';
        $css .= ".$uid .tbk__icon { $icon_size }";

        // symbol color
        if($this->opt('te_symbol_color', 'default') == 'theme') {
            $custom_color = $this->opt('te_symbol_custom_color', '#cd2122');
            $symbol = $this->opt('te_symbol');

            if( !empty($symbol) ){
                if($symbol == 'icon') {
                    $css .= '.'.$uid.'.tbk--colored .tbk__icon {color:'.$custom_color.';}';

                } elseif($symbol == 'line' || $symbol == 'line_border' || $symbol == 'border') {
                    $css .= '.'.$uid.'.tbk--colored .tbk__symbol span {background-color:'.$custom_color.';}';

                } elseif($symbol == 'border2') {
                    $css .= '.'.$uid.'.tbk--colored .tbk__border-helper {border-bottom-color:'.$custom_color.';}';
                }
            }
        }


        return $css;
    }
    /**
     * This method is used to display the output of the element.
     *
     * @return void
     */
    function element()
    {

        if( empty( $this->data['options'] ) ) { return; }

        $symbol = '';
        $te_symbol = $this->opt('te_symbol');
        $symbol_pos = $this->opt('te_symbol_pos', 'after-title');

        $symbol_color = $this->opt('te_symbol_color', 'default') == 'theme' ? 'tbk--colored' : '';

        if( !empty($te_symbol) ) {
            $symbol .= '<span class="tbk__symbol ">';

            $iconHolder = $this->opt('te_symbol_icon');
            if( $te_symbol == 'icon' && !empty( $iconHolder['family'] ) ){
                $symbol .=  '<span class="tbk__icon" '.zn_generate_icon( $this->opt('te_symbol_icon') ).'></span>';
            } else {
                $symbol .=  '<span></span>';
            }


            $symbol .= '</span>';
        }

        $classes = array();
        $classes[] = 'tbk--text-'.$this->opt('te_color_theme','default');
        $classes[] = 'tbk--'.$this->opt('te_alignment', 'center');
        $classes[] = 'text-'.$this->opt('te_alignment', 'center');
        $classes[] = 'tbk-symbol--'.$te_symbol;
        $classes[] = $symbol_color;
        $classes[] = 'tbk-icon-pos--'.$symbol_pos;
        $classes[] = $this->data['uid'];

        echo '<div class="kl-title-block clearfix '.implode(' ', $classes).' '.$this->opt('css_class','').'">';

            if( $symbol_pos == 'before-title'  )  echo $symbol;

            if($te_title = $this->opt('te_title')) {

                $brd2_start = '';
                $brd2_end = '';
                if(!empty($te_symbol) && $te_symbol == 'border2'){
                    $brd2_start = '<span class="tbk__border-helper">';
                    $brd2_end = '</span>';
                }

                $title_heading = $this->opt('te_tt_heading','3');
                echo '<h'.$title_heading.' class="tbk__title ">';

                    if( $symbol_pos == 'left-title' && $te_symbol == 'icon' )  echo $symbol;

                    echo $brd2_start;
                        echo do_shortcode($te_title);
                    echo $brd2_end;

                echo '</h'.$title_heading.'>';
            }

            // In case there's no icon and symbol placement is left, place the
            // symbol (whatever it is) after the title
            if( $symbol_pos == 'after-title' || ( $symbol_pos == 'left-title' && $te_symbol != 'icon' ) )  {
                echo $symbol;
            }

            if($te_subtitle = $this->opt('te_subtitle')) {
                echo '<h4 class="tbk__subtitle">'.do_shortcode($te_subtitle).'</h4>';
            }

            if( $symbol_pos == 'after-subtitle' )  echo $symbol;

            if($te_text = $this->opt('te_text')) {
                echo '<div class="tbk__text">';
                $content = wpautop( $te_text );
                if ( ! empty ( $te_text ) ) {
                    if ( preg_match( '%(<[^>]*>.*?</)%i', $content, $regs ) ) {
                        echo do_shortcode( $content );
                    }
                    else {
                        echo '<p>' . do_shortcode( $content ) . '</p>';
                    }
                }
                echo '</div>';
            }

            if( $symbol_pos == 'after-text' )  echo $symbol;

        echo '</div>';
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
                        "description" => __( "Add the title. Shorcodes and HTML code allowed", 'zn_framework' ),
                        "id"          => "te_title",
                        "std"         => "",
                        "type"        => "textarea",
                    ),

                    array (
                        "name"        => __( "Sub Title", 'zn_framework' ),
                        "description" => __( "Add a sub-title. Shorcodes and HTML code allowed", 'zn_framework' ),
                        "id"          => "te_subtitle",
                        "std"         => "",
                        "type"        => "textarea",
                    ),


                    array (
                        "name"        => __( "Alignment", 'zn_framework' ),
                        "description" => __( "Select the alignment", 'zn_framework' ),
                        "id"          => "te_alignment",
                        "std"         => "center",
                        "type"        => "select",
                        "options"     => array(
                            "center" => "Center",
                            "left" => "Left",
                            "right" => "Right"
                        )
                    ),

                    array (
                        "name"        => __( "Text color theme", 'zn_framework' ),
                        "description" => __( "Select a theme text color. In case you have a dark background you most definitely want a light colored text", 'zn_framework' ),
                        "id"          => "te_color_theme",
                        "std"         => "default",
                        "type"        => "select",
                        "options"     => array(
                            "light" => "Light Colors",
                            "dark" => "Dark Colors",
                            "default" => "Page/Element default, colors inherited"
                        )
                    ),

                    array(
                        'id'          => 'top_padding',
                        'name'        => 'Top padding',
                        'description' => 'Select the top padding ( in pixels ) for this section.',
                        'type'        => 'slider',
                        'std'         => '0',
                        'class'       => 'zn_full',
                        'helpers'     => array(
                            'min' => '0',
                            'max' => '400',
                            'step' => '1'
                        ),
                        'live' => array(
                            'type'      => 'css',
                            'css_class' => '.'.$this->data['uid'],
                            'css_rule'  => 'padding-top',
                            'unit'      => 'px'
                        )
                    ),
                    array(
                        'id'          => 'bottom_padding',
                        'name'        => 'Bottom padding',
                        'description' => 'Select the bottom padding ( in pixels ) for this section.',
                        'type'        => 'slider',
                        'std'         => '35',
                        'class'       => 'zn_full',
                        'helpers'     => array(
                            'min' => '0',
                            'max' => '400',
                            'step' => '1'
                        ),
                        'live' => array(
                            'type'      => 'css',
                            'css_class' => '.'.$this->data['uid'],
                            'css_rule'  => 'padding-bottom',
                            'unit'      => 'px'
                        )
                    ),
                )
            ),
            'symbol' => array(
                'title' => 'Symbol options',
                'options' => array(
                    array (
                        "name"        => __( "Add a symbol?", 'zn_framework' ),
                        "description" => __( "Add any symbol?.", 'zn_framework' ),
                        "id"          => "te_symbol",
                        "std"         => "",
                        "type"        => "select",
                        "options"     => array(
                                "" => "None",
                                "line" => "Small line (50px x 3px)",
                                "border" => "Long bottom border",
                                "border2" => "Long Thicker bottom border (with thicker border for title)",
                                "line_border" => "Small line + Bottom Border",
                                "icon" => "Icon",
                            )
                    ),
                    array (
                        "name"        => __( "Symbol Color", 'zn_framework' ),
                        "description" => __( "Select symbol color.", 'zn_framework' ),
                        "id"          => "te_symbol_color",
                        "std"         => "default",
                        "type"        => "select",
                        "options"     => array(
                                "default" => "Default color",
                                "theme" => "Custom color"
                        ),
                        // "dependency"  => array( 'element' => 'te_symbol' , 'value'=> array('line', 'line_border', 'icon') )
                    ),


                    array (
                        "name"        => __( "Symbol Custom Color", 'zn_framework' ),
                        "description" => __( "Select symbol color.", 'zn_framework' ),
                        "id"          => "te_symbol_custom_color",
                        "std"         => "#cd2122",
                        "type"        => "colorpicker",
                        "dependency"  => array( 'element' => 'te_symbol_color' , 'value'=> array('theme') )
                    ),

                    array (
                        "name"        => __( "Icon", 'zn_framework' ),
                        "description" => __( "Add icon.", 'zn_framework' ),
                        "id"          => "te_symbol_icon",
                        "std"         => "",
                        "type"        => "icon_list",
                        'class'       => 'zn_full',
                        "dependency"  => array( 'element' => 'te_symbol' , 'value'=> array('icon') )
                    ),

                    array(
                        'id'          => 'icon_size',
                        'name'        => 'Icon Size',
                        'description' => 'Select the icon size in px.',
                        'type'        => 'slider',
                        'std'         => '28',
                        'class'       => 'zn_full',
                        'helpers'     => array(
                            'min' => '14',
                            'max' => '80',
                            'step' => '2'
                        ),
                        "dependency"  => array( 'element' => 'te_symbol' , 'value'=> array('icon') ),
                        'live' => array(
                            'type'      => 'css',
                            'css_class' => '.'.$this->data['uid'].' .tbk__icon',
                            'css_rule'  => 'font-size',
                            'unit'      => 'px'
                        )
                    ),

                    array (
                        "name"        => __( "Symbol position", 'zn_framework' ),
                        "description" => __( "Select the symbol's position.", 'zn_framework' ),
                        "id"          => "te_symbol_pos",
                        "std"         => "after-title",
                        "type"        => "select",
                        "options"     => array(
                                "before-title" => "Before title",
                                "after-title" => "After title",
                                "after-subtitle" => "After sub-title",
                                "after-text" => "After Text",
                                "left-title" => "Inline, in title's left side (Icon only!)",
                        ),
                        "dependency"  => array( 'element' => 'te_symbol' , 'value'=> array('line', 'border', 'line_border', 'icon') ),
                    ),

                )
            ),

            'text' => array(
                'title' => 'Description text',
                'options' => array(
                    array (
                        "name"        => __( "Some text maybe?", 'zn_framework' ),
                        "description" => __( "Add a text paragraph.", 'zn_framework' ),
                        "id"          => "te_text",
                        "std"         => "",
                        "type"        => "visual_editor",
                    ),
                )
            ),

            'font' => array(
                'title' => 'Font settings',
                'options' => array(

                    array (
                        "name"        => __( "Title Heading", 'zn_framework' ),
                        "description" => __( "Select a title heading. The title will be wrapped in this tag", 'zn_framework' ),
                        "id"          => "te_tt_heading",
                        "std"         => "3",
                        "type"        => "select",
                        "options"     => array(
                                "1" => "H1",
                                "2" => "H2",
                                "3" => "H3",
                                "4" => "H4",
                                "5" => "H5",
                                "6" => "H6"
                            )
                    ),

                    array (
                        "name"        => __( "Title settings", 'zn_framework' ),
                        "description" => __( "Specify the typography properties for the title.", 'zn_framework' ),
                        "id"          => "title_typo",
                        "std"         => array (
                            'font-size'   => '24px',
                            'font-family'   => 'Open Sans',
                            'line-height' => '30px',
                            'color'  => '',
                            'font-style' => 'normal',
                            'font-weight' => '400',
                        ),
                        'supports'   => array( 'size', 'font', 'style', 'line', 'color', 'weight' ),
                        "type"        => "font",
                    ),

                    array (
                        "name"        => __( "Sub-Title settings", 'zn_framework' ),
                        "description" => __( "Specify the typography properties for the sub-title.", 'zn_framework' ),
                        "id"          => "subtitle_typo",
                        "std"         => array (
                            'font-size'   => '20px',
                            'font-family'   => 'Open Sans',
                            'line-height' => '26px',
                            'color'  => '',
                            'font-style' => 'normal',
                            'font-weight' => '400',
                        ),
                        'supports'   => array( 'size', 'font', 'style', 'line', 'color', 'weight' ),
                        "type"        => "font",
                    ),

                )
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#aBpgvHl6g6I" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/title-element/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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
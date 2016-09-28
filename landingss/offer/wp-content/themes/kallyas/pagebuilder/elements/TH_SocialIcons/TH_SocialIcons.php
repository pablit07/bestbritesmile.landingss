<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Social Icons List
 Description: Create and display as many social icon links as you want
 Class: TH_SocialIcons
 Category: content
 Level: 3
*/
/**
 * Class TH_SocialIcons
 *
 * Create and display as many social icon links as you want
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.8
 */
class TH_SocialIcons extends ZnElements
{
    public static function getName(){
        return __( "Social Icons List", 'zn_framework' );
    }


    /**
     * Output the inline css to head or after the element in case it is loaded via ajax
     */
    function css(){
        $css = '';
        $icon_css = '';
        $uid = $this->data['uid'];

        // icon_distance
        $icon_distance = $this->opt('icon_distance','3');
        if( $icon_distance != '3' ){
            $css .= '.'.$uid.' .elm-social-icons>li{margin-left: '.$icon_distance.'px;margin-right:'.$icon_distance.'px}';
        }

        // Icon sizes
        $icon_size = $this->opt('sc_size','14');
        if( $icon_size != '14'){
            $icon_css .= 'font-size:'.$icon_size.'px;';
        }
        // Icon Padding
        $icon_padding = $this->opt('icon_padding','30');
        if( $icon_padding != '30' ){
            $icon_css .= 'padding:'.$icon_padding.'px';
        }
        if(!empty($icon_css)){
            $css .= '.'.$uid.' .elm-sc-icon {'.$icon_css.'}';
        }

        $sicons = $this->opt('single_sc');
        $sc_style = $this->opt('sc_style','normal');

        if( is_array($sicons) && !empty( $sicons ) ){
            foreach ( $sicons as $k => $icon ) {
                $color_css = '';
                $icon_tcolor = $icon['sc_icon_textcolor'];
                if( $icon_tcolor != '#ffffff' && $sc_style != 'normal'){
                    $color_css .= 'color:'.$icon_tcolor.';';
                }
                $icon_bgcolor = $icon['sc_icon_color'];
                if( $icon_bgcolor != '#000000' && $sc_style != 'clean' && $sc_style != 'normal' ){
                    $color_css .= 'background-color:'.$icon_bgcolor.';';
                }
                if(!empty($color_css)){
                    $css .= '.'.$uid.' .sc--'.$sc_style.' .elm-sc-icon-'.$k.($sc_style == 'colored_hov' ? ':hover':'').'{'.$color_css.'}';
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

        echo '<div class="elm-socialicons '.$this->data['uid'].' text-'.$this->opt('el_alignment','left').' '.$this->opt('css_class','').'">';

            $sicons = $this->opt('single_sc');
            $sc_style = $this->opt('sc_style','normal');

            if( is_array($sicons) && !empty( $sicons ) ){

                echo '<ul class="elm-social-icons sc--'.$sc_style.' sh--'.$this->opt('sc_shape','rounded').' clearfix">';

                    foreach ( $sicons as $k => $icon ) {

                        $link = '';
                        $target = '';
                        if ( isset ( $icon['sc_icon_link'] ) && is_array( $icon['sc_icon_link'] ) ) {
                            $link = $icon['sc_icon_link']['url'];
                            $target = 'target="' . $icon['sc_icon_link']['target'] . '"';
                        }
                        $icon_color = '';
                        if($sc_style != 'normal' && $sc_style != 'clean'){
                            $icon_color = isset($icon['sc_icon_color']) && !empty($icon['sc_icon_color']) ? $icon['sc_icon_icon']['unicode'] : 'nocolor';
                        }

                        echo '<li>';
                            if( !empty( $icon['sc_icon_icon'] ) ) {
                                echo '<a href="' . $link . '" '.zn_generate_icon( $icon['sc_icon_icon'] ).' ' . $target . ' class="elm-sc-icon elm-sc-icon-'.$k.'" title="' . $icon['sc_icon_title'] . '"></a>';
                            }
                        echo '</li>';
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
        $uid = $this->data['uid'];

        $options = array(
            'has_tabs'  => true,
            'general' => array(
                'title' => 'General options',
                'options' => array(
                    array (
                        "name"        => __( "Element Alignment", 'zn_framework' ),
                        "description" => __( "Please select the alignment of the button/s.", 'zn_framework' ),
                        "id"          => "el_alignment",
                        "std"         => "left",
                        "options"     => array (
                            'left' => __( 'Left (default)', 'zn_framework' ),
                            'right'          => __( 'Right', 'zn_framework' ),
                            'center'          => __( 'Center', 'zn_framework' )
                        ),
                        "type"        => "select",
                        'live' => array(
                           'type'           => 'class',
                           'css_class'      => '.'.$uid,
                           'val_prepend'   => 'text-',
                        ),
                    ),

                    array (
                        "name"        => __( "Social icons style", 'zn_framework' ),
                        "description" => __( "Select the style of the social icons.", 'zn_framework' ),
                        "id"          => "sc_style",
                        "std"         => "normal",
                        "options"     => array (
                            'normal'  => __( 'Normal Icons', 'zn_framework' ),
                            'colored' => __( 'Colored icons', 'zn_framework' ),
                            'colored_hov' => __( 'Colored on Hover icons', 'zn_framework' ),
                            'clean' => __( 'Clean icons', 'zn_framework' )
                        ),
                        "type"        => "select",
                        'live' => array(
                           'type'           => 'class',
                           'css_class'      => '.'.$uid.' .elm-social-icons',
                           'val_prepend'   => 'sc--',
                        ),
                    ),

                    array (
                        "name"        => __( "Social Icons Shape", 'zn_framework' ),
                        "description" => __( "Select the shape of the social icons.", 'zn_framework' ),
                        "id"          => "sc_shape",
                        "std"         => "rounded",
                        "options"     => array (
                            'rounded'  => __( 'Rounded Square', 'zn_framework' ),
                            'square' => __( 'Square', 'zn_framework' ),
                            'circle' => __( 'Circle', 'zn_framework' ),
                            'special1' => __( 'Special shaped (needs bigger padding)', 'zn_framework' )
                        ),
                        "type"        => "select",
                        'live' => array(
                           'type'           => 'class',
                           'css_class'      => '.'.$uid.' .elm-social-icons',
                           'val_prepend'   => 'sh--',
                        ),
                    ),

                    array (
                        "name"        => __( "Social icons Font-size", 'zn_framework' ),
                        "description" => __( "Select the size of the social icons.", 'zn_framework' ),
                        "id"          => "sc_size",
                        "std"         => "14",
                        "type"         => "slider",
                        'helpers'     => array(
                            'min' => '10',
                            'max' => '100',
                            'step' => '1'
                        ),
                        'live' => array(
                            'type'      => 'css',
                            'css_class' => '.'.$uid.' .elm-sc-icon',
                            'css_rule'  => 'font-size',
                            'unit'      => 'px'
                        ),
                    ),

                    array (
                        "name"        => __( "Social icons padding inside", 'zn_framework' ),
                        "description" => __( "Select the size of the social icons.", 'zn_framework' ),
                        "id"          => "icon_padding",
                        "std"         => "30",
                        "type"         => "slider",
                        'helpers'     => array(
                            'min' => '0',
                            'max' => '200',
                            'step' => '1'
                        ),
                        'live' => array(
                            'type'      => 'css',
                            'css_class' => '.'.$uid.' .elm-sc-icon',
                            'css_rule'  => 'padding',
                            'unit'      => 'px'
                        ),
                    ),

                    array (
                        "name"        => __( "Social icons Distance (horizontal)", 'zn_framework' ),
                        "description" => __( "Select the distance between the social icons.", 'zn_framework' ),
                        "id"          => "icon_distance",
                        "std"         => "3",
                        "type"         => "slider",
                        'helpers'     => array(
                            'min' => '0',
                            'max' => '300',
                            'step' => '1'
                        ),
                        'live' => array(
                            'multiple' => array(
                                array(
                                    'type'      => 'css',
                                    'css_class' => '.'.$uid.' .elm-social-icons>li',
                                    'css_rule'  => 'margin-left',
                                    'unit'      => 'px'
                                ),
                                array(
                                    'type'      => 'css',
                                    'css_class' => '.'.$uid.' .elm-social-icons>li',
                                    'css_rule'  => 'margin-right',
                                    'unit'      => 'px'
                                ),
                            )
                        ),
                    ),

                    array(
                        "name"           => __( "Social Icons", 'zn_framework' ),
                        "description"    => __( "Add Social Icons.", 'zn_framework' ),
                        "id"             => "single_sc",
                        "std"            => "",
                        "type"           => "group",
                        "add_text"       => __( "Social Icon", 'zn_framework' ),
                        "remove_text"    => __( "Social Icon", 'zn_framework' ),
                        "group_sortable" => true,
                        "element_title" => "sc_icon_title",
                        "subelements"    => array (

                            array (
                                "name"        => __( "Icon title", 'zn_framework' ),
                                "description" => __( "Here you can enter a title for this social icon.Please note that this is just
                                    for your information as this text will not be visible on the site.", 'zn_framework' ),
                                "id"          => "sc_icon_title",
                                "std"         => "",
                                "type"        => "text"
                            ),
                            array (
                                "name"        => __( "Social icon link", 'zn_framework' ),
                                "description" => __( "Please enter your desired link for the social icon. If this field is left
                                    blank, the icon will not be linked.", 'zn_framework' ),
                                "id"          => "sc_icon_link",
                                "std"         => "",
                                "type"        => "link",
                                "options"     => array (
                                    '_blank' => __( "New window", 'zn_framework' ),
                                    '_self'  => __( "Same window", 'zn_framework' )
                                )
                            ),
                            array (
                                "name"        => __( "Social icon Background color", 'zn_framework' ),
                                "description" => __( "Select a background color for the icon (if you selected <strong>Colored</strong> or <strong>Colored on hover</strong> options)", 'zn_framework' ),
                                "id"          => "sc_icon_color",
                                "std"         => "#000000",
                                "type"        => "colorpicker"
                            ),
                            array (
                                "name"        => __( "Social icon color", 'zn_framework' ),
                                "description" => __( "Select a color for the icon", 'zn_framework' ),
                                "id"          => "sc_icon_textcolor",
                                "std"         => "#ffffff",
                                "type"        => "colorpicker"
                            ),
                            array (
                                "name"        => __( "Social icon", 'zn_framework' ),
                                "description" => __( "Select your desired social icon.", 'zn_framework' ),
                                "id"          => "sc_icon_icon",
                                "std"         => "",
                                "type"        => "icon_list",
                                'class'       => 'zn_full'
                            ),
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

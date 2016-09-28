<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Text Box
 Description: Create and display a Text Box element
 Class: TH_TextBox
 Category: content
 Level: 3
*/

/**
 * Class TH_TextBox
 *
 * Create and display a Text Box element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_TextBox extends ZnElements
{
    public static function getName(){
        return __( "Text Box", 'zn_framework' );
    }

    /**
     * Output the inline css to head or after the element in case it is loaded via ajax
     */
    function css(){

        //print_z($this);
        $uid = $this->data['uid'];
        $css = '';

        $top_padding = $this->opt('top_padding');
        if($top_padding != '0'){
            $tpadding = $top_padding || $top_padding === '0' ? 'padding-top : '.$top_padding.'px;' : '';
            $css .= '.'.$uid.'{'.$tpadding.'}';
        }

        $bottom_padding = $this->opt('bottom_padding');
        if($bottom_padding != '20'){
            $bpadding = $bottom_padding || $bottom_padding === '0' ? 'padding-bottom:'.$bottom_padding.'px;' : '';
            $css .= '.'.$uid.'{'.$bpadding.'}';
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
        $stb_title_heading = $this->opt( 'stb_title_heading', 'h3' );

        if( empty( $options ) ) { return; }

        echo '<div class="zn_text_box '.$this->data['uid'].' '.$this->opt('css_class','').'">';


        $style = !empty( $options['stb_style'] ) ? $options['stb_style'] : '';
        if ( ! empty( $options['stb_title'] )  ) {
            echo '<'.$stb_title_heading.' class="zn_text_box-title zn_text_box-title--'.$style.'">' . $options['stb_title'] . '</'.$stb_title_heading.'>';
        }

        $stb_content = $this->opt('stb_content','');

        $content = wpautop( $stb_content );

        if ( ! empty ( $stb_content ) ) {
                echo $content;
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
                'title' => 'Content',
                'options' => array(
                    array (
                        "name"        => __( "Content", 'zn_framework' ),
                        "description" => __( "Please enter the box content", 'zn_framework' ),
                        "id"          => "stb_content",
                        "std"         => "",
                        "type"        => "visual_editor",
                        "class"        => "zn_full",
                    ),
                )
            ),
            'title' => array(
                'title' => 'Title settings',
                'options' => array(
                    array (
                        "name"        => __( "Title", 'zn_framework' ),
                        "description" => __( "Please enter the title for this box", 'zn_framework' ),
                        "id"          => "stb_title",
                        "std"         => "",
                        "type"        => "text",
                    ),
                    array (
                        "name"        => __( "Title heading", 'zn_framework' ),
                        "description" => __( "Select the desired heading type you want to use for the title", 'zn_framework' ),
                        "id"          => "stb_title_heading",
                        "std"         => "h3",
                        "type"        => "select",
                        "options"     => array(
                            'h1' => 'H1',
                            'h2' => 'H2',
                            'h3' => 'H3',
                            'h4' => 'H4',
                            'h5' => 'H5',
                            'h6' => 'H6',
                        ),
                    ),
                    array (
                        "name"        => __( "Title style", 'zn_framework' ),
                        "description" => __( "Select the desired style for the title of this
                                            box", 'zn_framework' ),
                        "id"          => "stb_style",
                        "type"        => "select",
                        "std"         => "style1",
                        "options"     => array (
                            'style1' => __( 'Style 1', 'zn_framework' ),
                            'style2' => __( 'Style 2', 'zn_framework' )
                        ),
                        'live' => array(
                           'type'        => 'class',
                           'css_class' => '.'.$this->data['uid'].' .zn_text_box-title',
                           'val_prepend'   => 'zn_text_box-title--',
                        )
                    ),
                )
            ),
            'padding' => array(
                'title' => 'Padding options',
                'options' => array(

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
                            'step' => '5'
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
                        'std'         => '20',
                        'class'       => 'zn_full',
                        'helpers'     => array(
                            'min' => '0',
                            'max' => '400',
                            'step' => '5'
                        ),
                        'live' => array(
                            'type'      => 'css',
                            'css_class' => '.'.$this->data['uid'],
                            'css_rule'  => 'padding-bottom',
                            'unit'      => 'px'
                        )
                    )
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#_ModlDp5ghI" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/text-box/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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

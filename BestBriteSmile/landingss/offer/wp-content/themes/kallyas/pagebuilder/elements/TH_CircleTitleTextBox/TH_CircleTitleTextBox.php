<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Circle Title Text Box
 Description: Create and display a Circle Title Text Box element
 Class: TH_CircleTitleTextBox
 Category: content
 Level: 3
*/
class TH_CircleTitleTextBox extends ZnElements
{
    public static function getName(){
        return __( "Circle Title Text Box", 'zn_framework' );
    }

    /**
     * Output the inline css to head or after the element in case it is loaded via ajax
     */
    function css(){
        $css = '';
        $uid = $this->data['uid'];

        $ctb_circle_bgcolor = $this->opt( 'ctb_circle_bgcolor', '#cd2122' );
        if($ctb_circle_bgcolor != '#cd2122'){
            $css .= '.'.$uid.':not(.style3) .wpk-circle-span:after, .'.$uid.'.circle-text-box.style2 .wpk-circle-span::before, .'.$uid.'.circle-text-box.style3 .wpk-circle-span {background-color:'.$ctb_circle_bgcolor.'} ';
        }

        $ctb_circle_textcolor = $this->opt('ctb_circle_textcolor', '#ffffff' );
        if($ctb_circle_textcolor != '#ffffff'){
            $css .= '.'.$uid.' .wpk-circle-span {color:'.$ctb_circle_textcolor.'} ';
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

        $c_title      = '';

        echo '<div class="circle-text-box '. $this->opt( 'cttb_style', 'style1' ) .' '.$this->data['uid'].' '.$this->opt('css_class','').'">';
            echo '<div class="circle-headline">';

                // TITLE 1
                if ( ! empty ( $options['ctb_circle_title'] ) ) {
                    $c_title = '<span class="wpk-circle-span"><span>' . $options['ctb_circle_title'] . '</span></span> ';
                }
                // TITLE 2
                if ( ! empty ( $options['ctb_main_title'] ) ) {
                    echo  $c_title. '<h4 class="wpk-circle-title">' . $options['ctb_main_title'] .'</h4>';
                }
            echo '</div>';
            // CONTENT
            if ( ! empty ( $options['ctb_content'] ) ) {
                echo wpautop(do_shortcode( $options['ctb_content'] ));
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
                        "name"        => __( "Style", 'zn_framework' ),
                        "description" => __( "Please select the style you want to use.", 'zn_framework' ),
                        "id"          => "cttb_style",
                        "std"         => "style1",
                        "type"        => "select",
                        "options"     => array (
                            'style1'     => __( 'Style 1 - Simple Circle', 'zn_framework' ),
                            'style2'    => __( 'Style 2 - Pointing circle', 'zn_framework' ),
                            'style3'    => __( 'Style 3 - Square shaped', 'zn_framework' )
                        ),
                        'live' => array(
                            'type'      => 'class',
                            'css_class' => '.'.$this->data['uid']
                        )
                    ),
                    array (
                        "name"        => __( "Circle Text Title", 'zn_framework' ),
                        "description" => __( "Please enter a SMALL word that will appear on the left circle beside the main title.", 'zn_framework' ),
                        "id"          => "ctb_circle_title",
                        "std"         => "",
                        "type"        => "text",
                    ),
                    array (
                        "name"        => __( "Main Title", 'zn_framework' ),
                        "description" => __( "Please enter a main title for this box.", 'zn_framework' ),
                        "id"          => "ctb_main_title",
                        "std"         => "",
                        "type"        => "text",
                    ),
                    array (
                        "name"        => __( "Content", 'zn_framework' ),
                        "description" => __( "Please enter a content for this box.", 'zn_framework' ),
                        "id"          => "ctb_content",
                        "std"         => "",
                        "type"        => "visual_editor",
                        'class'       => 'zn_full'
                    ),

                    array (
                        "name"        => __( "Circle Background Color", 'zn_framework' ),
                        "description" => __( "Select the background color for the circle.", 'zn_framework' ),
                        "id"          => "ctb_circle_bgcolor",
                        "std"         => "#cd2122",
                        "type"        => "colorpicker",
                    ),
                    array (
                        "name"        => __( "Circle Text Color", 'zn_framework' ),
                        "description" => __( "Select the text color for the circle.", 'zn_framework' ),
                        "id"          => "ctb_circle_textcolor",
                        "std"         => "#ffffff",
                        "type"        => "colorpicker",
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#nMXI-Tfit68" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/circle-title-text-box/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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

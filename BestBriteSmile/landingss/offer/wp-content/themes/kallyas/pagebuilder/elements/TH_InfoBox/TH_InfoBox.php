<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Info Box
 Description: Create and display an Info Box element
 Class: TH_InfoBox
 Category: content
 Level: 3
*/
/**
 * Class TH_InfoBox
 *
 * Create and display an Info Box element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author Team Hogash
 * @since 3.8.0
 */
class TH_InfoBox extends ZnElements
{
    public static function getName(){
        return __( "Info Box", 'zn_framework' );
    }

    /**
     * This method is used to display the output of the element.
     *
     * @return void
     */
    function element()
    {
        $options = $this->data['options'];

        if( empty( $options['ib_style'] ) ){
            $options['ib_style'] = 'style1';
        }

        // Only for style 3
        $isStyle3 = ((isset($options['ib_style']) && !empty($options['ib_style'])) && ('infobox3' == $options['ib_style']));
        $style3Style = $link1 = $link2 = '';
        if($isStyle3){
            $bgColor = (isset($options['ib_bgcolor']) && !empty($options['ib_bgcolor']) ? $options['ib_bgcolor'] : '');
            $bgImage = (isset($options['ib_bgimage']) && !empty($options['ib_bgimage']) ? $options['ib_bgimage'] : '');
            if(!empty($bgColor) || !empty($bgImage)){
                $style3Style = 'style="';
                if(!empty($bgColor)){ $style3Style .= 'background-color: '.$bgColor.';';}

                if( !empty( $bgImage['image'] ) ) { $style3Style .= 'background-image: url('.$bgImage['image'].');'; }
                if( !empty( $bgImage['repeat'] ) ) { $style3Style .= 'background-repeat:'.$bgImage['repeat'].';'; }
                if( !empty( $bgImage['size'] ) ) { $style3Style .= 'background-size:'.$bgImage['size'].';'; }
                if( !empty( $bgImage['position'] ) ) { $style3Style .= 'background-position:'.$bgImage['position']['x'].' '.$bgImage['position']['y'].';'; }
                if( !empty( $bgImage['attachment'] ) ) { $style3Style .= 'background-attachment:'.$bgImage['attachment'].';'; }

                $style3Style .= '"';
            }
            // LINK 2
            $link2 = '';
            if ( ! empty ( $options['ib_button_text2'] ) && ! empty ( $options['ib_button_link']['url'] ) ) {
                $link2 = '<a href="' . $options['ib_button_link2']['url'] . '" target="' .
                         $options['ib_button_link2']['target'] . '" class="ib-button2 btn btn-fullcolor">' .
                         $options['ib_button_text2'] .'</a>';
            }
        }

        // LINK
        $link = '';
        if ( ! empty ( $options['ib_button_text'] ) && ! empty ( $options['ib_button_link']['url'] ) ) {
            $link = '<a href="' . $options['ib_button_link']['url'] . '" target="' .$options['ib_button_link']['target'] .
                    '" class="btn btn-lg btn-fullcolor">' . $options['ib_button_text'] . '</a>';
            if($isStyle3)
            {
                $link1 = '<a href="' . $options['ib_button_link']['url'] . '" target="'
                         .$options['ib_button_link']['target'] .
                         '" class="ib-button-1 btn btn-lined">' . $options['ib_button_text'] . '</a>';
            }
        }

        // If the button does not exists
        $useColCustom = 'col-lg-12';

        if(!empty($options['ib_button_text']) && ($options['ib_style'] == 'infobox2') && !empty($link)){
            $useColCustom = 'col-lg-8';
        }
        else {
            if ( $options['ib_style'] == 'infobox1' ) {
                $useColCustom = 'col-lg-12';
            }
        }


        echo '<div class="' . $options['ib_style'] . ' '.$this->opt('css_class','').'" '.$style3Style.'>';
        echo '<div class="row">';
        echo '<div class="ib-content infobox3--'.$this->opt('ib_theme_color', 'dark').' col-sm-12 '.$useColCustom.'">';
        // TITLE
        if ( ! empty ( $options['ib_title'] ) ) {
            echo '<h3 class="ib-content__title m_title">' . $options['ib_title'] . '</h3>';
        }

        // SUBTITLE
        if ( ! empty ( $options['ib_subtitle'] ) ) {
            echo wpautop($options['ib_subtitle']);
        }

        // Link button: style 1
        if (!empty($options['ib_style']) && ( $options['ib_style'] == 'infobox1' ) && !empty($link)) {
            echo '<div class="ib-button">';
            echo $link;
            echo '</div>';
        }
        // Link button: style 3
        elseif($isStyle3){
            // Button 1
            if(! empty($link)){
                echo '<div class="ib-button ib-button-1">';
                echo $link1;
                echo '</div>';
            }
            // Button 2
            if(! empty($link2)){
                echo '<div class="ib-button ib-button-2">';
                echo $link2;
                echo '</div>';
            }
        }

        echo '</div>'; // End .ib-content

        // Link button: style 2
        if ( !empty($options['ib_style']) && ( $options['ib_style'] == 'infobox2' ) && !empty($link)) {
            echo '<div class="ib-button col-sm-12 col-lg-4">';
            echo $link;
            echo '</div>';
        }

        echo '</div>'; // End .row

        echo '</div>'; //  end .$options['ib_style']


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
                        "description" => __( "Please enter the Info Box title", 'zn_framework' ),
                        "id"          => "ib_title",
                        "std"         => "",
                        "type"        => "text",
                    ),
                    array (
                        "name"        => __( "Subtitle", 'zn_framework' ),
                        "description" => __( "Please enter the Info Box subtitle", 'zn_framework' ),
                        "id"          => "ib_subtitle",
                        "std"         => "",
                        "type"        => "text",
                    ),
                    array (
                        "name"        => __( "Select style", 'zn_framework' ),
                        "description" => __( "Select the desired style for this element", 'zn_framework' ),
                        "id"          => "ib_style",
                        "type"        => "select",
                        "std"         => "style1",
                        "options"     => array (
                            'infobox1' => __( 'Style 1', 'zn_framework' ),
                            'infobox2' => __( 'Style 2', 'zn_framework' ),
                            'infobox3' => __( 'Style 3', 'zn_framework' ),
                        ),
                    ),

                    array (
                        "name"        => __( "Text color scheme", 'zn_framework' ),
                        "description" => __( "Select the desired style for this element", 'zn_framework' ),
                        "id"          => "ib_theme_color",
                        "type"        => "select",
                        "std"         => "dark",
                        "options"     => array (
                            'dark' => __( 'Dark text color', 'zn_framework' ),
                            'light' => __( 'Light text color', 'zn_framework' ),
                        ),
                        // 'dependency'  => array( 'element' => 'ib_style', 'value'   => array('infobox3'), ),
                    ),

                    array (
                        "name"        => __( "Select background color", 'zn_framework' ),
                        "description" => __( "Select a color to apply as background color.", 'zn_framework' ),
                        "id"          => "ib_bgcolor",
                        "std"         => "#eee",
                        "type"        => "colorpicker",
                        'dependency'  => array( 'element' => 'ib_style', 'value'   => array('infobox3'), ),
                    ),
                    array (
                        "name"        => __( "Select background image", 'zn_framework' ),
                        "description" => __( "Please select an image to use as background image.", 'zn_framework' ),
                        "id"          => "ib_bgimage",
                        "std"         => "",
                        "type"        => "background",
                        'class'       => 'zn_full',
                        'options' => array( "repeat" => true , "position" => true , "attachment" => true, "size" => true ),
                        'dependency'  => array( 'element' => 'ib_style', 'value'   => array('infobox3'), ),
                    ),
                    array (
                        "name"        => __( "Button 2 text", 'zn_framework' ),
                        "description" => __( "Please enter a text that will appear as button", 'zn_framework' ),
                        "id"          => "ib_button_text2",
                        "std"         => "",
                        "type"        => "text",
                        'dependency'  => array( 'element' => 'ib_style', 'value'   => array('infobox3'), ),
                    ),
                    array (
                        "name"        => __( "Button 2 link", 'zn_framework' ),
                        "description" => __( "Please choose the link you want to use.", 'zn_framework' ),
                        "id"          => "ib_button_link2",
                        "std"         => "",
                        "type"        => "link",
                        "options"     => array (
                            '_blank' => __( "New window", 'zn_framework' ),
                            '_self'  => __( "Same window", 'zn_framework' )
                        ),
                        'dependency'  => array( 'element' => 'ib_style', 'value'   => array('infobox3'), ),
                    ),

                    array (
                        "name"        => __( "Button text", 'zn_framework' ),
                        "description" => __( "Please enter a text that will appear as button", 'zn_framework' ),
                        "id"          => "ib_button_text",
                        "std"         => "",
                        "type"        => "text",
                    ),
                    array (
                        "name"        => __( "Button link", 'zn_framework' ),
                        "description" => __( "Please choose the link you want to use.", 'zn_framework' ),
                        "id"          => "ib_button_link",
                        "std"         => "",
                        "type"        => "link",
                        "options"     => array (
                            '_blank' => __( "New window", 'zn_framework' ),
                            '_self'  => __( "Same window", 'zn_framework' )
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#LoGkTg6n6lg" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/info-box/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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

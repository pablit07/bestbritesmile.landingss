<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Info Box 2
 Description: Create and display a Info Box 2 element
 Class: TH_InfoBox2
 Category: content
 Level: 3
*/

/**
 * Class TH_InfoBox2
 *
 * Create and display a Info Box 2 element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_InfoBox2 extends ZnElements
{
    public static function getName(){
        return __( "Info Box 2", 'zn_framework' );
    }

    /**
     * This method is used to display the output of the element.
     *
     * @return void
     */
    function element()
    {
        $options = $this->data['options'];

        $isCustom = false;
        $bgColor = $bgImage = '';
        if(isset($options['ib2_style']) && !empty($options['ib2_style']))
        {
            if('style1' == $options['ib2_style']){
                // If ever...
            }
            elseif('style2' == $options['ib2_style']){
                $isCustom = true;
                $bgColor = (isset($options['ib2_bgcolor']) && !empty($options['ib2_bgcolor'])) ? esc_attr($options['ib2_bgcolor']) : '';

            }
            elseif('style3' == $options['ib2_style']){
                $isCustom = true;
                $bgImage = (isset($options['ib2_bgimage']) && !empty($options['ib2_bgimage'])) ? $options['ib2_bgimage'] : '';
            }
        }

        // Style 2 && style 3
        if($isCustom)
        {
            $infoMessage = ((isset($options['ib2_info_message']) && !empty($options['ib2_info_message'])) ? esc_attr($options['ib2_info_message']) : '');
            $ibTitle = ((isset($options['ib2_title_text']) && !empty($options['ib2_title_text'])) ? esc_attr($options['ib2_title_text']) : '');
            $ibText = ((isset($options['ib2_title']) && !empty($options['ib2_title'])) ? $options['ib2_title'] : '');
            $ibTextColor = ((isset($options['ib2_text_color']) && !empty($options['ib2_text_color'])) ? esc_attr($options['ib2_text_color']) : '');
            $style = '';
            if($bgColor){
                $style = 'style="background-color:'.$bgColor.';"';
            }
            elseif($bgImage){
                $style = 'style="background-image:url('.$bgImage.');"';
            }
            ?>
            <div class="ib2-<?php echo $options['ib2_style'] . ' ' .$ibTextColor.' '.$this->opt('css_class','');?> ib2-custom" <?php echo $style;?>>
                <div class="ib2-inner">
                    <h4 class="ib2-info-message"><?php echo $infoMessage;?></h4>
                    <div class="ib2-content">
                        <h3 class="ib2-content--title"><?php echo $ibTitle;?></h3>
                        <div class="ib2-content--text"><?php echo wpautop($ibText);?></div>
                    </div>
                </div>
            </div>
        <?php
        }
        else {
            if(isset($options['ib2_title'])){
                // if no subtitle nor description use full 12 column
                echo '<div class="info-text '.$this->opt('css_class','').'">';
                echo wpautop($options['ib2_title']);
                echo '</div>';
            }
        }
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
                    array(
                        "name"        => __( '<strong style="font-size:120%">Warning!</strong>', 'zn_framework' ),
                        "description" => __( 'Since v4.x, <strong>this element is <em>deprecated</em> & <em>unsuported</em></strong>. It\'s not recommended to be used bucause at some point it\'ll be removed (now it\'s kept only for backwards compatibilty).<br> Instead, try to use a one of these elements (or combined): Section (to add background), 2 Columns (6 + 6), Title element/TextBox (onto the left column), Button Element (into the right column)', 'zn_framework' ),
                        'type'  => 'zn_message',
                        'id'    => 'zn_error_notice',
                        'show_blank'  => 'true',
                        'supports'  => 'warning'
                    ),
                    array (
                        "name"        => __( "Select style", 'zn_framework' ),
                        "description" => __( "Select the desired style for this element", 'zn_framework' ),
                        "id"          => "ib2_style",
                        "type"        => "select",
                        "std"         => "style1",
                        "options"     => array (
                            'style1' => __( 'Style 1 (Default)', 'zn_framework' ),
                            'style2' => __( 'Style 2 (Background color)', 'zn_framework' ),
                            'style3' => __( 'Style 3 (background image)', 'zn_framework' ),
                        ),
                    ),

                    array (
                        "name"        => __( "Select background color", 'zn_framework' ),
                        "description" => __( "Select a color to apply as background color.", 'zn_framework' ),
                        "id"          => "ib2_bgcolor",
                        "std"         => "#fff",
                        "type"        => "colorpicker",
                        'dependency'  => array( 'element' => 'ib2_style', 'value'   => array('style2') ),
                    ),

                    array (
                        "name"        => __( "Select text color", 'zn_framework' ),
                        "description" => __( "Select the desired color theme", 'zn_framework' ),
                        "id"          => "ib2_text_color",
                        "type"        => "select",
                        "std"         => "light",
                        "options"     => array (
                            'ib2-text-color-light-theme' => 'Light theme',
                            'ib2-text-color-dark-theme'  => 'Dark theme',
                        ),
                        'dependency'  => array( 'element' => 'ib2_style', 'value'   => array('style2','style3') ),
                    ),
                    array (
                        "name"        => __( "Select background image", 'zn_framework' ),
                        "description" => __( "Please select an image to use as background image.", 'zn_framework' ),
                        "id"          => "ib2_bgimage",
                        "std"         => "",
                        "type"        => "media",
                        'dependency'  => array( 'element' => 'ib2_style', 'value'   => array('style3') ),
                    ),

                    array (
                        "name"        => __( "Info message", 'zn_framework' ),
                        "description" => __( "Please enter the info message", 'zn_framework' ),
                        "id"          => "ib2_info_message",
                        "std"         => "",
                        "type"        => "text",
                        'dependency'  => array( 'element' => 'ib2_style', 'value'   => array('style2','style3') ),
                    ),
                    array (
                        "name"        => __( "Title", 'zn_framework' ),
                        "description" => __( "Please enter the title", 'zn_framework' ),
                        "id"          => "ib2_title_text",
                        "std"         => "",
                        "type"        => "text",
                        'dependency'  => array( 'element' => 'ib2_style', 'value'   => array('style2','style3') ),
                    ),

                    array (
                        "name"        => __( "Content", 'zn_framework' ),
                        "description" => __( "Please enter the content for this box", 'zn_framework' ),
                        "id"          => "ib2_title",
                        "std"         => "",
                        "type"        => "visual_editor",
                        'class'       => 'zn_full'
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
